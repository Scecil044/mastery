<template>
    <div class="w-[200px] p-5 bg-neutral-800 text-white transition-all">
        <router-link
            :to="{ name: 'app.dashboard' }"
            class="px-3 py-2 hover:bg-black/20 flex items-center gap-2"
        >
            <HomeIcon class="h-6" />
            Dashboard
        </router-link>

        <router-link
            :to="{ name: 'app.users' }"
            class="px-3 py-2 my-2 hover:bg-black/20 flex items-center gap-2"
        >
            <UserGroupIcon class="h-6" />
            Users
        </router-link>

        <router-link
            :to="{ name: 'app.products' }"
            class="px-3 py-2 my-2 hover:bg-black/20 flex items-center gap-2"
        >
            <ShoppingCartIcon class="h-6" />
            Products
        </router-link>

        <router-link
            :to="{ name: 'app.reports' }"
            class="px-3 py-2 my-2 hover:bg-black/20 flex items-center gap-2"
        >
            <DocumentDuplicateIcon class="h-6" />
            Reports
        </router-link>
    </div>
</template>
<script setup>
import {
    HomeIcon,
    UserGroupIcon,
    ShoppingCartIcon,
    DocumentDuplicateIcon,
} from "@heroicons/vue/20/solid";
</script>
<style scoped></style>
