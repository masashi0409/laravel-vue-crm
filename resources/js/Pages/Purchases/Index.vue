<script setup>
import { onMounted, ref, reactive } from 'vue'
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue'
import dayjs from 'dayjs'

const props = defineProps({
    totals: Object
})

const totalsPaging = reactive({})
const totals = ref([])

onMounted(() => {
    totalsPaging.value = props.totals // paginateで取得しているのでページングの情報を含む
    totals.value = props.totals.data // paginateの場合dataに取得データの配列が入っている
})

</script>
<template>
    <Head title="購買履歴" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                購買履歴
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="text-gray-600 body-font">
                            <div class="container px-5 py-8 mx-auto">
                                <div class="flex pl-4 my-4 lg:w-2/3 w-full mx-auto">
                                </div>
                                <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                    <table class="table-auto w-full text-left whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    購買履歴ID
                                                </th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                                    会員氏名
                                                </th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    合計金額
                                                </th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    購入日
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody v-if="totals">
                                            <tr v-for="total in totals" :key="total.id">
                                                <td class="border-b-2 border-gray-200 px-4 py-3">
                                                    <Link class="text-blue-400" :href="route('purchases.show', { purchase: total.id})">
                                                        {{ total.id }}
                                                    </Link>
                                                </td>
                                                <td class="border-b-2 border-gray-200 px-4 py-3">
                                                    {{  total.customer_name }}
                                                </td>
                                                <td class="border-b-2 border-gray-200 px-4 py-3">
                                                    {{ total.total }}
                                                </td>
                                                <td class="border-b-2 border-gray-200 px-4 py-3">
                                                    {{ dayjs(total.created_at).format('YYYY-MM-DD HH:mm:ss') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <Pagination v-if="totalsPaging.value"
                                class="mt-6" :links="totalsPaging.value.links"></Pagination>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>