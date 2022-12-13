<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Bienvenido" />

    <div class="h-screen text-xl center bg-gray-800 text-white">
        <div v-if="canLogin" class="hidden px-6 py-4 sm:block">
            <Link v-if="$page.props.user" :href="route('orders.index')" class="underline">
                Ingresar
            </Link>

            <template v-else>
                <Link :href="route('login')" class="underline">
                    Iniciar sesión
                </Link>
            </template>
        </div>
    </div>
</template>

<style scoped>
    .center {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .text-xl {
        font-size: 3rem;
    }

    .text-white {
        color: #ffffff;
        color: rgba(160, 174, 192, var(--tw-text-opacity));
    }

    @media (prefers-color-scheme: dark) {
        .dark\:bg-gray-800 {
            background-color: #2d3748;
            background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
        }
    }
</style>
