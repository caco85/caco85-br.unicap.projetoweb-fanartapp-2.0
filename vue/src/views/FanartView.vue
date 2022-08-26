<template>
  <PageComponent>
    <template v-slot:header>
      <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-900">
          {{ route.params.id ? model.title : "Criar uma Fanart" }}
        </h1>

        <TButton v-if="route.params.id" color="red" @click="deleteFanart()">
          <TrashIcon class="w-5 h-5 mr-2" />
          Delete
        </TButton>
      </div>
    </template>
    <div v-if="fanartLoading" class="flex justify-center">Loading...</div>
    <form v-else @submit.prevent="saveFanart" class="animate-fade-in-down">
      <div class="shadow sm:rounded-md sm:overflow-hidden">
        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
          <label class="block text-sm font-medium text-gray-700"> Imagem </label>
          <div class="mt-1 flex items-center">
            <img
              v-if="model.image_url"
              :src="model.image_url"
              :alt="model.title"
              class="w-64 h-48 object-cover"
            />
            <span
              v-else
              class="flex items-center justify-center h-12 w-12 rounded-full overflow-hidden bg-gray-100"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-[80%] w-[80%] text-gray-300"
                viewBox="0 0 20 20"
                fill="currentColor"
              >
                <path
                  fill-rule="evenodd"
                  d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                  clip-rule="evenodd"
                />
              </svg>
            </span>
            <button
              type="button"
              class="relative overflow-hidden ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
              <input
                type="file"
                @change="onImageChoose"
                class="absolute left-0 top-0 right-0 bottom-0 opacity-0 cursor-pointer"
              />
              Escolher
            </button>
          </div>
          <div>
            <label for="title" class="block text-sm font-medium text-gray-700"
              >Título</label
            >
            <input
              type="text"
              name="title"
              id="title"
              v-model="model.title"
              class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
            />
          </div>

          <div>
            <label for="about" class="block text-sm font-medium text-gray-700">
              Descrição
            </label>
            <div class="mt-1">
              <textarea
                id="description"
                name="description"
                rows="3"
                v-model="model.description"
                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                placeholder="Descreva sua fanart"
              />
            </div>
          </div>
          <!-- <pre>{{ categories }}</pre>
            <div class="mt-3 col-span-3">
              <label for="question_type" class="block text-sm font-medium text-gray-700"
                >Selecione uma Categoria
              </label>
              <select
                id=""
                name="nameCategory"
                v-model="model.nameCategory"
                @change="typeChange"
                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              >
                <option
                  v-for="category in categories"
                  :key="category.id"
                  :value="category.id"
                >
                  {{ upperCaseFirst(category.nameCategory) }}
                </option>
              </select>
            </div> -->

          <div>
            <label for="id_users" class="block text-sm font-medium text-gray-700"
              >Usuário</label
            >
            <input
              type="text"
              name="id_users"
              id="id_users"
              v-model="model.id_users"
              class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
            />
          </div>

          <div>
            <label
              for="id_fanartCategories"
              class="block text-sm font-medium text-gray-700"
              >Categoria</label
            >
            <input
              type="text"
              name="id_fanartCategories"
              id="id_fanartCategories"
              v-model="model.id_fanartCategories"
              class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
            />
          </div>

          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <button
              type="submit"
              class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
              <span v-if="route.params.id">
                Atualizar
              </span>
              <span v-else>
                Salvar
            </span>
            </button>
          </div>
        </div>
      </div>
    </form>
  </PageComponent>
</template>

<script setup>
import PageComponent from "../components/PageComponent.vue";
import store from "../store";
import { computed, ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import TButton from "../components/core/TButton.vue";
import { SaveIcon, TrashIcon, ExternalLinkIcon } from "@heroicons/vue/solid";

const router = useRouter();

const route = useRoute();

const fanartLoading = computed(() => store.state.currentFanart.loading);

let model = ref({
  title: "",
  description: null,
  image: null,
  mediaRating: null,
  id_users: null,
  id_fanartCategories: null,
});

watch(
  () => store.state.currentFanart.data,
  (newVal, oldVal) => {
    model.value = {
      ...JSON.parse(JSON.stringify(newVal)),
    };
  }
);

if (route.params.id) {
  store.dispatch("getFanart", route.params.id);
}

function saveFanart() {
  let action = "Criada";

  if (model.value.id) {
    action = "Atualizada";
  }
  store.dispatch("saveFanart", model.value).then(({ data }) => {
    store.commit("notify", {
      type: "success",
      message: "A Fanart foi " + action + " com sucesso",
    });
    router.push({
      name: "FanartView",
      params: { id: data.data.id },
    });
  });
}

function onImageChoose(event) {
  const file = event.target.files[0];

  const reader = new FileReader();
  reader.onload = () => {
    model.value.image = reader.result;
    model.value.image_url = reader.result;
    event.target.value = "";
  };

  reader.readAsDataURL(file);
}

function deleteFanart() {
  if (confirm(`Deseja realmente excluir esta fanart? ela não vai pode ser requperada`)) {
    store.dispatch("deleteFanart", model.value.id).then(() => {
      router.push({
        name: "Fanarts",
      });
    });
  }
}
</script>
