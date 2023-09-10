<template>
    <header class="flex justify-between w-full h-16 p-2 bg-white shadow-lg">
        <button
            @click="$emit('toggle-sidebar')"
            class="h-12 p-2 hover:bg-gray-200"
        >
            <Bars3Icon class="h-8" />
        </button>
        <Menu as="div">
            <div>
                <MenuButton class="flex items-center">
                    <img
                        src="https://randomuser.me/api/portraits/men/97.jpg"
                        alt="profile"
                        class="rounded-full h-12"
                    />
                    <small class="ml-2">{{ currentUser.name }}</small>
                    <ChevronDownIcon
                        class="ml-2 -mr-1 h-5 w-5 text-violet-700 hover:text-violet-100"
                        aria-hidden="true"
                    />
                </MenuButton>
            </div>

            <transition
                enter-active-class="transition duration-100 ease-out"
                enter-from-class="transform scale-95 opacity-0"
                enter-to-class="transform scale-100 opacity-100"
                leave-active-class="transition duration-75 ease-in"
                leave-from-class="transform scale-100 opacity-100"
                leave-to-class="transform scale-95 opacity-0"
            >
                <MenuItems
                    class="absolute right-0 mt-2 w-48 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                >
                    <div class="px-1 py-1">
                        <MenuItem v-slot="{ active }">
                            <button
                                :class="[
                                    active
                                        ? 'bg-indigo-800 text-white'
                                        : 'text-gray-900',
                                    'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                ]"
                            >
                                <UserIcon
                                    :active="active"
                                    class="mr-2 h-5 w-5 text-violet-600"
                                    aria-hidden="true"
                                />
                                Profile
                            </button>
                        </MenuItem>
                        <MenuItem v-slot="{ active }">
                            <button
                                @click="logout"
                                :class="[
                                    active
                                        ? 'bg-indigo-800 text-white'
                                        : 'text-gray-900',
                                    'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                ]"
                            >
                                <ArrowLeftOnRectangleIcon
                                    :active="active"
                                    class="mr-2 h-5 w-5 text-violet-600"
                                    aria-hidden="true"
                                />
                                Logout
                            </button>
                        </MenuItem>
                    </div>
                </MenuItems>
            </transition>
        </Menu>
    </header>
</template>
<script setup>
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import {
    ChevronDownIcon,
    Bars3Icon,
    UserIcon,
    ArrowLeftOnRectangleIcon,
} from "@heroicons/vue/20/solid";
import { computed } from "vue";
import store from "../store";
import router from "../router";

const currentUser = computed(() => store.state.user.data);
const emit = defineEmits(["toggle-sidebar"]);

function logout() {
    store.dispatch("logout").then(() => {
        router.push({ name: "login" });
    });
    Pacti;
}
</script>
<style scoped></style>
