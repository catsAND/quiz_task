<template>
  <div class="nes-container with-title is-centered">
    <p class="title">Thanks you!</p>
    <div class="message -left">
      <i class="nes-bcrikko"></i>
      <div class="nes-balloon from-left">
        <p>{{name}} is completed quiz.</p>
        <p>You correct answered {{correctCount}}/{{total}} questions.</p>
        <p>Have a nice day!</p>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import api from '../api/';

export default {
  name: 'Result',
  data() {
    return {
      correctCount: 0,
    };
  },
  computed: {
    ...mapGetters({
        name: 'user/getName',
        userId: 'user/getId',
        total: 'questionList/getTotal',
    })
  },
  methods: {
    async getResult() {
      const response = await api.getResult(this.userId);
      this.correctCount = response.data.correct;
    },
  },
  mounted() {
    this.getResult();
  },
};
</script>

<style lang="scss">
  .nes-balloon {
    max-width: 420px;

  }

  @media (max-width: 380px) {
    .welcome__input {
      font-size: 1rem;
    }
  }
</style>
