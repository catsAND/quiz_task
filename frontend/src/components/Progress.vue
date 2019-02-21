<template>
  <div class="progress__wrapper">
    <progress class="nes-progress is-success" :value=progress max="100"></progress>
  </div>
</template>

<script>
export default {
  name: 'ProgressBar',
  props: {
    progress: String,
  },
};
</script>

<style lang="scss">
.progress__wrapper {
  margin-top: 20px;
}
</style>
