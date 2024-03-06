<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import { ref, reactive } from 'vue'
import Pagination from '@/Components/Pagination.vue'
import axios from 'axios'

defineProps({
    customers: Object
})

// 検索入力フォームのref
const search = ref('')

const searchedCustomers = reactive({})
const searchCustomers = async () => {
    console.log(search.value)
    try{
        console.log(search.value)
        await axios.get(`/api/searchCustomers/?search=${search.value}`)
            .then( res => {
                console.log(res.data)
                searchedCustomers.value = res.data
            })
    } catch(e) {
        console.log(e)
    }
}

</script>

<template>
    <Head title="Customers" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Customers
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="text-gray-600 body-font">
                            <div class="container px-5 py-8 mx-auto">
                                <div class="flex pl-4 my-4 lg:w-2/3 w-full mx-auto">
                                    <div>
                                        <input type="text" name="search" v-model="search">
                                        <button class="bg-indigo-500 text-white py-2 px-6 rounded"
                                            @click="searchCustomers"
                                        >検索</button>
                                    </div>
                                    <Link 
                                        as="button"
                                        :href="route('customers.create')"
                                        class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">
                                        new
                                    </Link>
                                </div>
                                <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                    <table class="table-auto w-full text-left whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    id
                                                </th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                                    name
                                                </th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    カナ
                                                </th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    tel
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody v-if="searchedCustomers.value">
                                            <tr v-for="customer in searchedCustomers.value.data" :key="customer.id">
                                                <td class="border-b-2 border-gray-200 px-4 py-3">
                                                    <Link class="text-blue-400" :href="route('customers.show', {customer: customer.id})">
                                                        {{ customer.id }}
                                                    </Link>
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
                                        <tbody v-else>
                                            <tr v-for="customer in customers.data" :key="customer.id">
                                                <td class="border-b-2 border-gray-200 px-4 py-3">
                                                    <Link class="text-blue-400" :href="route('customers.show', {customer: customer.id})">
                                                        {{ customer.id }}
                                                    </Link>
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
                                    </table>
                                </div>
                            </div>
                            <Pagination v-if="searchedCustomers.value"
                                class="mt-6" :links="searchedCustomers.links"></Pagination>
                            <Pagination v-else
                                class="mt-6" :links="customers.links"></Pagination>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>