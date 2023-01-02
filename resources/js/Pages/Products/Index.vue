<template>
  <AppLayout title="Productos">
    <div class="px-8 py-5">
      <div class="flex justify-between items-center">
        <h1 class="text-lg lg:text-xl font-bold text-gray-600 ">Mis productos</h1>
        <button @click="side_modal = true; new_product = true;" class="btn-primary">Solicitar nuevo producto</button>
      </div>
      <div class="lg:grid grid-cols-3 gap-x-3 mt-4">
        <ProductCard v-for="(product, index) in products" :key="index" :product="product" class="mb-3" />
      </div>
      <div class="flex justify-between items-center mt-7">
        <h1 class="text-lg lg:text-xl font-bold text-gray-600 ">Otros productos</h1>
        <button @click="side_modal = true; new_product = false;" class="btn-primary"
          :disabled="!quote_form.products.length">Solicitar cotización</button>
      </div>
      <div class="lg:grid grid-cols-3 gap-x-3 mt-4">
        <ProductCard v-for="(product, index) in other_products" :key="index" :product="product"
          @selected="selection(product.id)" canSelect class="mb-3" />
      </div>
    </div>
    <DetailsModal :show="side_modal" @close="side_modal = false">
      <template #title>
        <h1 v-if="new_product" class="text-blue-600 text-xl font-semibold">
          Solicitar nuevo producto
        </h1>
        <h1 v-else class="text-blue-600 text-xl font-semibold">
          Cotizar producto(s)
        </h1>
        <p v-if="quote_form.hasErrors" id="validation" class="text-red-600 text-sm">Error: Las cantidades a cotizar
          deben de ser mayor a 0</p>
      </template>
      <template #content>
        <div v-if="new_product">
          <div>
            <Label class="dark:text-gray-300" value="Descripción del producto" />
            <textarea v-model="new_product_form.description" class="input w-full !h-32"></textarea>
          </div>
          <div>
            <Label class="dark:text-gray-300" value="Imágenes de muestra o referencias" />
            <FileUploader @input="new_product_form.resources = $event.target.files" />
          </div>
        </div>
        <div v-else>
          <div v-for="(selection, index) in quote_form.products" :key="selection.product_id"
            class="p-2 my-2 border-2 rounded-lg border-blue-200 bg-blue-50">
            <div class="flex items-center py-2">
              <a :href="other_products.find(item => item.id === selection.product_id)?.image" target="_blank">
                <img class="mr-2 w-12 h-12 rounded-md"
                  :src="other_products.find(item => item.id === selection.product_id)?.image" />
              </a>
              <div class="flex flex-col">
                <p class="text-gray-600 font-semibold text-sm truncate"> {{ other_products.find(item => item.id ===
                    selection.product_id)?.name
                }} </p>
              </div>
            </div>
            <Label class="dark:text-gray-300" value="Cantidad a cotizar" />
            <input v-model="quote_form.products[index].quantity" type="number" class="input">
            <Label class="dark:text-gray-300" value="Notas" />
            <textarea v-model="quote_form.products[index].notes" class="input w-full !h-20"></textarea>
          </div>
        </div>

      </template>
      <template #footer>
        <div class="flex">
          <ButtonWithLoading v-if="new_product" @click="new_product_form.post(route('products.request-new'))"
            :processing="new_product_form.processing" label="Solicitar" loading_label="Enviando..." />
          <ButtonWithLoading v-else @click="sendQuoteForm" :processing="quote_form.processing" label="Cotizar"
            loading_label="Enviando..." />
          <button @click="side_modal = false" class="btn-secondary mx-1">
            Cerrar
          </button>
        </div>
      </template>
    </DetailsModal>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import OrdersTable from "@/Components/OrdersTable.vue";
import ProductCard from "@/Components/ProductCard.vue";
import DetailsModal from "@/Components/DetailsModal.vue";
import FileUploader from "@/Components/FileUploader.vue";
import ButtonWithLoading from "@/Components/ButtonWithLoading.vue";
import Label from "@/Jetstream/Label.vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
  data() {
    const new_product_form = useForm({
      description: null,
      resources: []
    });

    let quote_form = useForm({
      products: [],
    });

    return {
      new_product_form,
      quote_form,
      validation_message: null,
      side_modal: false,
      new_product: false,
      products: [
        {
          id: 1,
          name: "Porta placas con emblema",
          features: ['Emblema con tu logo', 'portaplacas de ABS negro', 'Impresión en la parte superior (de 1 a 3 tintas)'],
          price: 19.43,
          image: 'https://loremflickr.com/640/360'
        },
        {
          id: 2,
          name: "Llavero con medallón",
          features: ['Emblema con tu logo', 'Metal cromado', 'medallón con grabado láser'],
          price: 44.90,
          image: 'https://loremflickr.com/640/360'
        },
        {
          id: 3,
          name: "Tapete de uso rudo",
          features: ['Emblema con tu logo', 'Hule resistente color negro'],
          price: 365.20,
          image: 'https://loremflickr.com/640/360'
        },
        {
          id: 4,
          name: "Porta placas con emblema",
          features: ['Emblema con tu logo', 'portaplacas de ABS negro', 'Impresión en la parte superior (de 1 a 3 tintas)'],
          price: 19.43,
          image: 'https://loremflickr.com/640/360'
        },
      ],
      other_products: [
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
    };
  },
  components: {
    AppLayout,
    OrdersTable,
    ProductCard,
    DetailsModal,
    Label,
    FileUploader,
    ButtonWithLoading,
  },
  methods: {
    selection(product_id, index) {
      if (this.quote_form.products.find(item => item.product_id === product_id)) {
        const index = this.quote_form.products.findIndex(item => item.product_id === product_id);
        this.quote_form.products.splice(index, 1);
      } else {
        this.quote_form.products.push({ product_id: product_id, quantity: null, notes: null });
      }
    },
    sendQuoteForm() {
      if (this.quote_form.products.some(element => element.quantity === null || element.quantity <= 0)) {
        this.quote_form.hasErrors = true;
      } else {
        this.validation_message = null;
        this.quote_form.post(route('products.quote'));
      }
    },
  }
};
</script>