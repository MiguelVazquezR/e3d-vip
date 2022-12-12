<template>
  <AppLayout title="Premios">
    <div class="px-8 py-7 mb-4 bg-white grid-cols-4">
      <Tabs :tabs="tabs" />
    </div>
    <div class="flex items-center justify-center">
      <div
        class="
          grid grid-cols-1
          gap-6
          sm:grid-cols-2
          md:grid-cols-2
          lg:grid-cols-4
          xl:grid-cols-4
        "
      >
        <CardAward
          v-for="award in awards"
          :key="award.id"
          @exchange="preapreExchange($event)"
          :changed="false"
          :award="award"
        />
      </div>
    </div>
  </AppLayout>

  <ConfirmationModal :show="show_exchange" @close="show_exchange = false">
    <template #title>
      <p>Canjeo de premio</p>
    </template>
    <template #content>
      <p>
        Está a punto de canjear "Entradas al cine". Se le avisará cuando se le
        haga entrega del mismo, ¿Desea continuar?
      </p>
    </template>
    <template #footer>
      <button @click="exchange" class="btn-primary mr-2">Sí</button>
      <button @click="show_exchange = false" class="btn-secondary">
        Cancelar
      </button>
    </template>
  </ConfirmationModal>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import CardAward from "@/Components/CardAward.vue";
import ConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import Tabs from "@/Components/Tabs.vue";
import { Inertia } from '@inertiajs/inertia';

export default {
  data() {
    return {
      award_to_exchange: null,
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
      Inertia.post(route('awards.trade'),{award_id:this.award_to_exchange});
    },
    preapreExchange(award_id){
      this.award_to_exchange = award_id;
      this.show_exchange = true;


    }
  },
  props: {
    awards: Object,
  },
};
</script>