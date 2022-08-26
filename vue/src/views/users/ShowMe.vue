<template>
  <PageComponent>
    <template v-slot:header>
      <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-900">
          Detalhes do usuário,Deseja atualizar algo?
        </h1>

        <TButton v-if="route.params.id" color="red" @click="deleteUser()">
          <TrashIcon class="w-5 h-5 mr-2" />
          Delete
        </TButton>
      </div>
    </template>
    <div v-if="userLoading" class="flex justify-center">Loading...</div>
    <form v-else @submit.prevent="updateUser" class="animate-fade-in-down">
      <div class="shadow sm:rounded-md sm:overflow-hidden">
        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
          <label class="block text-sm font-medium text-gray-700"> Foto </label>
          <div class="mt-1 flex items-center">
            <img
              v-if="model.photo_url"
              :src="model.photo_url"
              :alt="''"
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
            <label for="name" class="sr-only">Nome completo</label>
            <input
              id="name"
              name="name"
              type="text"
              autocomplete="Nome completo"
              v-model="model.name"
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            />
          </div>

          <div>
            <label for="email-address" class="sr-only">E-mail</label>
            <input
              id="email-addres"
              name="email"
              type="email"
              autocomplete="email"
              required=""
              v-model="model.email"
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            />
          </div>

          <div>
            <label for="instagram" class="sr-only">Instagram</label>
            <input
              id="instagram"
              name="instagram"
              type="text"
              v-model="model.instagram"
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            />
          </div>
          <div>
            <label for="birthday" class="sr-only">Data de nascimento</label>
            <input
              id="birthday"
              name="birthday"
              type="date"
              v-model="model.birthday"
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
              autocomplete="off"
            />
          </div>

          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <button
              type="submit"
              class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
              Atualizar
            </button>
          </div>
        </div>
      </div>
    </form>
  </PageComponent>
</template>

<script setup>
import PageComponent from "../../components/PageComponent.vue";
import store from "../../store";
import { computed, ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import TButton from "../../components/core/TButton.vue";
import { SaveIcon, TrashIcon } from "@heroicons/vue/solid";

const router = useRouter();

const route = useRoute();

const userLoading = computed(() => store.state.user.loading);

let model = ref({
  name: "",
  email: "",
  photo: "",
  photo_url: "",
  instagram: "",
  birthday: "",
});

watch(
  () => store.state.user.data,
  (newVal, oldVal) => {
    model.value = {
      ...JSON.parse(JSON.stringify(newVal)),
    };
  }
);

if (route.params.id) {
  store.dispatch("getUser", route.params.id);
}

function updateUser() {
  store.dispatch("updateUser", model.value).then(({ data }) => {
    store.commit("notify", {
      type: "success",
      message: "O usuário foi atualizado com sucesso",
    });
    router.push({
      name: "ShowMe",
      params: { id: route.params.id },
    });
  });
}

function onImageChoose(event) {
  const file = event.target.files[0];

  const reader = new FileReader();
  reader.onload = () => {
    model.value.photo = reader.result;
    model.value.photo_url = reader.result;
    event.target.value = "";
  };

  reader.readAsDataURL(file);
}

function deleteUser() {
  if (confirm(`Deseja realmente excluir seu usuário?`)) {
    store.dispatch("deleteUser", model.value.id).then(() => {
      router.push({
        name: "Logout",
      });
    });
  }
}
</script>
