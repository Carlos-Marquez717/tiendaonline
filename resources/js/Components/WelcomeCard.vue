<template>
    <div class="welcome-card">
        <img :src="logoUrl" alt="Logo" class="logo" />

        <h2>Bienvenido A Tu Tienda Virtual</h2>
    </div>
</template>

<script>
export default {
    props: {
        logoUrl: {
            type: String,
            required: true,
        },
    },
};
</script>

<style scoped>
.welcome-card {
    background-color: black;
    color: white;
    padding: 40px; /* Espacio interno */
    border-radius: 10px;
    text-align: center; /* Centra el texto y los elementos dentro */
    width: 600px; /* Ancho */
    height: 300px; /* Ajusta la altura según tus necesidades */
    margin: 20px auto; /* Centrado */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra */
}

.logo {
    max-width: 350px; /* Ajusta el tamaño del logo */
    margin: 0 auto; /* Centra el logo */
    display: block; /* Necesario para centrar con margin: auto */
    margin-bottom: 20px; /* Espacio debajo del logo */
}

h2 {
    font-size: 24px; /* Tamaño del texto */
    margin: 0; /* Elimina márgenes por defecto */
}
</style>
