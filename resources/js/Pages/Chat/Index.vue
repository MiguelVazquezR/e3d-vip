 <template>
  <AppLayout title="Premios">
    <div class="grid grid-cols-4 gap-x-3 mt-2 h-[calc(100%-0.5rem)]">
      <div class="col-span-3 ml-4">
        <Avatar :user="$page.props.user" />
        <div class="w-full h-2/3 bg-white border border-gray-300 rounded-lg"></div>
        <form
          class="
            flex
            items-center
            mt-2
          "
        >
          <textarea class="input flex-1 mr-3 !h-20" placeholder="Escribe tu mensaje aquí..."></textarea>
          <button type="submit" class="btn-primary">
            <i class="fa-solid fa-paper-plane"></i>
          </button>
        </form>
      </div>
      <div class="flex flex-col space-y-2 mt-12 px-3">
        <div :class="user_selected ? 'p-1 bg-blue-200 border-l-4 border-blue-400' : '' "><Avatar :user="$page.props.user" secondary_info="Gerente de ventas" /></div>
        <div><Avatar :user="$page.props.user" secondary_info="Director general" /></div>
        <div><Avatar :user="$page.props.user" secondary_info="Asistente de dirección" /></div>
      </div>
    </div>
  </AppLayout>
</template>

 <script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Avatar from "@/Components/Avatar.vue";

export default {
  data() {
    return {
      user_selected: true,
    };
  },
  components: {
    AppLayout,
    Avatar,
  },
};
</script>


