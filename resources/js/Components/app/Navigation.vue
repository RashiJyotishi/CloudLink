<template>
    <nav class="min-w-[200px]">
        <Link :href="route('myFiles')" class="h-[80px] px-3 flex items-center gap-3">
            <ApplicationLogo
                class="block w-auto text-gray-800 fill-current h-9"
            />
            LaraStorage
        </Link>
        <div class="px-3">
              <CreateNewDropdown />
              <div class="py-3">
                <NavLink :href="route('myFiles')" :active="$page.url=='/my-files'">My Files</NavLink>
                <NavLink href="/" >Shared with me</NavLink>
                <NavLink href="/">Shared by me</NavLink>
                <NavLink href="/" active="true">Trash</NavLink>
              </div>
        </div>
    </nav>
</template>

<script setup >
import { Link } from '@inertiajs/vue3';
import CreateNewDropdown from './CreateNewDropdown.vue';
import ApplicationLogo from '../ApplicationLogo.vue';
import NavLink from '../NavLink.vue';

</script>

<style scoped>
</style>    