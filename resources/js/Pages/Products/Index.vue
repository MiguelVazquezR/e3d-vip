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
        <button @click="side_modal = true; new_product = false;" class="btn-primary">Solicitar cotización</button>
      </div>
      <div class="lg:grid grid-cols-3 gap-x-3 mt-4">
        <ProductCard v-for="(product, index) in other_products" :key="index" :product="product" canSelect
          class="mb-3" />
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
      </template>
      <template #content>
        <div v-if="new_product" class="mt-1">
          <div>
            <Label class="dark:text-gray-300" value="Descripción del producto" />
            <textarea v-model="new_product_form.description" class="input w-full !h-32"></textarea>
          </div>
          <div>
            <Label class="dark:text-gray-300" value="Imágenes de muestra o referencias" />
            <FileUploader @input="new_product_form.resources = $event.target.files" />
          </div>
        </div>
        <div v-else class="mt-1">
          <div>
            <div class="flex items-center py-2">
              <a href="https://loremflickr.com/640/360" target="_blank">
                <img class="mr-2 w-12 h-12 rounded-md" src="https://loremflickr.com/640/360" />
              </a>
              <div class="flex flex-col">
                <p class="text-gray-600 font-semibold text-sm truncate"> Nombre del producto </p>
              </div>
            </div>
            <Label class="dark:text-gray-300" value="Cantidad a cotizar" />
            <input  type="number" class="input">
            <Label class="dark:text-gray-300" value="Notas" />
            <textarea  class="input w-full !h-20"></textarea>
          </div>
        </div>

      </template>
      <template #footer>
        <div class="flex">
          <ButtonWithLoading v-if="new_product" @click="new_product_form.post(route('products.request-new'))"
            :processing="new_product_form.processing" label="Solicitar" loading_label="Enviando..." />
          <ButtonWithLoading v-else @click="quote_form.post(route('products.request-new'))"
            :processing="quote_form.processing" label="Cotizar" loading_label="Enviando..." />
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
      side_modal: false,
      new_product: false,
      products: [
        {
          id: 1,
          title: "Porta placas con emblema",
          features: ['Emblema con tu logo', 'portaplacas de ABS negro', 'Impresión en la parte superior (de 1 a 3 tintas)'],
          price: 19.43
        },
        {
          id: 2,
          title: "Llavero con medallón",
          features: ['Emblema con tu logo', 'Metal cromado', 'medallón con grabado láser'],
          price: 44.90
        },
        {
          id: 3,
          title: "Tapete de uso rudo",
          features: ['Emblema con tu logo', 'Hule resistente color negro'],
          price: 365.20
        },
        {
          id: 4,
          title: "Porta placas con emblema",
          features: ['Emblema con tu logo', 'portaplacas de ABS negro', 'Impresión en la parte superior (de 1 a 3 tintas)'],
          price: 19.43
        },
      ],
      other_products: [
        {
          id: 5,
          title: "Porta placas con emblema",
          features: ['Emblema con tu logo', 'portaplacas de ABS negro', 'Impresión en la parte superior (de 1 a 3 tintas)'],
        },
        {
          id: 6,
          title: "Llavero con medallón",
          features: ['Emblema con tu logo', 'Metal cromado', 'medallón con grabado láser'],
        },
        {
          id: 7,
          title: "Tapete de uso rudo",
          features: ['Emblema con tu logo', 'Hule resistente color negro'],
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
};
</script>