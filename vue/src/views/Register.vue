<template>
  <div>
    <img
      class="mx-auto h-12 w-auto"
      src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
      alt="Workflow"
    />
    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
      Faça seu cadastro
    </h2>
  </div>
  <form class="mt-8 space-y-6" @submit="register">
    <Alert v-if="Object.keys(errors).length" class="flex-col items-stretch text-sm">
      <div v-for="(field, i) of Object.keys(errors)" :key="i">
        <div v-for="(error, ind) of errors[field] || []" :key="ind">* {{ error }}</div>
      </div>
    </Alert>
    <input type="hidden" name="remember" value="true" />
    <div class="rounded-md shadow-sm -space-y-px">
      <div>
        <label for="name" class="sr-only">Nome completo</label>
        <input
          id="name"
          name="name"
          type="text"
          autocomplete="Nome completo"
          required=""
          v-model="user.name"
          class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
          placeholder="Nome completo"
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
          v-model="user.email"
          class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
          placeholder="E-mail"
        />
      </div>
      <div>
        <label for="password" class="sr-only">Senha</label>
        <input
          id="password"
          name="password"
          type="password"
          autocomplete="current-password"
          required=""
          v-model="user.password"
          class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
          placeholder="Senha"
        />
      </div>
      <div>
        <label for="password_confirmation" class="sr-only">Confirme a senha</label>
        <input
          id="password_confirmation"
          name="password_confirmation"
          type="password"
          autocomplete="current-password_confirmation"
          required=""
          v-model="user.password_confirmation"
          class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
          placeholder="Confirme a senha"
        />
      </div>
      <div>
        <label for="instagram" class="sr-only">Instagram</label>
        <input
          id="instagram"
          name="instagram"
          type="text"
          v-model="user.instagram"
          class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
          placeholder="Instagram"
        />
      </div>
      <div>
        <label for="birthday" class="sr-only">Data de nascimento</label>
        <input
          id="birthday"
          name="birthday"
          type="date"
          v-model="user.birthday"
          class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
          autocomplete="off"
        />
      </div>
      <label class="block text-sm font-medium text-gray-700 mt-1"> Foto </label>
      <div class="mt-1 flex items-center">
        <img
          v-if="user.photo"
          :src="user.photo"
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
        <label for="id_usersTypes" class="sr-only">Tipo de usuário</label>
        <input
          id="id_usersTypes"
          name="id_usersTypes"
          type="hidden"
          v-model="user.id_usersTypes"
          class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
        />
      </div>
    </div>

    <div>
      <button
        :disabled="loading"
        type="submit"
        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
      >
        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
          <LockClosedIcon
            class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
            aria-hidden="true"
          />
        </span>
        <svg
          v-if="loading"
          class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
        >
          <circle
            class="opacity-25"
            cx="12"
            cy="12"
            r="10"
            stroke="currentColor"
            stroke-width="4"
          ></circle>
          <path
            class="opacity-75"
            fill="currentColor"
            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
          ></path>
        </svg>
        Registrar
      </button>
    </div>
  </form>
</template>

<script setup>
import { LockClosedIcon } from "@heroicons/vue/solid";
import store from "../store";
import { useRouter } from "vue-router";
import { computed, ref, watch } from "vue";
import Alert from "../components/Alert.vue";

const router = useRouter();
let loading = ref(false);

const errors = ref({});

const user = {
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  photo: "",
  photo_url: "",
  instagram: "",
  birthday: "",
  id_usersTypes: "4",
};

watch(
  () => store.state.user.data,
  (newVal, oldVal) => {
    user.value = {
      ...JSON.parse(JSON.stringify(newVal)),
    };
  }
);

function register(event) {
  event.preventDefault();
  loading.value = true;

  console.log(user);
  store
    .dispatch("register", user)
    .then(() => {
      loading.value = false;
      router.push({
        name: "Dashboard",
      });
    })
    .catch((error) => {
      loading.value = false;
      if (error.response.status === 422) {
        errors.value = error.response.data.errors;
      }
    });
}

function onImageChoose(event) {
  const file = event.target.files[0];

  const reader = new FileReader();
  reader.onload = () => {
    user.value.photo = reader.result;
    user.value.photo_url = reader.result;
    event.target.value = "";
  };

  reader.readAsDataURL(file);
}
</script>
