<template>
  <div @click="selection" @mouseenter="enable_selection = canSelect" @mouseleave="enable_selection = (false || is_selected)" class="relative pl-4 pr-4 pt-1" :class="{'cursor-pointer': canSelect}">
    <div class="absolute top-0 left-0 bg-white rounded-lg shadow-lg border-2 w-1/2 h-3/4">
      <img :src="product.image" class="object-cover h-full w-full rounded-lg">
    </div>
    <div v-if="enable_selection" class="h-7 w-7 absolute top-0 right-0 bg-white rounded-full border -mt-1 flex justify-center items-center">
      <i v-if="is_selected" class="fa-solid fa-circle text-blue-400"></i>
    </div>
    <div class="bg-white rounded-lg shadow-lg w-full h-56" :class="is_selected ? 'border border-blue-400' : '' ">
      <div class="ml-[50%] h-3/4 p-2">
        <h1 class="font-bold text-sm text-center">{{ product.name }}</h1>
        <ul class="mt-2">
          <li v-for="(feature, index) in product.features" :key="index" class="text-xs">
            <i class="fa-solid fa-circle-dot mr-1 text-[10px] text-blue-500"></i> {{feature}}
          </li>
        </ul>
      </div>
      <div class="h-1/4 pb-2 pt-4 px-4 text-center text-sm">
        <p v-if="product.price">${{ product.price }}MXN / unidad</p>
        <p v-else class="text-blue-600">Selecciona este producto y click en "solicitar cotización"</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      is_selected: false,
      enable_selection: false,
    };
  },
  emits: ['selected'],
  props:{
    canSelect: {
      type: Boolean,
      default: false,
    },
    product: {
      type: Object,
      default: {}
    },
  },
  methods: {
    selection() {
      if(this.canSelect) {
        this.is_selected = !this.is_selected;
        this.$emit('selected');
      }
    }
  }
};
</script>