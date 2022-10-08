<template>
  <AppLayout title="Cotizacions">
    <div class="px-8 py-5">
      <div class="flex justify-end my-3">
        <button class="btn-primary">Solicitar</button>
      </div>
      <QuotationTable :quotations="{data: [12, 22]}" :filters="{}" filterURL="" />
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import QuotationTable from "@/Components/QuotationTable.vue";
export default {
  components: {
    AppLayout,
    QuotationTable,
  },
};
</script>