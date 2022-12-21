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
          v-for="product in products"
          :key="product.id"
          :value="product.id"
        >
          {{ product.name }}
        </option>
      </select>
      <a
        v-if="selection != 'x'"
        :href="products.find(product => {product.id === selection})?.image"
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
    id: Number,
    init_state: {
      type: Object,
      default: null,
    },
  },
  components: {
    Input,
  },
  mounted(){
    if(this.init_state!=null){
      this.selection = this.init_state.product_id;
      this.quantity = this.init_state.quantity;
    }
  },
  computed: {
    getTotal() {
      return this.selection != "x"
        ? (this.quantity * this.products.find(product => {return product.id === this.selection}).price).toFixed(2) +
            " " +
            this.products.find(product => {return product.id === this.selection}).currency
        : 0;
    },
    getPrice() {
      return this.selection != "x"
        ? this.products.find(product => {return product.id === this.selection}).price + ' ' +
            this.products.find(product => {return product.id === this.selection}).currency +
            " / Unidad"
        : 0;
    },
    syncItem() {
      if (this.selection != 'x' && this.quantity)
        this.$emit('syncItem', {
          id: this.id,
          product_id: this.selection,
          quantity: this.quantity,
        });
    },
  },
};
</script>