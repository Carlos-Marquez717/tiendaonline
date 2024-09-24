<template>
    <AuthenticatedLayout>
        <div class="flex justify-center items-start min-h-screen mt-20">
            <!-- Tarjeta negra centrada -->
            <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-lg">
                <h1 class="text-2xl font-bold text-white mb-6 text-center">Agregar Nuevo Producto</h1>

                <form @submit.prevent="submitForm" enctype="multipart/form-data" class="space-y-6">
                    <!-- Campo Nombre -->
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-200 mb-2">Nombre del Producto</label>
                        <input
                            v-model="form.nombre"
                            type="text"
                            id="nombre"
                            class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:border-blue-500"
                            required
                        />
                    </div>

                    <!-- Campo Precio -->
                    <div>
                        <label for="precio" class="block text-sm font-medium text-gray-200 mb-2">Precio del Producto</label>
                        <input
                            v-model="form.precio"
                            type="number"
                            id="precio"
                            class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:border-blue-500"
                            required
                        />
                    </div>

                    <!-- Campo Imagen -->
                    <div>
                        <label for="imagen" class="block text-sm font-medium text-gray-200 mb-2">Imagen del Producto</label>
                        <input
                            @change="handleImageUpload"
                            type="file"
                            id="imagen"
                            accept="image/*"
                            class="w-full px-4 py-2 bg-gray-700 text-gray-200 border border-gray-600 rounded-lg focus:outline-none focus:border-blue-500"
                            required
                        />
                    </div>

                    <!-- Botón de envío -->
                    <div class="text-center">
                        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-700">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    components: {
        AuthenticatedLayout,
    },
    data() {
        return {
            form: {
                nombre: '',
                precio: '',
                imagen: null,
            },
        };
    },
    methods: {
        handleImageUpload(e) {
            this.form.imagen = e.target.files[0];
        },
        submitForm() {
            const formData = new FormData();
            formData.append('nombre', this.form.nombre);
            formData.append('precio', this.form.precio);
            formData.append('imagen', this.form.imagen);

            Inertia.post(route('productos.store'), formData);
        },
    },
};
</script>
