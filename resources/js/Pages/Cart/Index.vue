<template>
    <AuthenticatedLayout>
        <div class="flex justify-center">
            <div class="w-full max-w-4xl">
                <h1 class="text-xl mb-4 text-center">Carrito de Compras</h1>
                <table class="table-auto w-full text-center">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="px-4 py-2">Producto</th>
                            <th class="px-4 py-2">Precio</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="producto in cart" :key="producto.id" class="bg-gray-100">
                            <td class="border px-4 py-2">{{ producto.nombre }}</td>
                            <td class="border px-4 py-2">${{ producto.precio }}</td>
                            <td class="border px-4 py-2">
                                <button>
                                    <a href="{{ route('paypal.create') }}" class="btn btn-primary">Pagar con PayPal</a>

                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    cart: Array
});

const removeFromCart = (id) => {
    // Lógica para eliminar producto del carrito
    axios.delete(`/carrito/eliminar/${id}`).then(() => {
        location.reload();
    });
};
</script>
