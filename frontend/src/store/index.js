import Vue from 'vue';
import Vuex from 'vuex';
import quizList from './quizList';
import user from './user';
import questionList from './questionList';

Vue.use(Vuex);

export default new Vuex.Store({
  debug: true,
  strict: true,
  modules: {
    quizList,
    user,
    questionList,
  },
});
