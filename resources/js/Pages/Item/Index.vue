<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Jetstream/Welcome.vue';
import {Link} from "@inertiajs/inertia-vue3";

const props = defineProps({
    department_items: Object
});

</script>

<template>
    <AppLayout title="Departments">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Items
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="card lg:p-5">
                        <div class="text-right w-full mb-5">
                            <div>
                                <u><Link href="/items/create">Create Item</Link></u>
                            </div>
                        </div>
                        <div v-for="department_item in department_items.data" :key="department_item.id" class="w-full mb-5">
                            <strong>{{department_item.name}}</strong>
                            <table class="table-auto w-full lg:border-spacing-4">
                            <tbody>
                                <tr v-for="item in department_item.item" :key="item.id">
                                    <td>{{item.name}}</td>
                                    <td class="text-right">
                                        <u class="mr-5"><Link :href="`/items/${item.id}/edit`">Edit</Link></u>
                                        <u class=""><Link :href="`/items/${item.id}`"
                                            method="delete"
                                            as="button"
                                            type="button"
                                            class="text-red-600 hover:text-red-900"
                                        >Delete</Link></u>
                                    </td>
                                </tr>
                                
                                <tr v-if="department_items.data==null">
                                    <td>No items listed yet.</td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
