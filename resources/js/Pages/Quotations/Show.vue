<template>
    <AppLayout :title="'Cotizacion ' + quotation.data.folio">
        {{ quotation }}
    </AppLayout>
  </template>
  
  <script>
  import AppLayout from "@/Layouts/AppLayout.vue";
  
  export default {
    data() {
      return {
        products_list: [
          {
            id: 5,
            name: "Porta placas con emblema",
            features: ['Emblema con tu logo', 'portaplacas de ABS negro', 'Impresión en la parte superior (de 1 a 3 tintas)'],
            image: 'https://loremflickr.com/640/360'
          },
          {
            id: 6,
            name: "Llavero con medallón",
            features: ['Emblema con tu logo', 'Metal cromado', 'medallón con grabado láser'],
            image: 'https://loremflickr.com/640/360'
          },
          {
            id: 7,
            name: "Tapete de uso rudo",
            features: ['Emblema con tu logo', 'Hule resistente color negro'],
            image: 'https://loremflickr.com/640/360'
          },
        ]
      }
    },
    components: {
      AppLayout,
    },
    props: {
      quotation: Object,
    },
    methods: {
      
    },
  };
  </script>