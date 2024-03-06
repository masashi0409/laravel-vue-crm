<script setup>
import axios from 'axios';
import { ref, reactive, onMounted } from 'vue'

/**
 * 顧客検索モーダル
 * 商品購入画面で顧客検索するためのモーダル
 * axios API通信で /api/searchCustomersから非同期で顧客検索結果を取得する
 */

const emit = defineEmits(['update:customerId'])

onMounted(() => {
    axios.get('/api/user')
    .then( res  => {
        console.log(res.data)
    })
})

const isShow = ref(false)

const toggleStatus = () => {
    isShow.value = !isShow.value
}

const search = ref('')
const customers = reactive({})
const searchCustomers = async () => {
    try{
        // console.log(search.value)
        await axios.get(`/api/searchCustomers/?search=${search.value}`)
            .then( res => {
                // console.log(res.data)
                customers.value = res.data
            })
        toggleStatus()
    } catch(e) {
        console.log(e)
    }
}

/**
 * ボタン（顧客検索結果一覧の顧客ごとのidがボタンになっている）
 * 選んだ顧客IDを親コンポーネント(Purchases/Create.vue)にemitする
 * 
 * @click="setCustomer({ id: customer.id, kana: customer.kana } 引数をオブジェクトにしてる
 * e.id e.kanaなどで中身使える
 */
const setCustomer = e => {
    search.value = e.kana // 検索入力も変更しておく
    emit('update:customerId', e.id)
    toggleStatus() // モーダルを閉じる
}
</script>

<template>
    <div v-show="isShow" class="modal" id="modal-1" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                <header class="modal__header">
                    <h2 class="modal__title" id="modal-1-title">
                        顧客検索
                    </h2>
                    <button @click="toggleStatus" type="button" class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                </header>
                <main class="modal__content" id="modal-1-content">
                    <div v-if="customers.value">
                        <tbody>
                            <tr v-for="customer in customers.value.data" :key="customer.id">
                                <td class="border-b-2 border-gray-200 px-4 py-3">
                                    <button type="button" class="text-blue-400"
                                        @click="setCustomer({ id: customer.id, kana: customer.kana })">
                                            {{ customer.id }}
                                    </button>
                                </td>
                                <td class="border-b-2 border-gray-200 px-4 py-3">
                                    {{  customer.name }}
                                </td>
                                <td class="border-b-2 border-gray-200 px-4 py-3">
                                    {{ customer.kana }}
                                </td>
                                <td class="border-b-2 border-gray-200 px-4 py-3">
                                    {{ customer.tel }}
                                </td>
                            </tr>
                        </tbody>
                    </div>
                </main>
                <footer class="modal__footer">
                    <button @click="toggleStatus" type="button" class="modal__btn" data-micromodal-close aria-label="Close this dialog window">Close</button>
                </footer>
            </div>
        </div>
  </div>
  <input name="customer" v-model="search" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
  <div class="p-2 w-full">
    <button type="button" @click="searchCustomers" data-micromodal-trigger="modal-1" class="flex mx-auto text-white bg-teal-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
        検索
    </button>
  </div>
</template>