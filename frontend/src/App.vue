<template>
  <div id="app">
    <!-- <img alt="Vue logo" src="./assets/logo.png"> -->
    <!-- <HelloWorld msg="Welcome to Your Vue.js App!"/> -->
    <div class="mainBlock__wrapper">
      <div class="content__block">
        <h1>Quiz</h1>
        <StartBlock v-if="getUserId === ''"/>
        <QuestionBlock v-if="getUserId !== '' && !quizCompleted"/>
        <ResultBlock v-if="quizCompleted"/>
        <ProgressBar :progress=progress v-if="getUserId !== ''"/>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import StartBlock from './components/Start.vue';
import QuestionBlock from './components/Question.vue';
import ResultBlock from './components/Result.vue';
import ProgressBar from './components/Progress.vue';

export default {
  name: 'app',
  computed: {
    ...mapGetters({
        getUserId: 'user/getId',
        quizCompleted: 'user/isComplete',
        progress: 'questionList/getProgress',
    })
  },
  components: {
    StartBlock,
    QuestionBlock,
    ResultBlock,
    ProgressBar,
  },
};
</script>

<style lang="scss">
@import "./assets/css/nes/nes.scss";

html, body {
  background: linear-gradient(90deg, darken(#fcfafc, 5%) 0%,  lighten(#fcfafc, 5%) 60%);
}

.mainBlock__wrapper {
  display: flex;
  flex-flow: row wrap;
  justify-content: center;
  margin: 15px;

  .content__block {
    width: 100%;
    max-width: 786px;

    h1 {
      text-align: center;
      color: #282828;
      font-size: 3rem;
    }
  }
}
</style>
