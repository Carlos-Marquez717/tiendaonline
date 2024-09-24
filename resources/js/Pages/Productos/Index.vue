<template>
    <AuthenticatedLayout>
        <div>
            <h1 class="text-xl mb-4 text-center text-white">Listado de Productos</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div v-for="producto in productos.data" :key="producto.id" class="bg-black text-white rounded-lg p-6 shadow-lg">
                    <div class="flex justify-center mb-2">
                        <!-- Navegar a la página de detalle al hacer clic en la imagen -->
                        <img
                            v-if="producto.images.length > 0"
                            :src="`/storage/${producto.images[0].image_path}`"
                            alt="Imagen del Producto"
                            class="w-50 h-40 object-cover rounded-md cursor-pointer"
                            @click="goToProductDetail(producto.id)"
                        />
                        <img
                            v-else
                            src="/images/placeholder.png"
                            alt="Imagen no disponible"
                            class="w-50 h-40 object-cover rounded-md cursor-pointer"
                            @click="goToProductDetail(producto.id)"
                        />
                    </div>
                    <h2 class="text-lg font-bold text-center">{{ producto.nombre }}</h2>
                    <p class="text-sm text-center">Precio: ${{ producto.precio }}</p>
                    <div class="mt-2 text-center">
                        <button @click="addToCart(producto)" class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600">
                            Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>
            <Pagination :links="productos.links" />
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { router } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';

const props = defineProps({
    productos: {
        type: Object,
        required: true
    }
});

const addToCart = (producto) => {
    axios.post('/carrito/agregar', producto).then(() => {
        alert('Producto agregado al carrito');
    });
};

const goToProductDetail = (id) => {
    router.get(`/producto/${id}/detalle`);
};
</script>
