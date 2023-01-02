<template>
  <AppLayout title="Cotizaciones">
    <div class="px-8 py-5">
      <div class="flex justify-end my-3">
        <button class="btn-primary">Solicitar</button>
      </div>
      <QuotationTable :quotations="quotations" :filters="{}" filterURL="" @details="showDetails($event)" />
    </div>

    <DetailsModal :show="side_modal" @close="side_modal = false">
      <template #title>
        <div class="flex flex-col">
          <h1 class="text-blue-600 text-xl font-semibold">
            {{ quotation_detail.folio }}
          </h1>
          <div class="flex justify-between">
            <small class="text-blue-400 text-xs">
              creado el {{ quotation_detail.created_at }}
            </small>
            <small class="text-xs px-2 rounded-md" :class="quotation_detail.status.style">
              <i class="mr-2" :class="quotation_detail.status.icon"></i>
              <span class="relative">{{ quotation_detail.status.text }}</span>
            </small>
          </div>
        </div>
        <p v-if="form.hasErrors" id="validation" class="text-red-600 text-sm">Error: Las cantidades a cotizar
          deben de ser mayor a 0</p>
      </template>
      <template #content>
        <section class="mt-2">
          <h1 class="text-lg dark:text-gray-300 text-gray-600">
            <span>Productos</span>
          </h1>
          <div v-for="(product, index) in quotation_detail.products" :key="product.id" class="p-2 my-2 border-2 rounded-lg border-blue-200 bg-blue-50">
            <div class="flex items-center py-2">
              <a :href="products_list.find(item => item.id === product.product_id)?.image" target="_blank">
                <img class="mr-2 w-12 h-12 rounded-md"
                  :src="products_list.find(item => item.id === product.product_id)?.image" />
              </a>
              <div class="flex flex-col">
                <p class="text-gray-600 font-semibold text-sm truncate"> {{ products_list.find(item => item.id ===
                    product.product_id)?.name
                }} </p>
              </div>
            </div>
            <Label class="dark:text-gray-300" value="Cantidad a cotizar" />
            <input v-model="form.products[index].quantity" type="number" class="input">
            <Label class="dark:text-gray-300" value="Notas" />
            <textarea v-model="form.products[index].notes" class="input w-full !h-20"></textarea>
          </div>
        </section>
      </template>
      <template #footer>
        <div class="flex">
          <button @click="form.put(route('quotations.update', quotation_detail), {onSuccess: () => this.side_modal = false})" class="btn-primary">
            Guardar cambios
          </button>
          <button @click="delete_confirm = true" class="btn-danger mx-1">
            Eliminar
          </button>
        </div>
      </template>
    </DetailsModal>

    <ConfirmationModal :show="delete_confirm" @close="delete_confirm = false">
      <template #title>
        <div>¿Deseas continuar?</div>
      </template>
      <template #content>
        <div>
          Estás a punto de eliminar una cotización, una vez realizado ya no se podrá
          recuperar.
        </div>
      </template>
      <template #footer>
        <div class="flex justify-end">
          <button @click="this.delete()" class="btn-danger mr-3">Eliminar</button>
          <button @click="delete_confirm = false" class="btn-secondary">Cancelar</button>
        </div>
      </template>
    </ConfirmationModal>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import QuotationTable from "@/Components/QuotationTable.vue";
import DetailsModal from "@/Components/DetailsModal.vue";
import ConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import Label from "@/Jetstream/Label.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";

export default {
  data() {
    const form = useForm({
      products: null,
    });

    return {
      form,
      quotation_detail: {},
      side_modal: false,
      delete_confirm: false,
      products_list: [
        {
          id: 5,
          name: "Porta placas con emblema",
          features: ['Emblema con tu logo', 'portaplacas de ABS negro', 'Impresión en la parte superior (de 1 a 3 tintas)'],
          image: 'https://loremflickr.com/640/360'
        },
        {
          id: 6,
          name: "Llavero con medallón",
          features: ['Emblema con tu logo', 'Metal cromado', 'medallón con grabado láser'],
          image: 'https://loremflickr.com/640/360'
        },
        {
          id: 7,
          name: "Tapete de uso rudo",
          features: ['Emblema con tu logo', 'Hule resistente color negro'],
          image: 'https://loremflickr.com/640/360'
        },
      ]
    }
  },
  components: {
    AppLayout,
    QuotationTable,
    DetailsModal,
    ConfirmationModal,
    Label,
    Link,
  },
  props: {
    quotations: Object,
  },
  methods: {
    showDetails(item) {
      // load products to form 
      // item.products.forEach(product => {
      //   this.form.products.push(this.quotation_detail.products);
      // });
      this.form.products = item.products;

      this.quotation_detail = item;
      this.side_modal = true;
    },
    deleteItem() {
      this.$inertia.delete(route('quotations.destroy', this.quotation_detail));
    },
  },
};
</script>