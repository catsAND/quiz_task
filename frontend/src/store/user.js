const state = {
  id: '',
  name: '',
  quizId: '',
  complete: false,
};

const actions = {
  saveId({ commit }, payload) {
    commit('pushId', payload);
  },
  saveQuizId({ commit }, payload) {
    commit('pushQuizId', payload);
  },
  saveName({ commit }, payload) {
    commit('pushName', payload);
  },
  setComplete({ commit }) {
    commit('complete');
  },
};

const mutations = {
  pushId(state, payload) {
    state.id = payload;
  },
  pushQuizId(state, payload) {
    state.quizId = payload;
  },
  pushName(state, payload) {
    state.name = payload;
  },
  complete(state) {
    state.complete = true;
  },
};

const getters = {
  getId: state => state.id,
  isComplete: state => state.complete,
  getName: state => state.name,
  getQuizId: state => state.quizId,
};

export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters,
};
