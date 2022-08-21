<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Jetstream/Welcome.vue';
import {Link,useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import { reactive } from 'vue'

const props = defineProps({
    errors: Object,
    department: Object
});

const form = reactive({
    name: props.department.name
})

function submit(){
    Inertia.put(`/departments/${props.department.id}`,form)
}
    

</script>

<template>
    <AppLayout title="Departments">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Departments
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="card lg:p-5">
                        <div class="w-full mb-5">
                            <div class="text-right w-full mb-5">
                                <div>
                                    <u><Link href="/departments">Departments</Link></u>
                                </div>
                            </div>
                            <div class="text-center w-full mb-5">
                                Edit Department
                            </div>
                            <div class="flex justify-center w-full">
                                <form class="w-2/4" @submit.prevent="submit">
                                <label class="block mb-5">
                                    <span class="block text-sm font-medium text-slate-700">Name</span>
                                    <!-- Using form state modifers, the classes can be identical for every input -->
                                    <input type="text" v-model="form.name"  class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                    focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500
                                    disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                    invalid:border-pink-500 invalid:text-pink-600
                                    focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                                    "/>
                                    <div v-if="errors.name">{{ errors.name }}</div>
                                </label>
                                <div class="w-full flex justify-center">
                                    <Link href="/departments"
                                        as="button"
                                        type="button"
                                        class="py-2 mr-5 px-4 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75"
                                    >Cancel</Link>
                                    <button class="py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                                        Save
                                    </button>
                                </div>
                                
                                <!-- ... -->
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
