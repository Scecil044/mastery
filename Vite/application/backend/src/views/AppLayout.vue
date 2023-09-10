<template>
    <div v-if="currentUser.id" class="flex min-h-full bg-gray-200">
        <Sidebar :class="{ '-ml-[200px]': !sidebarState }" />
        <div class="flex-1">
            <Header @toggle-sidebar="toggleSidebar" />
            <main>
                <router-view></router-view>
            </main>
        </div>
    </div>
    <div v-else class="min-h-full bg-gray-200 flex items-center justify-center">
        <Spinner />
    </div>
</template>
<script setup>
import Header from "../components/Header.vue";
import Sidebar from "../components/Sidebar.vue";
import Spinner from "../components/core/Spinner.vue";
import { ref, onMounted, onUnmounted, computed } from "vue";
import store from "../store";

const currentUser = computed(() => store.state.user.data);
const sidebarState = ref(true);

function toggleSidebar() {
    sidebarState.value = !sidebarState.value;
}

onMounted(() => {
    store.dispatch("getUser");
    collapseSidebar();
    window.addEventListener("resize", collapseSidebar);
});
onUnmounted(() => {
    collapseSidebar();
    window.removeEventListener("resize", collapseSidebar);
});

function collapseSidebar() {
    sidebarState.value = window.outerWidth > 768;
}
</script>
<style scoped></style>
