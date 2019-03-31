<template>
  <div>
    <div class="title-container">
      <div>
        <h3 class="title">Les Menus</h3>
      </div>
      <div class="filters">
        <span
          class="filter"
          v-bind:class="{ active: currentFilter === 'tous' }"
          v-on:click="setFilter('tous')"
        >tous</span>
        <span
          class="filter"
          v-bind:class="{ active: currentFilter === 'classique' }"
          v-on:click="setFilter('classique')"
        >classique</span>
        <span
          class="filter"
          v-bind:class="{ active: currentFilter === 'vegetarien' }"
          v-on:click="setFilter('vegetarien')"
        >végétarien</span>
        <span
          class="filter"
          v-bind:class="{ active: currentFilter === 'vegan' }"
          v-on:click="setFilter('vegan')"
        >vegan</span>
      </div>
    </div>

  <div class="container">
    <transition-group class="menus col-12" name="menus">
      <div class="menu col-3" v-bind:key="m.id" v-for="m in menu" v-if="currentFilter === m.type.type || currentFilter === 'tous' && m.online">
          <div class="menu-image-wrapper">
            <img class="menu-image" :src="imgUrl(m.image)">
            
            <div class="menu-title-container">
              <span class="menu-title">{{ m.titre }}</span>
              <!-- <button id="show-modal" @click="[showModal = true, showMenu = false]">Show Modal</button>
              <menu-modal v-if="showModal" @close="[showModal = false, showMenu = true]">
                <h3 slot="header">custom header</h3>
              </menu-modal> -->
              
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <defs>
	  <symbol id="arrow" viewBox="0 0 100 100">
	  	<path d="M12.5 45.83h64.58v8.33H12.5z"/>
    		<path d="M59.17 77.92l-5.84-5.84L75.43 50l-22.1-22.08 5.84-5.84L87.07 50z"/>
	  </symbol>
  </defs>
</svg>

<div class="container-arrow">
	
	<div class="content">
		
		<a href="#" class="button">
			Button Text
			<span>
				<svg>
					<use xlink:href="#arrow" href="#arrow"></use>
				</svg>
			</span>
		</a>
		
	</div>
	
</div>
        </div>
      </div>
    </transition-group>
  </div>

  </div>
</template>

<script>

import MenuModal from './MenuModal.vue';

export default {
  props: {
    menu: {
      type: Array
    }
  },
  data() {
    return {
      currentFilter: "tous",
      showModal: false,
      showMenu: true
    };
  },
  methods: {
    setFilter: function(filter) {
      this.currentFilter = filter;
    },
    imgUrl(image) {
        return '/build/images/uploads/menu/' + image
    }
  },
  components: {
    'menu-modal': MenuModal
  }
};
</script>

<style lang="scss">
html,
body {
  margin: 0;
  font-family: "Dawning of a New Day", cursive;
}

.title-container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.title {
  font-family: "Dawning of a New Day", cursive;
  font-size: 30pt;
  font-weight: normal;
}

.menu-title {
  font-size: 16pt;
}

.menu-title-container {
  text-align: center;
}

.filter {
  font-family: arial;
  padding: 6px 6px;
  cursor: pointer;
  border-radius: 6px;
  transition: all 0.35s;
}

.filter.active {
  box-shadow: 0px 1px 3px 0px #00000026;
}

.filter:hover {
  background: lightgray;
}

.menus {
  margin-bottom: 50px;
  margin-top: 25px;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.menus-enter {
  transform: scale(0.5) translatey(-80px);
  
  opacity: 0;
}

.menus-leave-to {
  transform: translatey(30px);
  opacity: 0;
}

.menus-leave-active {
  position: absolute;
  z-index: -1;
  transition: all 200ms ease-in;
}

.circle {
  text-align: center;
  position: absolute;
  bottom: -58px;
  left: 40pt;
  width: 100px;
  height: 100px;
  border-radius: 50px;
  /* 	border:1px solid black; */
  display: flex;
  box-shadow: 0px -4px 3px 0px #494d3257;
  justify-content: center;
  align-items: center;
  background-color: #fff;
  /* 	box-shadow:0px -3px 3px #484848a6; */
}

.menu {
  /* transition: all 0.55s ease-in; */
  transition: all 200ms ease-out;
  
  margin: 10px;
  box-shadow: 0px 2px 8px lightgrey;
  border-radius: 3px;
  width: 180px;
  height: 300px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.menu:hover {
   background: #fff;
    box-shadow: 12px 15px 20px 0px rgba(46,61,73,0.15);
    border-radius: 4px;
    transition: all 0.3s ease;
}

.menu-image-wrapper {
  position: relative;
}

.gradient-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 150px;
  opacity: 0.09;
  background: linear-gradient(
      to bottom,
      rgba(0, 210, 247, 0.65) 0%,
      rgba(0, 210, 247, 0.64) 1%,
      rgba(0, 0, 0, 0) 100%
    ),
    linear-gradient(
      to top,
      rgba(247, 0, 156, 0.65) 0%,
      rgba(247, 0, 156, 0.64) 1%,
      rgba(0, 0, 0, 0) 100%
    );
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
  border-top-left-radius: 3px;
  border-top-right-radius: 3px;
}

.menu-image {
  width: 100%;
  height: 200px;
  border-bottom-left-radius: 5px;
  border-bottom-right-radius: 5px;
  border-top-left-radius: 3px;
  border-top-right-radius: 3px;
}

@import url('https://fonts.googleapis.com/css?family=Droid+Serif');

$button-color: #4A90E2;
$transition-time: 750ms;

.container-arrow {
	display: flex;
	align-items: center;
	justify-content: center;
	
	
	font-family: 'Droid Serif', serif;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
}

.button {
	position: relative;
	display: inline-flex;
	text-decoration: none;
	color: #fff;
	background-color: lighten($button-color, 10%);
	padding-left: 2rem;
	overflow: hidden;
	z-index: 1;
	align-items: center;
	box-shadow: 0px 3px 4px -4px rgba(0,0,0,0.75);
	
	&::before {
		content: '';
		position: absolute;
		left: 0;
		top: 0;
		transform: scaleX(0);
		transform-origin: 0 50%;
		width: 100%;
		height: 100%;
		background-color: $button-color;
		z-index: -1;
		transition: transform $transition-time;
	}
	
	span {
		display: flex;
		align-items: center;
		justify-content: center;
		margin-left: 2rem;
		padding: 1rem;
		overflow: hidden;
		background-color: $button-color;
	}
	
	svg {
		max-width: 20px;
		width: 100%;
		height: auto;
		max-height: 18px;
		fill: white;
	}
	
	&:hover {
		text-decoration: none;
    color: white;
		&::before {
			transform: scaleX(1);
		}
		
		svg {
			animation: moveArrow $transition-time;
		}
		
	}
	
}

@keyframes moveArrow {
	
	0% {
		transform: translateX(0px);
	}
	
	49% {
		transform: translateX(50px);
	}
	
	50% {
		transform: translateX(-50px);
	}
	
	100% {
		transform: translateX(0px);
	}
	
}
</style>

