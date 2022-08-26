import { createStore } from 'vuex';
import axiosClient from "../axios";


const store = createStore({
  state: {
    user: {
      data: {},
      token: sessionStorage.getItem("TOKEN"),
    },
    currentFanart: {
      loading: false,
      data: {}
    },
    fanarts: {
      loading: false,
      links: [],
      data: {}
    },
    notification: {
      show: false,
      type: 'success',
      message: ''
    },
    fanartCategories: {
      loading: false,
      data: []
    }
  },
  getters: {},
  actions: {

    getFanart({ commit }, id) {
      commit("setCurrentFanartLoading", true);
      return axiosClient
        .get(`/fanart/${id}`)
        .then((res) => {
          commit("setCurrentFanart", res.data);
          commit("setCurrentFanartLoading", false);
          return res;
        })
        .catch((err) => {
          commit("setCurrentFanartLoading", false);
          throw err;
        });
    },

    getFanarts({ commit }, { url = null } = {}) {
      commit('setFanartsLoading', true)
      url = url || "/fanart";
      return axiosClient.get(url).then((res) => {
        commit('setFanartsLoading', false)
        commit("setFanarts", res.data);
        return res;
      });

    },

    saveFanart({ commit, dispatch }, fanart) {

      delete fanart.image_url;

      let response;
      if (fanart.id) {
        response = axiosClient
          .put(`/fanart/${fanart.id}`, fanart)
          .then((res) => {
            commit("setCurrentFanart", res.data);
            return res;
          });

      } else {
        response = axiosClient.post("/fanart", fanart).then((res) => {
          commit("setCurrentFanart", res.data);
          return res;
        });
      }
      return response;
    },

    deleteFanart({ dispatch }, id) {
      return axiosClient.delete(`/fanart/${id}`).then((res) => {
        dispatch('getFanarts')
        return res;
      });
    },

    getFanartCategories({ commit }) {
      return axiosClient.get('/fanartCategory')
        .then(res => {
          commit('setFanartCategory', res.data)
        })
    },
    register({ commit }, user) {
      return axiosClient.post('/register', user)
        .then(({ response }) => {
          commit('setUser', data.user);
          commit('setToken', data.token)
          return data;
        })
    },

    login({ commit }, user) {
      return axiosClient.post('/login', user)
        .then(({ data }) => {
          commit('setUser', data.user);
          commit('setToken', data.token)
          return data;
        })
    },

    logout({ commit }) {
      return axiosClient.post('/logout')
        .then(response => {
          commit('logout')
          return response;
        })
    },
    getUser({ commit }) {
      return axiosClient.get('/user')
        .then(res => {
          // console.log(res);
          commit('setUser', res.data)
        })
    },
    profile({ commit }, user) {
      return axiosClient.get('/user/show/' + user.id)
        .then(res => {
          // console.log(res);
          commit('setUser', res.data)
        })
    },
    updateUser({ commit, dispatch }, user) {

      if (user.photo_url) {
        delete user.photo_url;
      }

      let response;
      if (user.id) {
        response = axiosClient
          .put(`/user/${user.id}`, user)
          .then((res) => {
            commit("setUser", res.data);
            return res;
          });

      }else {
        response = axiosClient.post("/user", user).then((res) => {
          commit("setUser", res.data);
          return res;
        });
      }
      return response;
    }
  },
  mutations: {
    setCurrentFanartLoading: (state, loading) => {
      state.currentFanart.loading = loading;
    },
    setFanartsLoading: (state, loading) => {
      state.fanarts.loading = loading;
    },
    setCurrentFanart: (state, fanart) => {
      state.currentFanart.data = fanart.data;
    },

    setFanarts: (state, fanarts) => {
      state.fanarts.links = fanarts.meta.links;
      state.fanarts.data = fanarts.data;
    },

    setFanartCategory: (state, fanartCategories) => {
      state.fanartCategories.data = fanartCategories.data;
    },
    logout: (state) => {
      state.user.token = null;
      state.user.data = {};
      sessionStorage.removeItem("TOKEN");
    },

    setUser: (state, user) => {
      state.user.data = user;
    },
    setToken: (state, token) => {
      state.user.token = token;
      sessionStorage.setItem('TOKEN', token);
    },

    notify: (state, { message, type }) => {
      state.notification.show = true;
      state.notification.type = type;
      state.notification.message = message;
      setTimeout(() => {
        state.notification.show = false;
      }, 3000)
    },
  },
  modules: {}

})

export default store;
