<template>
    <div class="h-full bg-gray-200 p-5">
        <div class="flex justify-between space-x-3">
            <h1 class="text-2xl font-semibold">Products</h1>
            <button
                @click="openModal"
                class="bg-indigo-800 text-white focus:ring-2 ring-offset-1 py-2 px-3"
            >
                Add new product
            </button>
        </div>
        <ProductsModal
            v-model="showModal"
            :product="productModel"
            @close="onModalClose"
        />
        <!-- Card-->
        <ProductsTable @clickEdit="editProduct" />
    </div>
</template>
<script setup>
import ProductsTable from "./ProductsTable.vue";
import ProductsModal from "./ProductsModal.vue";
import { ref } from "vue";
import store from "../../store";

const productModel = ref({
    id: "",
    title: "",
    image: "",
    description: "",
    price: "",
});

const showModal = ref(false);
//open modal
function openModal() {
    showModal.value = true;
}
//fet all product details
function editProduct(product) {
    store.dispatch("getProduct", product.id).then(({ data }) => {
        productModel.value = data;
        openModal();
    });
}
//clear modal
function onModalClose() {
    productModel.value = {
        id: "",
        title: "",
        image: "",
        description: "",
        price: "",
    };
}
</script>
<style scoped></style>
