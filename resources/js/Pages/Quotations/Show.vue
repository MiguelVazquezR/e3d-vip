<template>
  <AppLayout :title="'Cotizacion ' + quotation.data.folio">
    <div>
      <Link :href="route('quotations.index')">
      <button class="btn-primary my-3 ml-2">
        <i class="fa-solid fa-arrow-left mr-1"></i>
        Regresar
      </button>
      </Link>
      <!-- <button class="btn-primary my-3 ml-2">
        <i class="fa-solid fa-print mr-1"></i>
        Imprimir
      </button> -->
      <button @click="show_confirmation = true" v-if="!quotation.data.status_is.approved" class="btn-primary my-3 ml-2">
        <i class="fa-regular fa-circle-check mr-1"></i>
        Aprobar y generar orden
      </button>
      <span v-else class="text-sm text-green-600 ml-2 rounded-full px-1 py-px bg-green-100">Orden generada</span>
    </div>
    <section class="bg-white px-2 py-1 relative">

      <!-- logo -->
      <div class="text-center">
        <ApplicationLogo class="h-auto w-3/12 inline-block" />
      </div>

      <!-- content -->
      <div class="text-xs">

        <!-- header -->
        <div>
          <p class="flex justify-end ml-auto font-bold mr-6 text-xs text-gray-700">
            Guadalajara, Jalisco {{ quotation.data.created_at }}
          </p>
          <p class="w-11/12 mx-auto font-bold mt-2 text-gray-700">
            Estimado {{ quotation.data.user.name }}
          </p>
          <p class="w-11/12 mx-auto my-2 pb-2 text-gray-700">
            Por medio de la presente reciba un cordial saludo y a su vez le proporciono la cotización que nos
            solicitó,
            con base en la plática sostenida con ustedes y sabiendo de sus condiciones del producto a aplicar:
          </p>
        </div>

        <!-- table -->
        <table class="rounded-t-lg m-2 w-11/12 mx-auto bg-gray-300 text-gray-800" style="font-size: 10.2px;">
          <thead>
            <tr class="text-left border-b-2 border-gray-400">
              <th class="px-2 py-1">Tipo</th>
              <th class="px-2 py-1">Concepto</th>
              <th class="px-2 py-1">Notas</th>
              <th class="px-2 py-1">$ unitario</th>
              <th class="px-2 py-1">Unidades</th>
              <th class="px-2 py-1">Total sin IVA</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(product, index) in quotation.data.products" :key="product.id"
              class="bg-gray-200 text-gray-700 cursor-pointer hover:bg-blue-100"
              @click="openGalery(product)">
              <td class="px-2 py-px">{{ products_list.find(_product => _product.id == product.product_id)?.family }}
              </td>
              <td class="px-2 py-px">{{ products_list.find(_product => _product.id == product.product_id)?.name }}</td>
              <td class="px-2 py-px">
                {{ product.notes }}
              </td>
              <td class="px-2 py-px">{{ quotation.data.currency }} {{ product.price }}
              </td>
              <td class="px-2 py-px">{{ product.quantity }}</td>
              <td class="px-2 py-px">{{ product.total }}</td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td class="text-center border-t-2 border-gray-400 py-1 font-bold" colspan="6">
                TOTAL SIN IVA: {{ quotation.data.total }}
              </td>
            </tr>
          </tfoot>

        </table>

        <!-- goodbyes -->
        <p class="w-11/12 mx-auto my-2 pb-2 text-gray-700">
          Sin más por el momento y en espera de su preferencia,
          quedo a sus órdenes para cualquier duda o comentario.
          Folio de cotización: <span class="font-bold bg-yellow-100">{{ quotation.data.folio }}</span>
        </p>

        <!-- Notes -->
        <div
          class="w-11/12 mx-auto border border-gray-500 px-3 pb-1 mt-1 rounded-xl text-gray-500 leading-normal uppercase"
          style="font-size: 10.5px;">
          <h2 class="text-center font-extrabold">IMPORTANTE <i class="fas fa-exclamation-circle text-amber-500"></i>
          </h2>
          <ol class="list-decimal mx-2 mb-2">
            <li>PRECIOS ANTES DE IVA</li>
            <li>COSTO DE HERRAMENTAL:
              <span class="font-bold text-blue-500">{{ quotation.data.tooling_cost }}</span>
            </li>
            <li>TIEMPO DE ENTREGA PARA LA PRIMER PRODUCCIÓN <span class="font-bold text-blue-500">{{
              quotation.data.first_production_days
            }}</span>.
              EL TIEMPO CORRE UNA VEZ PAGANDO EL 100% DEL HERRAMENTAL Y EL 50% DE LOS PRODUCTOS.</li>
            <li>FLETES Y ACARREOS CORREN POR CUENTA DEL CLIENTE: <span class="font-bold text-blue-500">{{
              quotation.data.freight_cost
            }}</span></li>
            <li>PRECIOS EN <span class="font-bold text-blue-500">{{ quotation.data.currency }}</span></li>
            <li>COTIZACIÓN VÁLIDA POR 21 DÍAS. EL PRODUCTO ESTÁ SUJETO A LA REVISIÓN DEL DISEÑO FINAL, PRUEBAS Y
              SUBSECUENTE APROBACIÓN</li>
          </ol>
          PAGOS.- POR TRANSFERENCIA BANCARIA O DEPÓSITO ENVIARSE A MARIBEL@EMBLEMAS3D.COM O
          ASISTENTE.DIRECTOR@EMBLEMAS3D.COM <br>
          NO SE ACEPTAN PAGOS EN EFECTIVO, TODOS LOS CHEQUES DEBEN USAR NOMBRE DE: EMBLEMAS 3D
          MEXICO SA DE CV. Y SELLO PARA ABONO EN CUENTA DEL BENEFICIARIO
        </div>

        <!-- banks -->
        <div class="grid grid-cols-2 gap-0 text-xs mt-1 font-semibold" style="font-size: 10px;">
          <div class="bg-sky-600 text-white p-1 flex justify-between rounded-l-xl">
            <span>BANORTE M.N.</span>
            <span>CUENTA: 1180403344</span>
            <span>CLABE: 072 320 011804033446</span>
          </div>
          <div class="bg-red-600 text-white p-1 flex justify-between rounded-r-xl">
            <span>BANORTE USD</span>
            <span>CUENTA: 1181103856</span>
            <span>CLABE: 072 320 011811038560</span>
          </div>
        </div>

        <!-- Author -->
        <div class="mt-1 text-gray-700 flex justify-around" style="font-size: 11px;">
          <div>
            Creado por: {{ seller.name }} &nbsp;&nbsp;
            Tel: {{ seller.phone }} &nbsp;&nbsp;
            correo: {{ seller.email }} &nbsp;&nbsp;
          </div>
          <div>
            Autorizado por:
            <span class="text-green-600">Maribel Ortíz</span>
          </div>
        </div>

        <!-- footer -->
        <footer class="text-gray-400 w-11/12 mx-auto mt-3" style="font-size: 11px;">
          <div class="grid grid-cols-3 gap-x-4">
            <div class="text-center text-sm font-bold">
              Especialistas en
              Emblemas de alta calidad
            </div>
            <div>
              <i class="fas fa-mobile-alt"></i> 333 46 46 485 <br>
              <i class="fas fa-phone-alt"></i> (33) 38 33 82 09
            </div>
            <div>
              <i class="fas fa-globe"></i> www.emblemas<b class="text-sky-600">3</b><b class="text-red-600">d</b>.com
              <br>
              <i class="fas fa-envelope"></i> j.sherman@emblemas<b class="text-sky-600">3</b><b
                class="text-red-600">d</b>.com
            </div>
          </div>
          <div class="flex">
            <p class="mt-3 leading-tight mr-1" style="font-size: 10px;">
              Emblemas de alta calidad, somos los mejores fabricantes. Ramo automotríz,
              electrodomésticos, electrónica, textíl, calzado, muebles y juguetes.
              En división electrónica, somos desarrolladores de tecnología. Conoce
              nuestras nuevas memorias USB personalizadas desde el molde, son exclusivos.
              En división automotríz somos fabricantes especialistas en emblemas cromados,
              porta placas, llaveros, porta documentos, placas de estireno. Lo nuevo,
              LLAVERO USB, diseño original y personalizado, todo con molde único para tu
              empresa (personalización total y exclusiva).
            </p>

          </div>
        </footer>

      </div>

    </section>
    <ConfirmationModal :show="show_confirmation" @close="show_confirmation = false">
      <template #title>
        <div>¿Deseas continuar?</div>
      </template>
      <template #content>
        <JetValidationErrors />
        <div>
          <p>Se generará una nueva orden y se notificará a la administración
            para despachar la misma.</p>
          <Label class="dark:text-gray-300 mt-2" value="Fecha de necesidad" />
          <input v-model="requirement_date" type="date" class="input w-full">
        </div>
      </template>
      <template #footer>
        <div class="flex justify-end">
          <button @click="approve" class="btn-danger mr-3" :disabled="!requirement_date">Continuar</button>
          <button @click="show_confirmation = false" class="btn-secondary">Cancelar</button>
        </div>
      </template>
    </ConfirmationModal>

    <DialogModal :show="show_dialog" @close="show_dialog = false">
      <template #title>
        <div>Galería de <b class="text-blue-500">{{ galery_to_show.product_name }}</b></div>
      </template>
      <template #content>
        <Carousel>
          <Slide v-for="(image_url, index) in galery_to_show.images" :key="index">
            <figure>
              <img class="rounded-md object-cover" :src="image_url">
            </figure>
          </Slide>

          <template #addons>
            <Navigation/>
            <Pagination />
          </template>
        </Carousel>
      </template>
      <template #footer>
        <div class="flex justify-end">
          <button @click="show_dialog = false" class="btn-secondary">Salir</button>
        </div>
      </template>
    </DialogModal>

  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import ApplicationLogo from "@/Jetstream/ApplicationLogo.vue";
import ConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import DialogModal from "@/Jetstream/DialogModal.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import Label from "@/Jetstream/Label.vue";
import { Link } from "@inertiajs/inertia-vue3";

import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel';

import 'vue3-carousel/dist/carousel.css';

export default {
  data() {
    return {
      show_confirmation: false,
      show_dialog: false,
      galery_to_show: null,
      requirement_date: null,
      products_list: [
        {
          id: 7,
          name: "Tapete de uso rudo",
          features: ['Emblema con tu logo', 'Hule resistente color negro'],
          image: 'https://loremflickr.com/640/360',
          family: 'Tapete',
          galery: [
          'https://loremflickr.com/540/360',
          'https://loremflickr.com/640/360',
          'https://loremflickr.com/440/260',
          ]
        },
      ],
      seller: {
        name: 'Edgar Sherman',
        phone: '33 3303 4738',
        email: 'e.sherman@emblemas3d.com',
      }
    }
  },
  components: {
    AppLayout,
    ApplicationLogo,
    ConfirmationModal,
    DialogModal,
    JetValidationErrors,
    Label,
    Link,
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },
  props: {
    quotation: Object,
  },
  methods: {
    approve() {
      this.$inertia.post(route('quotations.approve', {
        requirement_date: this.requirement_date,
        quotation_id: this.quotation.data.id,
      }));
    },
    openGalery(product) {
      const _product = this.products_list.find(_product => _product.id == product.product_id);
      this.show_dialog = true;
      this.galery_to_show = {
        product_name: _product.name, 
        images: _product.galery
      };
    },
  },
  mounted() {
    // bring only the products related with the quotation and 
    // store them in 'products_list' array

    // bring seller and store it in 'seller' var
  },
};
</script>
