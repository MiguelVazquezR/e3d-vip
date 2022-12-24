<template>
  <AppLayout title="Cotizacions">
    <div class="px-8 py-5">
      <div class="flex justify-end my-3">
        <button class="btn-primary">Solicitar</button>
      </div>
      <QuotationTable :quotations="{data: [12, 22]}" :filters="{}" filterURL="" @details="showDetails($event)" />
    </div>

    <DetailsModal :show="side_modal" @close="side_modal = false">
      <template #title>
        <!-- <div class="flex flex-col">
          <h1 class="text-indigo-600 text-xl font-semibold">
            {{ homework_detail.title }}
          </h1>
          <div class="flex justify-between">
            <small class="text-indigo-400 text-xs">
              <i class="fa-solid fa-tag"></i>
              {{ homework_detail.school_subject.name }}
            </small>
            <small
              class="text-xs px-2 rounded-md"
              :class="
                homework_detail.priority === 'Urgente'
                  ? 'text-red-700 bg-red-100 dark:text-red-900 dark:bg-red-500'
                  : 'text-green-700 bg-green-100 dark:text-green-900 dark:bg-green-500'
              "
              :title="'Prioridad: ' + homework_detail.priority"
            >
              Entrega: {{ homework_detail.limit_date }}
            </small>
          </div>
        </div> -->
      </template>
      <template #content>
        <!-- <section class="mt-3">
          <div>
            <h1 class="text-lg dark:text-gray-300 text-gray-600">
              <i class="fa-solid fa-circle-info mr-2"></i>
              <span>Descripción</span>
            </h1>
            <div>
              <p class="text-sm text-gray-500">
                {{ homework_detail.description }}
              </p>
            </div>
          </div>
          <div class="mt-5">
            <h1 class="text-lg dark:text-gray-300 text-gray-600">
              <i class="fa-solid fa-comment-dots mr-2"></i>
              <span>Preguntas y comentarios</span>
            </h1>
            <ChatList
              :chats="homework_detail.chats"
              @showChat="showChat($event)"
            />
          </div>
          <div class="mt-6">
            <h1 class="text-lg dark:text-gray-300 text-gray-600">
              <i class="fa-solid fa-handshake-angle mr-2"></i>
              <span>Solicitudes de colaboración</span>
            </h1>
            <CollaborationApplicants
              :collaborations="homework_detail.collaborations"
              @showApplicant="showApplicant($event)"
            />
          </div>
          <div class="mt-6">
            <h1 class="text-lg dark:text-gray-300 text-gray-600">
              <i class="fa-solid fa-paperclip mr-2"></i>
              <span>Archivos adjuntos</span>
            </h1>
            <div v-if="homework_detail.media.length" class="mt-1 flex flex-col">
              <AttachedFile
                v-for="(file, index) in homework_detail.media"
                :key="index"
                :name="file.name"
                :extension="file.mime_type.split('/')[1]"
                :href="file.original_url"
              />
            </div>
            <p v-else class="text-center text-gray-400 text-xs pt-3">
              No hay recursos para esta tarea
            </p>
          </div>
        </section> -->
      </template>
      <template #footer>
        <!-- <div class="flex">
          <Link
            :href="route('homeworks.edit', homework_detail)"
            class="btn-primary"
            >Editar
          </Link>
          <button @click="side_modal = false" class="btn-secondary mx-1">
            Cerrar
          </button>
        </div> -->
      </template>
    </DetailsModal>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import QuotationTable from "@/Components/QuotationTable.vue";
import DetailsModal from "@/Components/DetailsModal.vue";

export default {
  data(){
    return{
      quotation_detail: {},
      side_modal: false,
    }
  },
  components: {
    AppLayout,
    QuotationTable,
    DetailsModal,
  },
  props:{

  },
  methods:{
    showDetails(item) {
      this.quotation_detail = item;
      this.side_modal = true;
    },
  },
};
</script>