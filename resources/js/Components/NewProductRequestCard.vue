<template>
  <div
    class="bg-blue-100 border-blue-400 rounded-lg shadow-lg border-2 w-full h-auto px-2 py-3 cursor-pointer hover:bg-blue-50 hover:border-blue-300"
  >
    <p class="text-xs">
      <strong>Solicitado: </strong> {{ new_product_request.created_at }}
    </p>
    <p class="text-xs">
      <strong>Descripción: </strong> {{ new_product_request.description }}
    </p>
    <!-- <div class="mt-5">
      <Label class="text-gray-400" value="Archivos" />
      <div class="flex flex-col" v-for="file in new_product_request.media" :key="file.id">
        <div>
          <a
            :href="file.original_url"
            target="_blank"
            class="text-sm text-blue-600 hover:underline"
            >{{ file.name }}
          </a>
        </div>
      </div>
    </div> -->
  </div>
</template>

<script>
import Label from "@/Jetstream/Label.vue";
export default {
  data() {
    return {};
  },
  components: {
    Label,
  },
  props: {
    new_product_request: Object,
  },
  methods: {},
};
</script>
