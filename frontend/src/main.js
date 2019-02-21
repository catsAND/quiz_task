import Vue from 'vue';
import App from './App.vue';
import store from './store';

/* Configure whether to allow vue-devtools inspection. */
Vue.config.devtools = process.env.NODE_ENV !== 'production';

Vue.config.productionTip = false;

new Vue({
  store,
  render: h => h(App),
}).$mount('#app');
