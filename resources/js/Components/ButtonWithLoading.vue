<template>
    <button class="btn-primary" v-if="!processing">
        {{ label }}
    </button>
    <button class="btn-primary" disabled v-else>
        {{ loading_label }}
        <i class="fa-solid fa-circle-notch animate-spin ml-2"></i>
    </button>
</template>
  
<script>
export default {
    props: {
        processing: {
            type: Boolean,
            default: false
        },
        label: String,
        loading_label: String
    }
};
</script>