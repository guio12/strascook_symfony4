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

  import Header from './components/Header'
  import Menus from './components/Menus'

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


  Vue.component('my-header', Header)

  new Vue({
    delimiters: ['${', '}$'],
    el: '#app-header',
    components: {Header},
    data: {
        
    },
    methods: {
        
    }
  })