<template>
    <div class="w-[600px] h-[80px] flex items-center">
        <TextInput 
        type="text" 
        class="block w-full mr-2" 
        v-model="form.search" 
        autocomplete 
        placeholder="Search for files and folders" 
        />
    </div>
</template>

<script setup>
//imports
import { useForm } from '@inertiajs/vue3';
import TextInput from '../TextInput.vue';

//uses
// const form = useForm(data: {
//     search: ''
// })

const form = useForm({
  search: ''
});

</script>

<style scoped>
/* Add your styles here */
</style>