<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { reactive, onMounted, ref } from 'vue'
import { getToday } from '@/common'

import 'vue-good-table-next/dist/vue-good-table-next.css'
import { VueGoodTable } from 'vue-good-table-next';

import Chart from '@/Components/Chart.vue'


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
            data.labels = res.data.labels
            data.totals = res.data.totals
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
                        分析方法<br>
                        <div>
                            <input type="radio" v-model="form.type" value="perDay" checked><span class="mr-2">日別</span>
                            <input type="radio" v-model="form.type" value="perMonth"><span class="mr-2">月別</span>
                            <input type="radio" v-model="form.type" value="perYear"><span class="mr-2">年別</span>
                        </div>
                        From: <input type="date" name="startDate" v-model="form.startDate">
                        To: <input type="date" name="endDate" v-model="form.endDate"><br>
                        <button>分析する</button>
                    </form>
                    
                    <br>
                    <br>
                    <div>
                        vue-good-table-nextで表示
                    </div>
                  　<div class="lg:w-2/3 w-full mx-auto overflow-auto">
                        <vue-good-table
                            :columns="columns"
                            :rows="rows" />
                    </div>
                    
                    <br>
                    <br>
                    
                    <div>
                        chart
                    </div>
                    <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                        <Chart :data="data" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
