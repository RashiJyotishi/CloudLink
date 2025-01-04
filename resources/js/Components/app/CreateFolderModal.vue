<template>
    <modal :show="modelValue" @show="onShow" max-width="sm">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">Create New Folder</h2>
            <div class="mt-6">
                <InputLabel for="folderName" value="Folder Name" class="sr-only"/>
                <TextInput 
                    type="text" 
                    ref="folderNameInput"
                    id="folderName" v-model="form.name"
                    class="block w-full mt-1"
                    :class="form.errors.name ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : ''"
                    placeholder="Folder Name"
                    @keyup.enter="createFolder"
                />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>
            <div class="flex justify-end mt-6 ">
                <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                <PrimaryButton class="ml-3" :class="{ 'opacity-25': form.processing }" @click="createFolder" :disabled="form.processing">submit</PrimaryButton>
            </div>
        </div>
    </modal>
</template>

<script setup>
    import { nextTick, ref } from 'vue';
    import InputLabel from '../InputLabel.vue';
    import { useForm, usePage } from '@inertiajs/vue3';
    import axios from 'axios';

    // Hooks
    import Modal from '../Modal.vue';
    import TextInput from '../TextInput.vue';
    import InputError from '../InputError.vue';
import SecondaryButton from '../SecondaryButton.vue';
import PrimaryButton from '../PrimaryButton.vue';
    
    // uses
    const form = useForm({
        name: '',
        parent_id: null,
    });

    const page = usePage();
    
    // refs
    const folderNameInput = ref(null);  
    
    // props ans emits
    const {modelValue} = defineProps({
        modelValue: Boolean
    });

    const emit = defineEmits(['update:modelValue']);

    // methods
    function onShow(){
        nextTick(()=>folderNameInput.value.focus())
        // folderNameInput.value.focus()
    }    
    console.log(page.props.folder);

    function createFolder(){
        form.parent_id = page.props?.folder?.id || null;
        // console.log('parent_id: ', form.parent_id);
        // console.log('Form Data:', form);
        // console.log('Request Headers:', window.axios.defaults.headers.common);
        form.post(route('folder.create'),{
            preserveScroll: true,
            onSuccess: () => {
                closeModal()
                form.reset();
                // show success notification 
            },
            onError: () => {
                console.log(folderNameInput.value)
                // folderNameInput.value.focus()
                // show error notification
            }
        })
    }

    function closeModal(){
        emit('update:modelValue',false)
        form.clearErrors();
        form.reset();
    }

</script>