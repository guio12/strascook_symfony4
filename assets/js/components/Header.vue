<template>
    <header 
        v-bind:class="{ 'clicked': isActive }"  
        >
	<img  class="logo" src="/build/images/logo-noir.png">
	<div class="nav-modal">
		<div class="blob"></div>
		<nav>
			<ul>
				<li><a href="/">ACCUEIL</a></li>
				<li><a href="/menus">MENUS</a></li>
				<li><a href="/lechef">A PROPOS DU CHEF</a></li>
				<li><a href="/booking">RESERVATIONS</a></li>
				<li><a href="/contact">CONTACT</a></li>
			</ul>
		</nav>
	</div>
	<div class="head">
		<div class="tile burger" v-on:click="toggleHeader()">
			<div class="meat">
				<div class="line one"></div>
				<div class="line two"></div>
				<div class="line three"></div>
			</div>
		</div>
	</div>
</header>
</template>

<script>

    export default {
        data: function() {
            return {
                isActive: false,
                showBody: true
            }
        },
        methods: {
           toggleHeader: function() {
               return (this.isActive = !this.isActive) && (this.showBody = !this.showBody);
           }
        }
    }
    
    
</script>


<style scoped>

header *{
	box-sizing: border-box;
	margin: 0;
	padding: 0;
}
header{
	height: 120px;
	width: 100%;
	position: relative;
	background-color: white;
	box-shadow: 0px 2px 5px rgba(0,0,0,.4);
}
a {
    color: red;
    text-decoration: none;
    
    background-image: linear-gradient(currentColor, currentColor);
    background-position: 0% 100%;
    background-repeat: no-repeat;
    background-size: 0% 2px;
    transition: background-size .3s;
}

a:hover, a:focus {
    background-size: 100% 8px;
    color: white;
}
.logo{
	width: 200px;
	display: block;
	margin: 0 auto;
	padding-top: 15px;
}
.head{
	position: absolute;
	top: 35px;
	right: 50px;
}
.head .tile{
	display: inline-block;
	height: 50px;
	width: 50px;
	margin-left: 5px;
	transition: all .3s ease-in;
	-webkit-transition: all .3s ease-in;
}
.head .burger{
	margin-left: 25px;
	padding: 5px;
	cursor: pointer;
	background-color: transparent;
}
.meat{
	height: 40px;
	width: 40px;
	position: relative;
	transition: all .3s ease-in;
	-webkit-transition: all .3s ease-in;
}
header.clicked .head .burger .meat{
	transform: rotate(180deg);
	-webkit-transform: rotate(180deg);
}
.meat .line{
	height: 4px;
	width: 40px;
	background-color: #0b253e;
	border-radius: 3px;
	position: absolute;
	transition: all .3s ease-in;
	-webkit-transition: all .3s ease-in;
}
.meat .line.one{top: 5px; left: 0px;}
.meat .line.two{top: 18px; left: 0px;}
.meat .line.three{top: 31px; left: 0px;}

header.clicked .burger .line{
	background-color: white;
}
header.clicked .burger .line.one{
	transform: rotate(45deg);
	-webkit-transform: rotate(45deg);
	top: 18px;
}
header.clicked .burger .line.two{
	transform: rotate(-45deg);
	-webkit-transform: rotate(-45deg);
	top: 18px;
}
header.clicked .burger .line.three{
	opacity: 0;
}
header.clicked .burger:hover .meat{
	transform: rotate(270deg);
	-webkit-transform: rotate(270deg);
}








.nav-modal{
	position: fixed;
	top: 0px;
	left: 0px;
	width: 100%;
	height: 100vh;
	visibility: hidden;
	opacity: 0;
	transition: all .3s ease-in;
	-webkit-transition: all .3s ease-in;
	pointer-events: none;
}
header.clicked .nav-modal{
	visibility: visible;
	opacity: 1;
	pointer-events: initial;
}

.nav-modal .blob{
	display: block;
	width: 10px;
	height: 10px;
	border-radius: 100%;
	margin: 0 auto;
    background-image: url('/build/images/fond_header.jpg');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
	/* background-color: #0b253e; */
	position: relative;
	top: 50%;
	transform: translateY(-50%);
	-webkit-transform: translateY(-50%);
	transition: all .3s ease-in;
}
header.clicked .nav-modal .blob{
	width: 100vw;
	height: 100vh;
	border-radius: 0px;
}

nav{
	position: fixed;
	left: 20%;
	top: 30%;
	color: white;
}
nav a{
	color: white;
	text-decoration: none;
	font-family: sans-serif;
	font-family: 'Oswald', sans-serif;
	font-size: 30px;
}
nav ul li{
	list-style: none;
	text-align: right;
	border-right: 6px solid white;
	padding-bottom: 10px;
	padding-right: 10px;
	position: relative;
}
nav{
	opacity: 0;
	transition: all .3s ease-in;
	-webkit-transition: all .3s ease-in;
	-webkit-transition-delay: .3s;
	-moz-transition-delay: .3s;
	-o-transition-delay: .3s;
	transition-delay: .3s;
}
header.clicked nav{
	opacity: 1;
}

nav ul li ul{
	position: absolute;
	right: -300px;
	top: -4px;
	display: none;
}
nav ul li ul li{
	border: none;
	padding-bottom: 10;
	padding-left: 10px;
	height: 50px;
	width: 300px;
}
nav ul li ul li a{
	display: block;
	height: 50px;
	font-size: 20px;
	text-align: left;
	padding: 10px;
}
nav ul li.selected ul{
	display: block;
}

nav ul li.notselected a{
	opacity: .5;
}
nav ul li.selected ul li a{
	opacity: 1;
}





@media screen and (max-width:820px){
	.logo{margin-left: 50px;}
}
@media screen and (max-width:580px){
	.logo{width: 130px; padding-top: 30px;}
	nav ul li a{
		font-size: 16px;
	}
	nav ul li ul{
		top: -9px;
	}
	nav ul li ul li{
		height: 40px;
	}
	nav ul li ul li a{
		font-size: 16px;
		height: 40px;
	}
}
@media screen and (max-width:500px){
	.logo{display: none;}
}
@media screen and (max-width:320px){
	header .head {
		display: none;
	}
}
</style>


