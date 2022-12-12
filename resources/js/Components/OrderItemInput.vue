<template>
  <div 
    class="
      flex flex-col
      space-y-2
      lg:space-y-0 lg:flex-row lg:justify-between lg:items-center
      px-3
      common-container
    "
  >
    <div>
      <select @change="syncItem" v-model="selection" class="input">
        <option value="x">-- Seleccione --</option>
        <option
          v-for="(product, index) in products"
          :key="product.id"
          :value="index"
        >
          {{ product.name }}
        </option>
      </select>
      <a
        v-if="selection != 'x'"
        :href="products[selection].image"
        target="_blank"
        title="Ver imagen del producto"
      >
        <i class="fa-solid fa-eye ml-2 text-gray-300 hover:text-blue-300"></i>
      </a>
    </div>
    <span>${{ getPrice }}</span>
    <input @change="syncItem" v-model.number="quantity" min="1" type="number" class="input" />
    <span>${{ getTotal }}</span>
    <button type="button" @click="$emit('deleteItem')">
      <i
        class="
          fa-solid fa-xmark
          text-gray-300
          hover:text-red-300
          cursor-pointer
        "
      ></i>
    </button>
  </div>
</template>

<script>
import Input from "@/Jetstream/Input.vue";

export default {
  data() {
    return {
      selection: "x",
      quantity: 0,
      products: [
        {
          id: 1,
          name: "Llavero KIA",
          price: 49.15,
          currency: "MXN",
          image: "https://loremflickr.com/640/360",
        },
        {
          id: 2,
          name: "Portaplacas ABS KIA",
          price: 19.2,
          currency: "MXN",
          image: "https://loremflickr.com/640/360",
        },
      ],
    };
  },
  emits: ['deleteItem', 'syncItem'],
  props: {
    id: Number
  },
  components: {
    Input,
  },
  computed: {
    getTotal() {
      return this.selection != "x"
        ? (this.quantity * this.products[this.selection].price).toFixed(2) +
            " " +
            this.products[this.selection].currency
        : 0;
    },
    getPrice() {
      return this.selection != "x"
        ? this.products[this.selection].price + ' ' +
            this.products[this.selection].currency +
            " / Unidad"
        : 0;
    },
    syncItem() {
      if (this.selection != 'x' && this.quantity)
        this.$emit('syncItem', {
          id: this.id,
          product_id: this.products[this.selection].id,
          quantity: this.quantity,
        });
    },
  },
};
</script>