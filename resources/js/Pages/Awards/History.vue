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
          @exchange="show_exchange = true"
          changed
          :award="award"
        />
      </div>
    </div>
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
  },
  props:{
    awards: Object,

  }
};
</script>


