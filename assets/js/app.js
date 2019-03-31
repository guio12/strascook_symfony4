/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');

require('bootstrap');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');


$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

// VueJS

import Vue from 'vue';

//import Menus from './components/Menus'
import Exemple from './components/Exemple'


  import Menus from './components/Menus.vue'

  Vue.component('my-menus', Menus)

  new Vue({
      delimiters: ['${', '}$'],
      el: '#app-menu',
      components: {Menus},
      data: {
          menu: "",
          currentFilter: "",
          showModal: false
      },
      methods: {
          setFilter(filter) {}
      }
  })

//   new Vue({
//     el: '#app-menu',
//     data: {
//       currentFilter: 'ALL',
//       projects: [
//         {title: "Artwork", image: "https://picsum.photos/g/200?image=122", category: 'ART'},
//         {title: "Charcoal", image: "https://picsum.photos/g/200?image=116", category: 'ART'},
//         {title: "Sketching", image: "https://picsum.photos/g/200?image=121", category: 'DOODLES'},
//         {title: "Acrillic", image: "https://picsum.photos/g/200?image=133", category: 'WORKSHOPS'},
//         {title: "Pencil", image: "https://picsum.photos/g/200?image=134", category: 'DOODLES'},
//         {title: "Pen", image: "https://picsum.photos/g/200?image=115", category: 'ART'},
//         {title: "Inking", image: "https://picsum.photos/g/200", category: 'WORKSHOPS'},
//       ]
//     },
//     methods: {
//       setFilter: function(filter) {
//         this.currentFilter = filter;
//       }
//     },
//     delimiters: ['${', '}$'],
//   })
