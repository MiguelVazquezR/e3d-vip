<template>
  <div class="flex justify-between items-center py-1 mt-2">
    <!-- <Pagination :pagination="{}" /> -->
    <InputSearch :filters="{}" filterURL="" class="mb-2 ml-4 flex-1" />
  </div>

  <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
      <table v-if="orders.data.length" class="min-w-full leading-normal">
        <thead>
          <tr>
            <th
              class="
                px-5
                py-3
                border-b-2 border-gray-200
                bg-blue-200
                text-left text-xs
                font-semibold
                text-gray-600
                uppercase
                tracking-wider
              "
            >
              Folio
            </th>
            <th
              class="
                px-5
                py-3
                border-b-2 border-gray-200
               bg-blue-200
                text-left text-xs
                font-semibold
                text-gray-600
                uppercase
                tracking-wider
              "
            >
              Productos
            </th>
            <th
              class="
                px-5
                py-3
                border-b-2 border-gray-200
               bg-blue-200
                text-left text-xs
                font-semibold
                text-gray-600
                uppercase
                tracking-wider
              "
            >
              Creado el
            </th>
            <th
              class="
                px-5
                py-3
                border-b-2 border-gray-200
               bg-blue-200
                text-left text-xs
                font-semibold
                text-gray-600
                uppercase
                tracking-wider
              "
            >
              Status
            </th>
            <th
              class="
                px-5
                py-3
                border-b-2 border-gray-200
                bg-blue-200
                text-left text-xs
                font-semibold
                text-gray-600
                uppercase
                tracking-wider
              "
            >
              
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="order in orders.data" :key="order.id" class="cursor-pointer border-gray-200 bg-white hover:bg-gray-100">
            <td class="px-5 py-5 border-b  text-sm">
              <p class="text-gray-900 whitespace-no-wrap">Admin</p>
            </td>
            <td class="px-5 py-5 border-b text-sm">
              <p class="text-gray-900 whitespace-no-wrap">Admin</p>
            </td>
            <td class="px-5 py-5 border-b text-sm">
              <p class="text-gray-900 whitespace-no-wrap">Jan 21, 2020</p>
            </td>
            <td class="px-5 py-5 border-b text-sm">
              <span
                class="
                  relative
                  inline-block
                  px-3
                  py-1
                  font-semibold
                  text-green-900
                  leading-tight
                "
              >
                <span
                  aria-hidden
                  class="absolute inset-0 bg-green-200 opacity-50 rounded-full"
                ></span>
                <span class="relative">Entregado</span>
              </span>
            </td>
            <td class="px-5 py-5 border-b text-sm">
              <div class="flex justify-end w-full text-xs text-gray-300">
                <Link href="#" class="mr-2 hover:text-blue-300">
                  <i class="fa-solid fa-pen"></i>
                </Link>
                <button
                  @click="
                    delete_confirm = true;
                    item_to_delete = order;
                  "
                  class="mr-2 hover:text-red-300"
                >
                  <i class="fa-solid fa-trash"></i>
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <div v-else class="text-center text-gray-500 my-3">
        No hay ningún registro para mostrar
      </div>
    </div>
  </div>

  <ConfirmationModal :show="delete_confirm" @close="delete_confirm = false">
    <template #title>
      <div>¿Deseas continuar?</div>
    </template>
    <template #content>
      <div>
        Estás a punto de eliminar una orden, una vez realizado ya no se podrá
        recuperar
      </div>
    </template>
    <template #footer>
      <div class="flex justify-end">
        <DangerButton @click="this.delete()" class="mr-3"
          >Eliminar</DangerButton
        >
        <SecondaryButton @click="delete_confirm = false"
          >Cancelar</SecondaryButton
        >
      </div>
    </template>
  </ConfirmationModal>
</template>

<script>
import Pagination from "@/Components/Pagination.vue";
import InputSearch from "@/Components/InputSearch.vue";
import { Link } from "@inertiajs/inertia-vue3";
import ConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import DangerButton from "@/Jetstream/DangerButton.vue";
import SecondaryButton from "@/Jetstream/SecondaryButton.vue";

export default {
  data() {
    return {
      delete_confirm: false,
      item_to_delete: {},
    };
  },
  components: {
    Pagination,
    InputSearch,
    Link,
    DangerButton,
    ConfirmationModal,
    SecondaryButton,
  },
  props: {
    orders: Object,
    filters: Object,
    filterURL: String,
  },
  methods: {
    delete() {
      this.$inertia
        .delete
        // this.route("homeworks.destroy", this.item_to_delete)
        ();
      this.delete_confirm = false;
    },
    // showDetails(prop) {
    //   this.$emit("details", prop);
    // },
  },
};
</script>