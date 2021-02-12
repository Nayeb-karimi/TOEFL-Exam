/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueHtmlToPaper from "vue-html-to-paper";

window.info = {
  task_completion: [
    {
      id: 1,
      text:
        "Fully addresses and completes task. Add detail and elaborates on idea.",
      score: 4,
      bgcolor: "#fff",
      row: 1,
    },
    {
      id: 2,
      text: "Appropriately addresses and completes the task.",
      score: 3,
      bgcolor: "#fff",
      row: 1,
    },
    {
      id: 3,
      text:
        "Partially addresses and/or completes the task. Very limited detail.",
      score: 2,
      bgcolor: "#fff",
      row: 1,
    },
    {
      id: 4,
      text: "Does not complete the task. Lacks details.",
      score: 1,
      bgcolor: "#fff",
      row: 1,
    },
  ],
  comprehensibility: [
    {
      id: 5,
      text:
        "Message readiy comprehesible, requires no interpretion; pronunciation enhances communication.",
      score: 4,
      bgcolor: "#fff",
      row: 2,
    },
    {
      id: 6,
      text:
        "Message comprehensible, requires minimal interpretation; does not interfere with communication.",
      score: 3,
      bgcolor: "#fff",
      row: 2,
    },
    {
      id: 7,
      text:
        "Message mostly comprehensible, requires some interpretation; pronuncation may occasionally interfere with communication.",
      score: 2,
      bgcolor: "#fff",
      row: 2,
    },
    {
      id: 8,
      text:
        "Message barely comprehensible, requires frequent interpretation; frequently interfere with communication. Response maybe too limited to evaluate.",
      score: 1,
      bgcolor: "#fff",
      row: 2,
    },
  ],
  fluency: [
    {
      id: 9,
      text: "Fluent and natural speech with few pauses or false starts.",
      score: 4,
      bgcolor: "#fff",
      row: 3,
    },
    {
      id: 10,
      text:
        "Somewhat fluent speech with some hesitation but speaker manages to continue and complete thoughts.",
      score: 3,
      bgcolor: "#fff",
      row: 3,
    },
    {
      id: 11,
      text:
        "Speech choppy and/or slow .with frequent pauses; few or no imcomplete thoughts.",
      score: 2,
      bgcolor: "#fff",
      row: 3,
    },
    {
      id: 12,
      text:
        "Speech halting and uneven with long pauses or incomplete thoughts.",
      score: 1,
      bgcolor: "#fff",
      row: 3,
    },
  ],
  vocabulary: [
    {
      id: 13,
      text:
        "Rich use of vocabulary. A wide range of vocabulary is used well and accurately.",
      score: 4,
      bgcolor: "#fff",
      row: 4,
    },
    {
      id: 14,
      text:
        "Adequate and accurate use of vocabulary appropriate to level.",
      score: 3,
      bgcolor: "#fff",
      row: 4,
    },
    {
      id: 15,
      text:
        "Somewhat inadequate and/or inaccurate use of vocabulary; too basic.",
      score: 2,
      bgcolor: "#fff",
      row: 4,
    },
    {
      id: 16,
      text:
        "Often unable to find the words to elaborate a clear message.",
      score: 1,
      bgcolor: "#fff",
      row: 4,
    },
  ],
  language_control: [
    {
      id: 17,
      text:
        "Excellent control of basic structures with possible use of advanced language structures.",
      score: 4,
      bgcolor: "#fff",
      row: 5,
    },
    {
      id: 18,
      text:
        "Control of basic language structures; used correctly most of the time, not all of the time.",
      score: 3,
      bgcolor: "#fff",
      row: 5,
    },
    {
      id: 19,
      text:
        "Emerging control of basic language structures; used correclty about 3/4 of the time.",
      score: 2,
      bgcolor: "#fff",
      row: 5,
    },
    {
      id: 20,
      text:
        "Emerging use of basic language structures; used correctly about 1/2 of the time.",
      score: 1,
      bgcolor: "#fff",
      row: 5,
    },
  ],
}

// ...
const options = {
  name: "_blank",
  specs: ["fullscreen=yes", "titlebar=yes", "scrollbars=yes"],
  styles: [
    "./css/bootstrap.css",
    "./css/custom.css"
  ]
};

Vue.use(VueHtmlToPaper, options)

import VueRouter from 'vue-router'

Vue.use(VueRouter);

import ExampleComponent from './components/ExampleComponent';

const routes = [
  { path: '/', component: ExampleComponent },
]

const router = new VueRouter({
  routes // short for `routes: routes`
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  router,
  el: '#app',
});
