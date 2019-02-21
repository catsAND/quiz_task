<template>
  <div class="nes-container with-title is-centered">
    <p class="title">Thanks you!</p>
    <div class="message -left">
      <i class="nes-bcrikko"></i>
      <div class="nes-balloon from-left">
        <p>{{name}} is completed quiz. You correct answered {{correctQuestion}}/{{totalQuestion}} questions.</p>
        <p><button type="button" class="nes-btn is-warning" v-on:click="startAgain">Start again</button></p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Result',
  data() {
    return {
      name: 'my name',
      correctQuestion: 3,
      totalQuestion: 6,
    };
  },
  methods: {
    startAgain() {
      this.$parent.$data.isStarted = false;
      this.$parent.$data.isCompleted = false;
    },
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
