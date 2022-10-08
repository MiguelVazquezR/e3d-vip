 <template>      
 <AppLayout title="Premios">
    <div class="px-8 py-2 mb-4 bg-white grid-cols-4">
    </div>
        <img src="https://source.unsplash.com/100x100/?portrait" alt="" class="ml-20 mt-7 object-cover w-12 h-12 rounded-full inline-block"> <span>{{'Edgar Sherman'}}</span> 
        <div class="h-2/3 w-2/3 border-4 border-white ml-20 mt-2 rounded-xl">

        </div>
  </AppLayout>

 </template>

 <script>
import AppLayout from "@/Layouts/AppLayout.vue";


export default {
   data() {
    return {
      
    };
  },
  components: {
    AppLayout,
  }
};
</script>


