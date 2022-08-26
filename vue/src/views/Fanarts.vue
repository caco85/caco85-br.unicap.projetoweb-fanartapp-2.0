<template>
  <PageComponent>
    <template v-slot:header>
      <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Fanarts</h1>
        <router-link
          :to="{ name: 'FanartCreate' }"
          class="py-2 px-3 text-white bg-emerald-500 rounded-md hover:bg-emerald-600"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-4 w-4 -mt-1 inline-block"
            fill="nome"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-widtg="2"
              d="M12 4v16m8-8H4"
            />
          </svg>
          Criar nova Fanart
        </router-link>
      </div>
    </template>
    <div v-if="fanarts.loading" class="flex justify-center">Loading...</div>
    <div v-else-if="fanarts.data.length">
      <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3">
        <FanartListItem
          v-for="(fanart, index) in fanarts.data"
          :key="fanart.id"
          :fanart="fanart"
          class="opacity-0 animate-fade-in-down"
          :style="{ animationDelay: `${index * 0.1}s` }"
          @delete="deleteFanart(fanart)"
        />
      </div>
      <div class="flex justify-center mt-5">
        <nav
          class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
          aria-label="Pagination"
        >
          <a
            v-for="(link, i) of fanarts.links"
            :key="i"
            :disabled="!link.url"
            href="#"
            @click="getForPage($event, link)"
            aria-current="page"
            class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
            :class="[
              link.active
                ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
              i === 0 ? 'rounded-l-md bg-gray-100 text-gray-700' : '',
              i === fanarts.links.length - 1 ? 'rounded-r-md' : '',
            ]"
            v-html="link.label"
          >
          </a>
        </nav>
      </div>
      <!-- <pre>{{ fanarts.links}}</pre>
        <pre>{{ fanartCategories }}</pre>  -->
    </div>
    <div v-else class="text-gray-600 text-center py-16">Nenhuma Farnart postada</div>
  </PageComponent>
</template>

<script setup>
import PageComponent from "../components/PageComponent.vue";
import FanartListItem from "../components/FanartListItem.vue";
import { computed } from "vue";
import store from "../store";

const fanarts = computed(() => store.state.fanarts);

const fanartCategories = computed(() => store.state.fanartCategories);

store.dispatch("getFanarts");

store.dispatch("getFanartCategories");

function deleteFanart(fanart) {
  if (confirm(`Deseja realmente excluir esta fanart? ela não vai pode ser requperada`)) {
    store.dispatch("deleteFanart", fanart.id).then(() => {
      store.dispatch("getFanarts");
    });
  }
}

function getForPage(event, link) {
  event.preventDefault();
  if (!link.url || link.active) {
    return;
  }

  store.dispatch("getFanarts", { url: link.url });
}
</script>
