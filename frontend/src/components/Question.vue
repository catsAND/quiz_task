<template>
  <div class="nes-container with-title is-centered">
    <p class="title">{{question}}</p>
    <div class="answers__block">
      <div class="answer__btn nes-btn" v-for="item, key in answers" v-bind:key="key" v-on:click="saveAnswer(item.id)">{{item.text}}</div>
    </div>
    <div class="nextBtn__wrapper">
      <button class="nes-btn is-success -right">Next --></button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Questions',
  data () {
    return {
      question: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quos quaerat illum quidem officiis voluptates necessitatibus quam impedit at temporibus tempora?',
      answers: [
        {id: 'key1', text: 'Answer 1'},
        {id: 'key2', text: 'Answer 2'},
        {id: 'key3', text: 'Answer 3'},
        {id: 'key4', text: 'Answer 4'},
        {id: 'key5', text: 'Answer 5'},
      ],
    }
  },
  methods: {
    saveAnswer: function (id) {
      this.$parent.$data.isCompleted = true;
    }
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
