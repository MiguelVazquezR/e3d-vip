<template>
  <div class="flex justify-between items-center py-1 mt-2">
    <Pagination :pagination="quotations" />
    <InputSearch :filters="{}" filterURL="" class="ml-4 flex-1" />
  </div>

  <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
      <table v-if="quotations.data.length" class="min-w-full leading-normal">
        <thead>
          <tr>
            <th class="
                px-5
                py-3
                border-b-2 border-gray-200
                bg-blue-200
                text-left text-xs
                font-semibold
                text-gray-600
                uppercase
                tracking-wider
              ">
              Folio
            </th>
            <th class="
                px-5
                py-3
                border-b-2 border-gray-200
               bg-blue-200
                text-left text-xs
                font-semibold
                text-gray-600
                uppercase
                tracking-wider
              ">
              Productos
            </th>
            <th class="
                px-5
                py-3
                border-b-2 border-gray-200
               bg-blue-200
                text-left text-xs
                font-semibold
                text-gray-600
                uppercase
                tracking-wider
              ">
              Solicitado el
            </th>
            <th class="
                px-5
                py-3
                border-b-2 border-gray-200
               bg-blue-200
                text-right text-xs
                font-semibold
                text-gray-600
                uppercase
                tracking-wider
              ">
              Flete
            </th>
            <th class="
                px-5
                py-3
                border-b-2 border-gray-200
               bg-blue-200
                text-right text-xs
                font-semibold
                text-gray-600
                uppercase
                tracking-wider
              ">
              Herramental
            </th>
            <th class="
                px-5
                py-3
                border-b-2 border-gray-200
               bg-blue-200
                text-right text-xs
                font-semibold
                text-gray-600
                uppercase
                tracking-wider
              ">
              Total sin IVA
            </th>
            <th class="
                px-5
                py-3
                border-b-2 border-gray-200
               bg-blue-200
                text-xs
                font-semibold
                text-gray-600
                text-left
                uppercase
                tracking-wider
              ">
              Status
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="quotation in quotations.data" :key="quotation.id" @click="showDetails(quotation)"
            class="cursor-pointer border-gray-200 bg-white hover:bg-gray-100">
            <td class="px-5 py-5 border-b  text-sm">
              <p class="text-gray-900 whitespace-no-wrap">{{ quotation.folio }}</p>
            </td>
            <td class="px-5 py-5 border-b text-sm">
              <p class="text-gray-900 whitespace-no-wrap">{{ quotation.products.length }}</p>
            </td>
            <td class="px-5 py-5 border-b text-sm">
              <p class="text-gray-900 whitespace-no-wrap">{{ quotation.created_at }}</p>
            </td>
            <td class="px-5 py-5 border-b text-sm text-right">
              <p class="text-gray-900 whitespace-no-wrap">{{ quotation.freight_cost }}</p>
            </td>
            <td class="px-5 py-5 border-b text-sm text-right">
              <p class="text-gray-900 whitespace-no-wrap">{{ quotation.tooling_cost }}</p>
            </td>
            <td class="px-5 py-5 border-b text-sm text-right">
              <p class="text-gray-900 whitespace-no-wrap">{{ quotation.total }}</p>
            </td>
            <td class="px-5 py-5 border-b text-sm">
              <span class="
                    relative
                    inline-block
                    py-1
                    font-semibold
                    leading-tight
                  " :class="quotation.status.style">
                <i class="mr-2" :class="quotation.status.icon"></i>
                <span class="relative">{{ quotation.status.text }}</span>
              </span>
            </td>
          </tr>
        </tbody>
      </table>
      <div v-else class="text-center text-gray-500 my-3">
        No hay ningún registro para mostrar
      </div>
    </div>
  </div>
</template>

<script>
import Pagination from "@/Components/Pagination.vue";
import InputSearch from "@/Components/InputSearch.vue";

export default {
  data() {
    return {
      
    };
  },
  emits: ['details'],
  components: {
    Pagination,
    InputSearch,
  },
  props: {
    quotations: Object,
    filters: Object,
    filterURL: String,
  },
  methods: {
    showDetails(quotation) {
      if (quotation.status_is.in_checking)
        this.$emit("details", quotation);
      else
        this.$inertia.get(route('quotations.show', quotation));
    },
  },
};
</script>