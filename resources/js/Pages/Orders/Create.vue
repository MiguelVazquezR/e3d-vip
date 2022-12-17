<template>
  <AppLayout title="Crear orden">
    <div class="px-8 py-5">
      <JetValidationErrors />
      <div class="flex items-center">
        <Link
          :href="route('orders.index')"
          class="flex items-center text-blue-600"
        >
          <i class="fas fa-long-arrow-alt-left text-lg"></i>
          <span class="ml-2">Atrás</span>
        </Link>
        <p class="text-xl text-blue-600 mx-auto font-semibold">
          Crear nueva orden
        </p>
      </div>
      <form @submit.prevent="submit">
        <div class="grid grid-cols-2 gap-x-2 mt-3">
          <div>
            <Label value="Costo de flete" />
            <p>${{form.freight_cost}}</p>
          </div>
          <div>
            <Label value="Fecha de necesidad" />
            <input v-model="form.requirement_date" type="date" class="input w-full" required />
          </div>
        </div>
        <div class="lg:grid grid-cols-2 gap-x-2">
          <div>
            <Label class="dark:text-gray-300" value="Órden de compra" />
            <FileUploader @input="form.oce = $event.target.files[0]" />
          </div>
          <div>
            <Label class="dark:text-gray-300" value="Notas" />
            <textarea v-model="form.notes" class="input w-full !h-20"></textarea>
          </div>  
        </div>
        <div class="my-2">
          <Label class="dark:text-gray-300" value="Productos" />
          <OrderItem
            v-for="(item, index) in form.items"
            :key="item.id"
            :id="item.id"
            @deleteItem="deleteItem(index)"
            @syncItem="syncItems(index, $event)"
            class="mb-2"
          />
        </div>
        <p v-if="!form.items.length" class="text-sm text-gray-600"> Click al botón de "+" para empezar a agregar productos </p>
        <div class="mt-2 text-center">
          <button type="button" @click="addNewItem">
            <i class="fa-solid fa-circle-plus text-2xl text-blue-400"></i>
          </button>
        </div>
        <button class="btn-primary mr-2 mt-3" v-if="!form.processing">
          Crear
        </button>
        <button class="btn-primary mr-2 mt-3" disabled v-else>
          Cargando... 
          <i class="fa-solid fa-circle-notch animate-spin ml-2"></i>
        </button>
      </form>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Input from "@/Jetstream/Input.vue";
import Label from "@/Jetstream/Label.vue";
import OrderItem from "@/Components/OrderItemInput.vue";
import FileUploader from "@/Components/FileUploader.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";

export default {
  data() {
    let form = useForm({
        requirement_date: null,
        freight_cost: 650.00,
        oce: null,
        notes: null,
        items: [
          {
            id: 1,
            product_id: null,
            quantity: null,
          }
        ],
    })
    return {
      next_item_id: 2,
      form,
    };
  },
  components: {
    AppLayout,
    Input,
    Label,
    OrderItem,
    Link,
    FileUploader,
    JetValidationErrors,
  },
  methods: {
    addNewItem() {
        this.form.items.push({id: this.next_item_id++, product_id: null, quantity: null});
    },
    deleteItem(index) {
      if (this.form.items.length > 1) {
        this.form.items.splice(index, 1);
      }
    },
    syncItems(index, product_obj) {
      this.form.items[index] = product_obj;
    },
    submit() {
      this.form.post(route('orders.store'));
    },
  },
};
</script>