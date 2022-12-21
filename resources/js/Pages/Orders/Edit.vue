<template>
  <AppLayout title="Editar orden">
    <div class="px-8 py-5">
      <JetValidationErrors />
      <div class="flex items-center">
        <Link :href="route('orders.index')" class="flex items-center text-blue-600">
        <i class="fas fa-long-arrow-alt-left text-lg"></i>
        <span class="ml-2">Atrás</span>
        </Link>
        <p class="text-xl text-blue-600 mx-auto font-semibold">
          Crear nueva orden
        </p>
      </div>
      <form @submit.prevent="update">
        <div class="grid grid-cols-2 gap-x-2 mt-3">
          <div>
            <Label value="Costo de flete" />
            <p>${{ form.freight_cost }}</p>
          </div>
          <div>
            <Label value="Fecha de necesidad" />
            <input v-model="form.requirement_date.split('T')[0]" type="date" class="input w-full" required />
            <!-- {{ form.items}} -->
          </div>
        </div>
        <div class="lg:grid grid-cols-3 gap-x-2">
          <div>
            <Label class="dark:text-gray-300" value="Archivos subidos" />
            <div class="flex flex-col rounded-md border bg-gray-50 px-2 py-1" v-for="(file, index) in media" :key="file.id">
              <div>
                <a :href="file.original_url" target="_blank" class="text-sm text-blue-500 hover:underline">{{ file.name
                }}
                </a>
                <button type="button" @click="
                  show_confirmation = true;
                  file_to_delete = index;
                " title="Remover archivo">
                  <span class="
                        text-gray-500
                        ml-2
                        font-bold
                        text-xs
                        hover:text-red-500
                      "><i class="fa-solid fa-trash-can"></i></span>
                </button>
              </div>
            </div>
          </div>
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
          <OrderItem v-for="(item, index) in form.items" :key="item.id" :init_state="item" :id="item.id" @deleteItem="deleteItem(index)"
            @syncItem="syncItems(index, $event)" class="mb-2" />
        </div>
        <p v-if="!form.items.length" class="text-sm text-gray-600"> Click al botón de "+" para empezar a agregar
          productos </p>
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
    <ConfirmationModal :show="show_confirmation" @close="show_confirmation = false">
      <template #title> Elimina archivo </template>
      <template #content>
        Estas a punto de eliminar un archivo subido anteriormente. ¿Deseas
        continuar?
      </template>
      <template #footer>
        <button class="btn-danger" @click="deleteFile">Si, eliminar</button>
        <button class="btn-secondary ml-2" @click="show_confirmation = false">
          Cancelar
        </button>
      </template>
    </ConfirmationModal>
  </AppLayout>

</template>
  
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Input from "@/Jetstream/Input.vue";
import Label from "@/Jetstream/Label.vue";
import ConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import OrderItem from "@/Components/OrderItemInput.vue";
import FileUploader from "@/Components/FileUploader.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";

export default {
  data() {
    const form = useForm({
      requirement_date: this.order.requirement_date,
      freight_cost: this.order.freight_cost,
      oce: null,
      notes: this.order.notes,
      items: [],
    });

    return {
      form,
      next_item_id: 0,
      show_confirmation: false,
      file_to_delete: null,
    };
  },
  components: {
    AppLayout,
    Input,
    Label,
    OrderItem,
    Link,
    FileUploader,
    ConfirmationModal,
    JetValidationErrors,
  },

  props: {
    order: Object,
    media: Array,
  },
  mounted() {
    console.log(this.order);
    this.order.sell_ordered_products.forEach((product, index) => {
      this.form.items.push({ id: (index + 1), product_id: product['product_id'], quantity: product['quantity'] });
    });

    this.next_item_id = this.order.sell_ordered_products.length + 1;
  },
  methods: {
    update() {
      if (this.form.resources.length)
        this.form.post(route("orders.update-with-resources", this.order.id));
      else
        this.form.put(route("orders.update", this.order.id));
    },
    destroy() {
      this.form.delete(this.route("orders.destroy", this.order.id));
    },
    deleteFile() {
      this.show_confirmation = false;
      axios
        .post(route("orders.delete-file"), {
          file_id: this.media[this.file_to_delete].id,
          order_id: this.order.id
        })
        .then(() => {
          this.media.splice(this.file_to_delete, 1);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
  