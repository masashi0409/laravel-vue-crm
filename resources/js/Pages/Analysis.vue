<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { reactive, onMounted } from 'vue'
import { getToday } from '@/common'

const form = reactive({ startDate: null, endDate: null })

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
            // data.value = res.data
            console.log(res.data)
        })
    } catch (e){
        console.log(e.message)
    }
}
    
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
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
