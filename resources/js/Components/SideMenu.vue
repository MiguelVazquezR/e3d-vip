<template>
    <!-- sidebar -->
    <div class="h-screen hidden lg:block shadow-lg relative">
        <div class="bg-white h-full dark:bg-gray-700">
            <div class="flex items-center justify-center pt-12 pb-2">
                <JetApplicationMark class="px-6" />
            </div>
            <nav class="mt-6">
                <div>
                    <JetNavLink :href="route('orders.index')" :active="route().current('orders.*')">
                        <span class="text-left">
                            <i class="fa-solid fa-box"></i>
                        </span>
                        <span class="mx-4 text-sm font-normal"> Órdenes </span>
                    </JetNavLink>
                    <JetNavLink :href="route('awards.index')" :active="route().current('awards.*')">
                        <span class="text-left">
                            <i class="fa-solid fa-gift"></i>
                        </span>
                        <span class="mx-4 text-sm font-normal"> Premios </span>
                    </JetNavLink>
                    <JetNavLink :href="route('products.index')" :active="route().current('products.*')">
                        <span class="text-left">
                            <i class="fa-solid fa-boxes-stacked"></i>
                        </span>
                        <span class="mx-4 text-sm font-normal"> Productos </span>
                    </JetNavLink>
                    <JetNavLink :href="route('chat.index')" :active="route().current('chat.*')">
                        <span class="text-left">
                           <i class="fa-solid fa-comments"></i>
                        </span>
                        <span class="mx-4 text-sm font-normal"> Mensajería </span>
                    </JetNavLink>
                    <JetNavLink :href="route('quotations.index')" :active="route().current('quotations.*')">
                        <span class="text-left">
                           <i class="fa-solid fa-file-invoice-dollar"></i>
                        </span>
                        <span class="mx-4 text-sm font-normal"> Cotizaciones </span>
                    </JetNavLink>
                    <JetNavLink :href="route('pointsRubric.index')" :active="route().current('pointsRubric.*')">
                        <span class="text-left">
                            <i class="fa-solid fa-sheet-plastic"></i>
                        </span>
                        <span class="mx-4 text-sm font-normal"> Rúbrica de Puntos </span>
                    </JetNavLink>
                    <JetNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        <span class="text-left">
                            <i class="fa-solid fa-headset"></i>
                        </span>
                        <span class="mx-4 text-sm font-normal"> Reportar errores </span>
                    </JetNavLink>
                </div>
            </nav>
        </div>
    </div>
</template>
<script>
import JetNavLink from "@/Jetstream/NavLink.vue";JetApplicationMark
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";

export default {
    components: {
        JetNavLink,
        JetApplicationMark,
    }
}
</script>