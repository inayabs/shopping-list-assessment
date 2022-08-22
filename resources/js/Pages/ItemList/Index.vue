<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Jetstream/Welcome.vue';
import {Link} from "@inertiajs/inertia-vue3";
import { reactive } from '@vue/reactivity';
import { computed } from '@vue/runtime-core';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    items: Object,
    item_list: Array,
    errors: Object
});

const form = reactive({
    item: '',
    quantity: 1,
    quantity_style:''
});

function submit(){
    Inertia.post('/list',form);

    form.item = ''
    form.quantity = 1
}

function update(id,event){
    Inertia.put(`/list/${id}`,{
        quantity: event.target.value    
    }
    )
}

function delete_item(id){
    Inertia.delete(`/list/${id}`,form);
}

const quantityChecker = computed({
    get(){
        // console.log('quantity checker')
        return form.quantity
    },
    set(val){
        if(val<1){
            // alert('Qantity cannot be less than 1.');
            form.quantity_style = 'border-red-500 focus:border-red-500'
            // form.quantity = 1
        }else{
            form.quantity_style = ''
        }
        form.quantity = val
    }
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
                    <div class="card lg:p-5 mb-5">
                        <div class="bg-gray-50 shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Add item to shopping list</h3>
                        </div>
                        <div class="border-t border-gray-200">
                        <dl>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-6 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500 col-span-3">
                                    <select v-model="form.item" id="item" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled>Select an Item</option>
                                    <option v-for="item in items.data" :value="item.id" :key="item.id">{{item.name}}</option>
                                    </select>
                                    <div v-if="errors.item">{{ errors.item }}</div>
                                </dt>
                                <dd class="text-sm font-medium text-gray-500 col-span-1">
                                    <input @change="checkQuantity" v-model="quantityChecker" type="number" name="quantity" id="quantity" :class="form.quantity_style+' block w-3/4 pl-7 pr-12 sm:text-sm rounded-md'"/>
                                    <div v-if="errors.quantity">{{ errors.quantity }}</div>
                                </dd>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 col-span-2 grid content-center flex justify-center">
                                    <div>
                                        <a href="javascript:void(0)" @click="submit">Save</a>
                                    </div>
                                </dd>
                            </div>
                        </dl>
                        </div>
                    </div>
                    <div class="mt-10" v-for="(il,key,index) in item_list" :key="index">
                        <p class="prose prose-xl mb-5">{{key}}</p>
                        <div v-for="item in il" :key="item.id" class="grid grid-cols-5 content-center flex justify-center mb-5">
                            <dt class="text-sm font-medium text-gray-500 col-span-1 grid content-center flex justify-center">
                                {{item.item.name}}
                            </dt>
                            <dd class="text-sm font-medium text-gray-500 col-span-1 grid content-center flex justify-center">
                                <input type="number" @change="update(item.id,$event)" :value="item.quantity" name="quantity" id="quantity" :class='item.quantity<1?"border-red-500 focus:border-red-500 block w-3/4 pl-7 pr-12 sm:text-sm rounded-md":" block w-3/4 pl-7 pr-12 sm:text-sm rounded-md"'/>
                            </dd>
                            <dd class="text-sm font-medium text-gray-500 col-span-2">
                                
                            </dd>
                            <dd class="text-sm font-medium text-gray-500 col-span-1 grid content-center flex justify-center">
                                <div>
                                    <a href="javascript:void(0)" @click="delete_item(item.id)">Delete</a>
                                </div>
                            </dd>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
