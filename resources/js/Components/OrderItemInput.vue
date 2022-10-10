<template>
  <div class="flex flex-col space-y-2 lg:space-y-0 lg:flex-row lg:justify-between lg:items-center px-3 common-container">
    <div>
      <select class="input">
        <option value="0" selected disabled>-- Seleccione --</option>
        <option value="1">Llavero Kia</option>
      </select>
      <i class="fa-solid fa-eye ml-2 text-gray-300 hover:text-blue-300 cursor-pointer"></i>
    </div>
    <span>$44.56 MXN / unidad</span>
    <Input type="number" />
    <span>$1499 MXN </span>
    <button @click="$emit('remove')">
      <i class="fa-solid fa-xmark text-gray-300 hover:text-red-300 cursor-pointer"></i>
    </button>
  </div>
</template>

<script>
import Input from '@/Jetstream/Input.vue';

export default {
    props: {
        
    },
    components:{
      Input,
    }
};
</script>