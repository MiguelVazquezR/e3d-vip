<template>
  <AppLayout title="Productos">
    <div class="px-8 py-5">
        <div class="lg:grid grid-cols-3 gap-x-3">
            <ProductCard />
        </div>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import OrdersTable from "@/Components/OrdersTable.vue";
import ProductCard from "@/Components/ProductCard.vue";

export default {
  components: {
    AppLayout,
    OrdersTable,
    ProductCard,
  },
};
</script>