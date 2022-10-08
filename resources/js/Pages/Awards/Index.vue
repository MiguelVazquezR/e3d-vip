<template>
  <AppLayout title="Premios">
    <div class="px-8 py-7 mb-4 bg-white grid-cols-4">
    <Tabs :tabs="tabs" />
    </div>
      <CardAward @exchange="show_exchange = true" :changed="false" />
  </AppLayout>

  <ConfirmationModal :show="show_exchange" @close="show_exchange=false">
    <template #title>
      <p>Canjeo de premio</p>
    </template>
    <template #content>
      <p>
        Está a punto de canjear "Entradas al cine". Se le
        avisará cuando se le haga entrega del mismo, ¿Desea continuar?
      </p>
    </template>
    <template #footer>
      <button @click="exchange" class="btn-primary mr-2">Sí</button>
      <button @click="show_exchange=false" class="btn-secondary">Cancelar</button>
    </template>
  </ConfirmationModal>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import CardAward from "@/Components/CardAward.vue";
import ConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import Tabs from "@/Components/Tabs.vue";

export default {
  data() {
    return {
      show_exchange: false,
      show_delete: false,
tabs: [
        {
          label: "Todos",
          url: "awards.index",
        },
        {
          label: "Historial",
          url: "awards.history",
        },
      ],
    };
  },
  components: {
    AppLayout,
    CardAward,
    ConfirmationModal,
    Tabs,
  },
  methods: {
    exchange() {
      this.show_exchange = false;
    },
  },
};
</script>