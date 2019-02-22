<template>
  <div class="nes-container with-title is-centered">
    <p class="title">Hello!</p>
    <p>Please write your name and click start button.</p>
    <div class="welcome__form">
      <form @submit="startQuiz" method="post" style="width: 100%;">
        <div class="welcomeInput__wrapper">
          <input type="text" :class="{'welcome__input': true, 'welcome__input-name': true, 'welcome__input-error': errorName}" v-model="name" placeholder="* Your name" >
        </div>

        <div class="welcomeInput__wrapper">
          <div :class="{'nes-select': true, 'is-error': errorQuiz}" v-if="quizList.length > 0">
            <select v-model="quiz">
              <option value disabled selected hidden>Select...</option>
              <option v-for="item in quizList" :key="item.id" :value=item.id>{{item.text}}</option>
            </select>
          </div>
        </div>

        <div class="welcomeBtn__wrapper">
          <button type="submit" class="nes-btn is-primary">Let's go!</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import api from '../api/';

export default {
  name: 'Start',
  data() {
    return {
      errorName: false,
      errorQuiz: false,
      name: '',
      quiz: '',
    };
  },
  mounted() {
    this.getQuizList();
    this.quizList = this.$store['quizList/getAll'];
  },
  computed: {
    ...mapGetters({
        quizList: 'quizList/getAll',
        getQuizById: 'quizList/getById',
    }),
  },
  methods: {
    ...mapActions([
      'quizList/save',
      'user/saveId',
      'user/saveQuizId',
      'user/saveName',
      'questionList/save',
    ]),
    getQuizList() {
      api.getQuizList()
        .then((response) => response.data)
        .then((data) => {
          this.$store.dispatch('quizList/save', data);
        });
    },
    async startQuiz(e) {
      e.preventDefault();

      this.errorName = false;
      this.errorQuiz = false;

      if (this.name === '') {
        this.errorName = true;
        return false;
      }

      if (this.getQuizById(this.quiz).length !== 1) {
        this.errorQuiz = true;
        return false;
      }

      const id = await api.startQuiz(this.name, this.quiz);
      if (id) {
        const question = await api.getQuestionByQuizId(this.quiz);

        this.$store.dispatch('questionList/save', question.data);
        this.$store.dispatch('user/saveId', id);
        this.$store.dispatch('user/saveName', this.name);
        this.$store.dispatch('user/saveQuizId', this.quiz);
      }
    },
  },
};
</script>

<style lang="scss">
.welcome__form {
  display: flex;
  flex-flow: row wrap;
  justify-content: center;
  align-items: center;
}

.welcomeInput__wrapper {
  width: 100%;
  text-align: center;
  margin-bottom: 15px;

  input,
  select,
  .nes-select {
    max-width: 420px;
    width: 100%;
    margin: 0 auto;
  }
}
.welcome__input {
  background: #fff;

  font-size: 1.4rem;
  padding: 5px 10px;
  border: none;
  border-bottom: 1px dotted #282828;
  border-radius: 4px;

  &.welcome__input-error {
    border-bottom: 1px dotted #ff0000;
    color: #ff0000;
  }
}
.welcomeBtn__wrapper {
  width: 100%;
  text-align: center;
  margin-bottom: 15px;
}

@media (max-width: 380px) {
  .welcome__input {
    font-size: 1rem;
  }
}
</style>
