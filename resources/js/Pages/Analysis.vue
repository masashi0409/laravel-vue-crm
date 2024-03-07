<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { reactive, onMounted, ref } from 'vue'
import { getToday } from '@/common'

import 'vue-good-table-next/dist/vue-good-table-next.css'
import { VueGoodTable } from 'vue-good-table-next';

const form = reactive({ startDate: null, endDate: null, type: 'perDay' })

const data = reactive({})

onMounted(() => {
    form.startDate = getToday()
    form.endDate = getToday()
})

const getData = async () => {
    try{
        await axios.get('/api/analysis/', {
            params: {
                startDate: form.startDate,
                endDate: form.endDate,
                type: form.type
            }
        })
        .then( res => {
            data.data = res.data.data
            
            rows.value = res.data.data
            
        })
    } catch (e){
        console.log(e.message)
    }
}


const columns = ref([
    {
      label: '年月日',
      field: 'date',
      filterOptions: {
        enabled: true,
      }
    },
    {
        label: '金額',
        field: 'total',
        type: 'number',
        filterOptions: {
          enabled: true,
        }
    },
])
    
const rows = ref([
    { date:1, total:"100"},
    { date:2, total:"200"},
])
    
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Analysis</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Analysis</div>
                    <form @submit.prevent="getData">
                     From: <input type="date" name="startDate" v-model="form.startDate">
                     To: <input type="date" name="endDate" v-model="form.endDate"><br>
                     <button>分析する</button>
                    </form>
                    
                    <div v-if="data.data" class="lg:w-2/3 w-full mx-auto overflow-auto">
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">年月日</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">金額</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in data.data" :key="item.date">
                                    <td class="border-b-2 border-gray-200 px-4 py-3">{{ item.date }}</td>
                                    <td class="border-b-2 border-gray-200 px-4 py-3">{{ item.total }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <br>
                    <div>
                        vue-good-table-nextで表示
                    </div>
                  　<div>
                        <vue-good-table
                            :columns="columns"
                            :rows="rows" />
                        </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
