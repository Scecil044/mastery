<template>
    <TransitionRoot appear :show="show" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black bg-opacity-75" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div
                    class="flex min-h-full items-center justify-center p-4 text-center"
                >
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel
                            class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-[700px] sm:w-full"
                        >
                            <Spinner
                                v-if="loading"
                                class="absolute left-0 top-0 bottom-0 right-0 flex items-center justify-center bg-white"
                            />
                            <header
                                class="flex justify-between items-center py-3 px-4"
                            >
                                <DialogTitle
                                    as="h3"
                                    className="text-lg font-medium leading-6 text-gray-900"
                                >
                                    {{
                                        product.id
                                            ? `update product: "${props.product.title}"`
                                            : "create new product"
                                    }}
                                </DialogTitle>
                                <button
                                    @click="closeModal()"
                                    class="h-8 w-8 rounded-full flex justify-center items-center cursor-pointer transition-colors hover:bg-[rgba(0,0,0,0.2)]"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-6 h-6"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </header>
                            <form @submit.prevent="onSubmit">
                                <div class="bg-white pb-4 pt-5 px-4">
                                    <CustomInput
                                        class="mb-2"
                                        v-model="product.title"
                                        label="product Title"
                                    />
                                    <CustomInput
                                        class="mb-2"
                                        type="file"
                                        label="product Image"
                                        @change="
                                            (file) => (product.image = file)
                                        "
                                    />
                                    <CustomInput
                                        type="textarea"
                                        class="mb-2"
                                        v-model="product.description"
                                        label="Description"
                                    />
                                    <CustomInput
                                        class="mb-2"
                                        type="number"
                                        label="Price"
                                        prepend="$"
                                        v-model="product.price"
                                    />
                                </div>
                                <footer
                                    class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6"
                                >
                                    <button
                                        type="submit"
                                        class="py-2 px-4 border border-transparent bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-500"
                                    >
                                        Submit
                                    </button>
                                    <button
                                        @click="closeModal"
                                        ref="cancelButtonRef"
                                        type="button"
                                        class="border border-gray-300 bg-white text-black px-4 py-2"
                                    >
                                        Cancel
                                    </button>
                                </footer>
                            </form>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { ref, computed, onUpdated } from "vue";
import Spinner from "../core/Spinner.vue";
import CustomInput from "../core/CustomInput.vue";

import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";
import store from "../../store";
const loading = ref(false);
const product = ref({
    id: props.product.id,
    title: props.product.title,
    description: props.product.description,
    image: props.product.image,
    price: props.product.price,
});
const props = defineProps({
    modelValue: Boolean,
    product: {
        type: Object,
        required: true,
    },
});

const emit = defineEmits(["update:modelValue", "close"]);
const show = computed({
    get: () => props.modelValue,
    set: (value) => emit("update:modelValue", value),
});

function closeModal() {
    show.value = false;
    emit("close");
}

onUpdated(() => {
    product.value = {
        id: props.product.id,
        title: props.product.title,
        description: props.product.description,
        image: props.product.image,
        price: props.product.price,
    };
});

function onSubmit() {
    loading.value = true;
    if (product.value.id) {
        store.dispatch("updateProduct", product.value).then((response) => {
            loading.value = false;
            if (response.status == 200) {
                store.dispatch("getProducts");
                closeModal();
            }
        });
    } else {
        store.dispatch("createProduct", product.value).then((response) => {
            if (response.status == 201) {
                loading.value = false;
                store.dispatch("getProducts");
                closeModal();
            }
        });
    }
}
</script>

<style scoped></style>
