<template>
  <div class="nes-container with-title is-centered">
    <p class="title">{{question.text}}</p>
    <div class="answers__block">
      <div :class="{'answer__btn': true, 'nes-btn': true, 'is-primary': item.id === choice}" v-for="item in question.answer" :key="item.id" v-on:click="chooseAnswer(item.id)">{{item.text}}</div>
    </div>
    <div class="nextBtn__wrapper">
      <button class="nes-btn is-success -right" v-on:click="nextQuestion()">Next --></button>
    </div>
    <p v-if="error" style="color: red;">Please choose answer</p>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import api from '../api';

export default {
  name: 'Questions',
  data() {
    return {
      choice: '',
      error: false,
    };
  },
  computed: {
    ...mapGetters({
      uid: 'user/getId',
      question: 'questionList/getQuestion',
      current: 'questionList/getCurrent',
      total: 'questionList/getTotal',
    }),
  },
  methods: {
    ...mapActions([
      'questionList/nextQuestion',
      'user/setComplete',
    ]),
    chooseAnswer(id) {
      this.choice = id;
      this.error = false;
    },
    nextQuestion() {
      if (this.choice === '') {
        this.error = true;
        return false;
      }

      api.saveAnswer(this.uid, this.question.id, this.choice);
      this.$store.dispatch('questionList/nextQuestion');
      if (this.total === this.current) {
        this.$store.dispatch('user/setComplete');
        return true;
      }

      this.question = this['questionList/getQuestion'];
      this.choice = '';

      return true;
    },
  },
};
</script>

<style lang="scss">
.answers__block {
  display: flex;
  flex-flow: row wrap;
  justify-content: space-around;
  align-content: baseline;
}
.answer__btn {
  &.nes-btn {
    margin: 10px 15px;
  }
}
.nextBtn__wrapper {
  text-align: right;
  margin: 35px 0;
}

  @media (max-width: 465px) {
    .nextBtn__wrapper {
      text-align: center;
    }
  }
</style>
