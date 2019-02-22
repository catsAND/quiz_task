const state = {
  list: [],
};

const actions = {
  save({ commit }, payload) {
    commit('push', payload);
  },
};

const mutations = {
  push(state, payload) {
    state.list = payload;
  },
};

const getters = {
  getById: state => id => state.list.filter(val => val.id === id),
  getAll: state => state.list,
};

export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters,
};
