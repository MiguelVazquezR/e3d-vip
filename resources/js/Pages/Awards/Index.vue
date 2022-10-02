<template>
  <AppLayout title="Premios">
    <div class="px-8 py-8 grid-cols-4">
      <CardAward />

    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import CardAward from "@/Components/CardAward.vue";
export default {
  components: {
    AppLayout,
    CardAward,
  },
};
</script>