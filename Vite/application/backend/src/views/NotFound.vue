<template>
    <div class="flex gap-2 items-center h-full justify-center">
        <div class="border-indigo-200 border-r p-5">
            <h1 class="text-7xl font-bold text-indigo-800">4O4</h1>
        </div>
        <div class="p-5">
            <h1 class="text-5xl font-bold">Page not found</h1>
            <h1 class="my-2 font-light">Please check your URL and refresh</h1>
            <div class="my-2">
                <router-link
                    :to="{ name: 'app.dashboard' }"
                    class="bg-indigo-800 text-white py-2 px-3"
                    >Back to home</router-link
                >
            </div>
        </div>
    </div>
</template>
<script setup></script>
<style scoped></style>
