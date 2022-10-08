<template>
  <AppLayout title="Productos">
    <div class="px-8 py-5">
        <div class="flex justify-between items-center">
          <h1 class="text-xl font-bold text-gray-600 ">Mis productos</h1>
          <button class="btn-primary">Solicitar nuevo producto</button>
        </div>
        <div class="lg:grid grid-cols-3 gap-x-3 mt-4">
            <ProductCard v-for="(product, index) in products" :key="index" :product="product" />
        </div>
        <div class="flex justify-between items-center mt-7">
          <h1 class="text-xl font-bold text-gray-600 ">Otros productos</h1>
          <button class="btn-primary">Solicitar cotización</button>
        </div>
        <div class="lg:grid grid-cols-3 gap-x-3 mt-4">
            <ProductCard v-for="(product, index) in other_products" :key="index" :product="product" canSelect />
        </div>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import OrdersTable from "@/Components/OrdersTable.vue";
import ProductCard from "@/Components/ProductCard.vue";

export default {
  data(){
    return {
      products: [
        {
          title: "Porta placas con emblema",
          features: ['Emblema con tu logo', 'portaplacas de ABS negro', 'Impresión en la parte superior (de 1 a 3 tintas)'],
          price: 19.43
        },
        {
          title: "Llavero con medallón",
          features: ['Emblema con tu logo', 'Metal cromado', 'medallón con grabado láser'],
          price: 44.90
        },
        {
          title: "Tapete de uso rudo",
          features: ['Emblema con tu logo', 'Hule resistente color negro'],
          price: 365.20
        },
      ],
      other_products: [
        {
          title: "Porta placas con emblema",
          features: ['Emblema con tu logo', 'portaplacas de ABS negro', 'Impresión en la parte superior (de 1 a 3 tintas)'],
        },
        {
          title: "Llavero con medallón",
          features: ['Emblema con tu logo', 'Metal cromado', 'medallón con grabado láser'],
        },
        {
          title: "Tapete de uso rudo",
          features: ['Emblema con tu logo', 'Hule resistente color negro'],
        },
      ]
    };
  },
  components: {
    AppLayout,
    OrdersTable,
    ProductCard,
  },
};
</script>