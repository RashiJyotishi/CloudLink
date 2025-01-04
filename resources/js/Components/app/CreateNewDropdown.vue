<template>
     <Menu as="div" class="relative block text-left">
        <MenuButton
        class="flex justify-center w-full gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-100 "
        >
            Create new 
            
        </MenuButton>
  
        <transition
          enter-active-class="transition duration-100 ease-out"
          enter-from-class="transform scale-95 opacity-0"
          enter-to-class="transform scale-100 opacity-100"
          leave-active-class="transition duration-75 ease-in"
          leave-from-class="transform scale-100 opacity-100"
          leave-to-class="transform scale-95 opacity-0"
        >
          <MenuItems
            class="absolute left-0 w-32 mt-2 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black/5 focus:outline-none"
          >
            <div class="px-1 py-1">
                  <MenuItem v-slot="{active}">
                      <a href="#" @click.prevent="showCreateFolderModal"  class="block px-4 py-2 text-sm text-gray-700">
                        New folder 
                      </a>
                  </MenuItem>
            </div>
            <div class="px-1 py-1">
                <MenuItem v-slot="{active}">
                    <a class="block px-4 py-2 text-sm text-gray-700">
                        upload files
                    </a>
                </MenuItem>
                <MenuItem v-slot="{active}">
                    <a class="block px-4 py-2 text-sm text-gray-700">
                        upload folder
                    </a>
                </MenuItem>
            </div>
            
          </MenuItems>
        </transition>
      </Menu>
      <CreateFolderModal v-model="createFolderModal"/>
</template>

<script setup>
// imports
import { Menu, MenuItems, MenuButton, MenuItem } from '@headlessui/vue';
import ResponsiveNavLink from '../ResponsiveNavLink.vue';
import {ref} from "vue";
import CreateFolderModal from './CreateFolderModal.vue';

// refs
const createFolderModal = ref(false)

// methods
function showCreateFolderModal() {
    createFolderModal.value = true
}

</script>

<style scoped>
/* Add your styles here */
</style>