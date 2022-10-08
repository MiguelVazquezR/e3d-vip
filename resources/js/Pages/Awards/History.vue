 <template>      
 <AppLayout title="Premios">
    <div class="px-8 py-7 mb-4 bg-white grid-cols-4">
    <Tabs :tabs="tabs" />
    </div>
    <CardAward @exchange="show_exchange = true" :changed="true"/>
  </AppLayout>

 </template>

 <script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Tabs from "@/Components/Tabs.vue";
import CardAward from "@/Components/CardAward.vue";



export default {
   data() {
    return {
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
    Tabs,
    CardAward,
  }
};
</script>


