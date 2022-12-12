<template>
  <AppLayout title="Rubrica de puntos">
    <div class="px-8 py-5">
        <h2 class="py-4 px-5 text-xl text-blue-500 font-semibold">Rúbrica de Puntos</h2>
        <div class="bg-white rounded-lg w-full h-auto px-5 py-3 shadow-md">
            <span class="text-blue-500">Generar Órden --> 1 pt</span>
                <p class="text-gray-500 pl-3 pt-1 pb-5">-Al generar una órden de compra automáticamente se sumara 1 punto a tu cuenta.</p>

            <span class="text-blue-500">Confirmación de Pago --> 1 pt</span>
                <p class="text-gray-500 pl-3 pt-1 pb-5">-Al confirmarse el pago de su órden, se sumará 1 punto a su cuenta.</p>

            <span class="text-blue-500">Pago en una Semana --> 2 pts</span>
                <p class="text-gray-500 pl-3 pt-1 pb-5">-Si se hace el pago antes de terminar la primera semana se sumarán 2 puntos a su cuenta.</p>

            <span class="text-blue-500">Pago 100% por Adelantado --> 4 pts</span>
                <p class="text-gray-500 pl-3 pt-1 pb-5">-Si se hace el pago liquidando la órden por adelantado se sumarán 4 puntos a su cuenta.</p>

            <span class="text-blue-500">Confirmación por Correo de Arribo de Mercancía --> 1 pt</span>
                <p class="text-gray-500 pl-3 pt-1 pb-5">-Se sumará 1 punto a su cuenta si se confirma el arrivo de su mercancía vía correo electrónico.</p>

            <span class="text-blue-500">Solicitar Nuevo Producto --> 2 pts</span>
                <p class="text-gray-500 pl-3 pt-1 pb-5">-Solicitar un nuevo producto sumará 2 puntos a su cuenta.</p>

            <span class="text-blue-500">Recomendación para otro Cliente --> 2 pts</span>
                <p class="text-gray-500 pl-3 pt-1 pb-5">-Se sumarán 2 puntos a su cuenta por cada recomendación que haga de nuestros productos.</p>
        </div>
      
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import {Link} from "@inertiajs/inertia-vue3";

export default {
  components: {
    AppLayout,
    Link,
  },
};
</script>