<template>
  <div class="nes-container with-title is-centered">
    <p class="title">Hello!</p>
    <p>Please write your name and click start button.</p>
    <div class="welcome__form">
      <div class="welcomeInput__wrapper">
        <input type="text" class="welcome__input welcome__input-name" v-model="name" placeholder="* Your name">
      </div>
      <div class="welcomeBtn__wrapper">
        <button type="button" class="nes-btn is-primary" v-on:click="startQuiz">Let's go!</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Start',
  data() {
    return {
      name: '',
    };
  },
  methods: {
    startQuiz() {
      this.$parent.$data.isStarted = true;
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
  }
  .welcome__input {
    background: #fff;
    max-width: 420px;
    width: 100%;
    font-size: 1.4rem;
    padding: 5px 10px;
    border: none;
    border-bottom: 1px dotted #282828;
    border-radius: 4px;
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
