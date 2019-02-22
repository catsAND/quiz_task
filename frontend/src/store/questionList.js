const state = {
  list: [],
  total: 0,
  current: 0,
};

const actions = {
  save({ commit }, payload) {
    commit('push', payload);
  },
  nextQuestion({ commit }) {
    commit('increment');
  },
};

const mutations = {
  push(state, payload) {
    state.list = payload;
    state.total = payload.length;
  },
  increment(state) {
    state.current += 1;
  },
};

const getters = {
  getTotal: state => state.total,
  getCurrent: state => state.current,
  getProgress: state => state.total > 0 ? state.current / state.total * 100 : 0,
  getQuestion: (state) => {
    if (state.total === state.current) {
      return {};
    }

    return state.list[state.current];
  },
};

export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters,
};
