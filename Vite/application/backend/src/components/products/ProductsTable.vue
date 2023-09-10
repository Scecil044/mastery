<template>
    <div class="bg-white shadow-lg p-5 mt-2 animate-fade-in-down">
        <!-- per page and search  -->
        <div
            class="flex justify-between items-center border-b pb-2 border-black"
        >
            <span>
                Per page
                <select @change="getProducts(null)" v-model="perPage">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="50">50</option>
                    <option value="90">90</option>
                </select>
            </span>
            <input
                @change="getProducts(null)"
                type="text"
                placeholder="Type product to search"
                v-model="search"
            />
        </div>
        <!-- products table -->
        <div>
            <table class="table-auto w-full mt-2 whitespace-nowrap">
                <thead>
                    <tr>
                        <TableHeaderCell
                            @click="sortProducts"
                            class="p-2 border-b"
                            field="id"
                            :sort-field="sortField"
                            :sort-direction="sortDirection"
                            >Id</TableHeaderCell
                        >
                        <TableHeaderCell
                            @click="sortProducts"
                            class="p-2 border-b"
                            field="image"
                            :sort-field="sortField"
                            :sort-direction="sortDirection"
                            >Image</TableHeaderCell
                        >
                        <TableHeaderCell
                            @click="sortProducts"
                            class="p-2 border-b"
                            field="title"
                            :sort-field="sortField"
                            :sort-direction="sortDirection"
                            >Title</TableHeaderCell
                        >
                        <TableHeaderCell
                            @click="sortProducts"
                            class="p-2 border-b"
                            field="price"
                            :sort-field="sortField"
                            :sort-direction="sortDirection"
                            >Price</TableHeaderCell
                        >
                        <TableHeaderCell
                            @click="sortProducts"
                            class="p-2 border-b"
                            field="updated_at"
                            :sort-field="sortField"
                            :sort-direction="sortDirection"
                            >Last Updated</TableHeaderCell
                        >
                        <TableHeaderCell field="action">
                            Action
                        </TableHeaderCell>
                    </tr>
                </thead>
                <tbody v-if="products.loading">
                    <tr>
                        <td colspan="6">
                            <div
                                class="flex flex-col items-center justify-center"
                            >
                                <Spinner />
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr v-for="product in products.data" :key="product.id">
                        <td class="p-2 border-b">{{ product.id }}</td>
                        <td class="p-2 border-b">
                            <img
                                :src="product.image_url"
                                alt="image"
                                class="w-12"
                            />
                        </td>
                        <td
                            class="p-2 border-b overflow-hidden whitespace-nowrap max-w-[200px] text-ellipsis"
                        >
                            {{ product.title }}
                        </td>
                        <td class="p-2 border-b">{{ product.price }}</td>
                        <td class="p-2 border-b">
                            {{ product.updated_at }}
                        </td>
                        <td class="p-2 border-b">
                            <Menu
                                as="div"
                                class="relative inline-block text-left"
                            >
                                <div>
                                    <MenuButton
                                        class="inline-flex w-full justify-center rounded-md bg-opacity-20 px-4 py-2 text-sm font-medium text-black"
                                    >
                                        <EllipsisVerticalIcon
                                            class="ml-2 -mr-1 h-5 w-5 text-indigo-800 hover:text-indigo-800"
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
                                        class="absolute z-10 right-0 mt-2 w-32 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        >s
                                        <div class="px-1 py-1">
                                            <MenuItem v-slot="{ active }">
                                                <button
                                                    :class="[
                                                        active
                                                            ? 'bg-violet-500 text-white'
                                                            : 'text-gray-900',
                                                        'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                                    ]"
                                                    @click="
                                                        editProduct(product)
                                                    "
                                                >
                                                    <PencilIcon
                                                        :active="active"
                                                        class="mr-2 h-5 w-5 text-indigo-800"
                                                        aria-hidden="true"
                                                    />
                                                    Edit
                                                </button>
                                            </MenuItem>
                                            <MenuItem v-slot="{ active }">
                                                <button
                                                    :class="[
                                                        active
                                                            ? 'bg-violet-500 text-white'
                                                            : 'text-gray-900',
                                                        'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                                    ]"
                                                    @click="
                                                        deleteProduct(product)
                                                    "
                                                >
                                                    <TrashIcon
                                                        :active="active"
                                                        class="mr-2 h-5 w-5 text-indigo-800"
                                                        aria-hidden="true"
                                                    />
                                                    Delete
                                                </button>
                                            </MenuItem>
                                        </div>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div
                v-if="!products.loading"
                class="flex justify-between items-center mt-5"
            >
                <span class="text-red-800 whitespace-nowrap mr-2">
                    Showing from {{ products.from }} to {{ products.to }}
                </span>
                <nav
                    v-if="products.total > products.limit"
                    class="relative z-0 justify-center rounded-md shadow-sm inline-flex -space-x-px"
                    aria-label="pagination"
                >
                    <a
                        v-for="(link, i) of products.links"
                        :key="i"
                        :disabled="!link.url"
                        href="#"
                        @click.prevent="getForPage($event, link)"
                        class="relative inline-flex items-center px-4 py-2 whitespace-nowrap border font-medium"
                        :class="[
                            link.active
                                ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                                : 'bg-white border-gray-300 hover:bg-gray-50 text-gray-500',
                            i == 0 ? 'rounded-l-md' : '',
                            i == products.links.length - 1
                                ? 'rounded-r-md'
                                : '',
                            !link.url
                                ? 'bg-gray-100 tex-gray-700 cursor-not-allowed'
                                : '',
                        ]"
                        aria-current="page"
                        v-html="link.label"
                    >
                    </a>
                </nav>
            </div>
        </div>
    </div>
</template>
<script setup>
import Spinner from "../core/Spinner.vue";
import { computed, onMounted, ref } from "vue";
import store from "../../store";
import { PRODUCTS_PER_PAGE } from "../../components/core/constants";
import TableHeaderCell from "../core/TableHeaderCell.vue";
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import {
    ChevronDownIcon,
    TrashIcon,
    PencilIcon,
    EllipsisVerticalIcon,
} from "@heroicons/vue/20/solid";
const perPage = ref(PRODUCTS_PER_PAGE);
const search = ref("");
const sortField = ref("updated_at");
const sortDirection = ref("desc");

const products = computed(() => store.state.products);
const emit = defineEmits(["clickEdit"]);
onMounted(() => {
    getProducts();
});

function getProducts(url = null) {
    store.dispatch("getProducts", {
        url,
        search: search.value,
        perPage: perPage.value,
        sort_field: sortField.value,
        sort_direction: sortDirection.value,
    });
}

function getForPage(ev, link) {
    if (!link.url || link.active) {
        return;
    }
    getProducts(link.url);
}

// function sortField accepts the field for each clicked TableHeaderCell, the property field accepted
// as a parameter is passed from the child component
function sortProducts(field) {
    if (sortField.value == field) {
        if (sortDirection.value == "asc") {
            sortDirection.value = "desc";
        } else {
            sortDirection.value = "desc";
        }
    } else {
        sortField.value = field;
        sortDirection.value = "asc";
    }
    getProducts();
}
function editProduct(product) {
    emit("clickEdit", product);
}

function deleteProduct(product) {
    if (!confirm(`Are you sure you want to delete this product?`)) {
        return;
    }
    store.dispatch("deleteProduct", product.id).then((res) => {
        store.dispatch("getProducts");
    });
}
</script>
<style scoped></style>
