<template>
  <AppLayout title="Órdenes">
    <div class="px-8 py-5">
      <OrdersTable :orders="{data: [12, 22]}" :filters="{}" filterURL="" />
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import OrdersTable from "@/Components/OrdersTable.vue";
export default {
  components: {
    AppLayout,
    OrdersTable,
  },
};
</script>