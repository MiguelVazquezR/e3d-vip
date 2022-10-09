<template>
  <AppLayout title="Crear órden">
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
      <div class="flex justify-end my-2 space-x-40">
        <div>
          <Label value="Costo de flete" />
          <span>$650.00</span>
        </div>
        <div>
          <Label value="Fecha de necesidad" />
          <Input type="date" />
        </div>
      </div>
      <OrderItem
        v-for="(item, index) in form.items"
        :key="item.id"
        @remove="subItems(index)"
        class="my-2"
      />
      <div class="mt-3 text-center">
        <button @click="addNewItem">
          <i class="fa-solid fa-circle-plus text-2xl text-blue-400"></i>
        </button>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Input from "@/Jetstream/Input.vue";
import Label from "@/Jetstream/Label.vue";
import OrderItem from "@/Components/OrderItemInput.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";

export default {
  data() {
    let form = useForm({
        items: [
        {
          id: 1,
          product_id: null,
          quantity: null,
        },
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
    JetValidationErrors,
  },
  methods: {
    addNewItem() {
        this.form.items.push({id: this.next_item_id++, product_id: null, quantity: null});
    },
    subItems(index) {
      if (this.form.items.length > 1) {
        this.form.items.splice(index, 1);
      }
    },
  },
};
</script>