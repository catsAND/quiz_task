<template>
  <div id="app">
    <!-- <img alt="Vue logo" src="./assets/logo.png"> -->
    <!-- <HelloWorld msg="Welcome to Your Vue.js App!"/> -->
    <div class="mainBlock__wrapper">
      <div class="content__block">
        <h1>Quiz</h1>
        <StartBlock v-if="!isStarted"/>
        <QuestionBlock v-if="isStarted && !isCompleted"/>
        <ResultBlock v-if="isStarted && isCompleted"/>
        <ProgressBar progress="20" v-if="isStarted"/>
      </div>
    </div>
  </div>
</template>

<script>
import StartBlock from './components/Start.vue';
import QuestionBlock from './components/Question.vue';
import ResultBlock from './components/Result.vue';
import ProgressBar from './components/Progress.vue';

export default {
  name: 'app',
  data() {
    return {
      ping: 'pong',
      isStarted: false,
      isCompleted: false,
    };
  },
  components: {
    StartBlock,
    QuestionBlock,
    ResultBlock,
    ProgressBar,
  },
  mounted() {
    console.log('1');
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
