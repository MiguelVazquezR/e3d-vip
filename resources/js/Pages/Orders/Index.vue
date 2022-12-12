<template>
  <AppLayout title="Órdenes">
    <div class="px-8 py-5">
      <div class="flex justify-end my-2">
        <Link :href="route('orders.create')" class="btn-primary">Crear</Link>
      </div>
      <OrdersTable :orders="sell_orders" :filters="{}" filterURL="" />
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import OrdersTable from "@/Components/OrdersTable.vue";
import {Link} from "@inertiajs/inertia-vue3";

export default {
  components: {
    AppLayout,
    OrdersTable,
    Link,
  },
  props: {
    filters: Object,
    sell_orders: Object,
  }
};
</script>