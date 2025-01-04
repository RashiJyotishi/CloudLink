<template>
    <AuthenticatedLayout>
        <table v-if="files.data.length" class="min-w-full ">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                        Name
                    </th>
                    <th class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                        Owner
                    </th>
                    <th class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                        Last Modified
                    </th>
                    <th class="px-6 py-4 text-sm font-medium text-left text-gray-900">
                        Size
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="file of files.data" :key="file.id"
                 @dblclick="openFolder(file)"
                 onclick="console.log('clicked')"
                 class="transition duration-300 ease-in-out bg-white border-b cursor-pointer hover:bg-gray-100">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                        {{ file.name }}
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                        {{ file.owner }}
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                        {{ file.updated_at }}
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                        {{ file.size }}
                    </td>
                        
                </tr>
            </tbody>
        </table>
        <div v-if="!files.data.length" class="py-8 text-sm text-center text-gray-400 ">
            There is no data in this folder
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
// imports
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {router, useForm, usePage} from "@inertiajs/vue3";

// methods
function openFolder(file) {
    // console.log('openFolder called with:', file);
    if (!file.is_folder) {
        console.log( 'Not a folder');
    }
    router.visit(route('myFiles', { folder: file.path }));
    console.log('Navigating to folder');
}

// function handleDoubleCliabxck(file) {
//     const result = openFolder(file);
//     console.log('openFolder result:', result);
// }

// props and emit
const {files} = defineProps({
    files: Object
})
</script>