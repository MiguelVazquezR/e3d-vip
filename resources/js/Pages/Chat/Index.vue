 <template>      
 <AppLayout title="Premios">
    <div class="grid grid-cols-4">
        <div class="col-span-3">
        <img src="https://source.unsplash.com/100x100/?portrait" alt="" class="ml-20 mt-7 object-cover w-12 h-12 rounded-full inline-block"> <span>{{'Edgar Sherman'}}</span> 
        <div class="h-full w-4/5 border-2 border-gray-700 ml-20 mt-2 overflow-y-auto rounded-xl">
            <div class="flex">
          <div
            class="max-w-[14rem] lg:max-w-md rounded-lg my-1 mx-3 p-2 pb-0">
            <p class="text-[13px]" style="white-space: pre-line">
              {{ 'message.content' }}
            </p>
            <span class="text-[11px] text-gray-500">{{
              'message.created_at.relative'
            }}</span>
          </div>
        </div>
        <span ref="bottom" class="mt-20"></span>
      </div>
      <form
        class="text-center flex mx-auto items-center justify-center mt-2 col-start-1"
      >
        <textarea
          class="input flex mr-3 w-2/3 !h-16"
          placeholder="Escribe tu mensaje aquí..."
        >
        </textarea>
        <button
          type="submit"
          class="btn-primary">
          <i class="fa-solid fa-paper-plane"></i>
        </button>
      </form>
        </div>
    </div>

  </AppLayout>

 </template>

 <script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
  data() {
    return {};
  },
  components: {
    AppLayout,
  },
};
</script>


