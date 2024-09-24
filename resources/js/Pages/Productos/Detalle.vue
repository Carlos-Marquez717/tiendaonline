<template>
    <AuthenticatedLayout>
        <div class="container mx-auto p-6">
            <!-- Título del producto -->
            <h1 class="text-3xl font-bold text-center mb-4 text-black">{{ producto.nombre }}</h1>

            <!-- Imágenes del producto con lupa -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                <!-- Recorrer las imágenes del producto -->
                <div v-for="imagen in producto.images" :key="imagen.id" class="flex justify-center relative">
                    <div
                        class="image-container"
                        @mouseenter="startZoom($event, imagen.image_path)"
                        @mouseleave="endZoom"
                        @mousemove="zoomIn($event)"
                    >
                        <img
                            :src="`/storage/${imagen.image_path}`"
                            alt="Imagen del Producto"
                            class="w-80 h-80 object-cover rounded-md cursor-pointer"
                        />
                    </div>
                </div>
            </div>

            <!-- Información adicional del producto -->
            <div class="text-center text-white">
                <p class="text-xl font-semibold text-black">Precio: ${{ producto.precio }}</p>
                <p class="mt-4">{{ producto.descripcion }}</p>
            </div>

            <!-- Ventana de zoom centrada -->
            <div v-if="isZoomed" class="zoom-window">
                <div class="zoom-image" :style="{ backgroundImage: `url(${zoomedImage})`, backgroundPosition: zoomBackgroundPosition }"></div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* Contenedor de la imagen */
.image-container {
    position: relative;
    width: 320px;
    height: 320px;
}

/* Ventana de zoom centrada */
.zoom-window {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 400px;
    height: 400px;
    border: 3px solid #d4d4d4;
    background-color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

/* Imagen ampliada dentro de la ventana de zoom */
.zoom-image {
    width: 100%;
    height: 100%;
    background-size: 300%;
    background-repeat: no-repeat;
    border-radius: 10px;
}
</style>

<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    producto: {
        type: Object,
        required: true
    }
});

const isZoomed = ref(false); // Estado para activar el zoom
const zoomedImage = ref(null); // Imagen ampliada
const zoomBackgroundPosition = ref('center'); // Posición del fondo de la imagen ampliada

// Función para activar el zoom y cargar la imagen
const startZoom = (event, imagePath) => {
    zoomedImage.value = `/storage/${imagePath}`;
    isZoomed.value = true;
};

// Función para desactivar el zoom
const endZoom = () => {
    isZoomed.value = false;
};

// Función para mover la imagen dentro de la ventana de zoom
const zoomIn = (event) => {
    const { offsetX, offsetY, target } = event;
    const width = target.offsetWidth;
    const height = target.offsetHeight;

    // Calcular la posición del fondo de la imagen ampliada
    const posX = (offsetX / width) * 100;
    const posY = (offsetY / height) * 100;

    zoomBackgroundPosition.value = `${posX}% ${posY}%`;
};
</script>
