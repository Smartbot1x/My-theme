<div class="face">
	<div class="band">
		<div class="red"></div>
		<div class="white"></div>
		<div class="blue"></div>
	</div>
	<div class="eyes"></div>
	<div class="dimples"></div>
	<div class="mouth"></div>
</div>

<h1>Oops! Something went wrong!</h1>
<a href="#" onclick="window.history.back();">
<div class="btn">Return to Home</div></a>
<style>
html, body {
	margin: 0;
	padding: 0;
	width: 100%;
	min-height: 100vh;
	background-color: #F2EEE8;
	font-family: 'Open Sans';
}

*, *:before, *:after {
	box-sizing: content-box;
	transform: translate3d(0, 0, 0);
}

.face {
	width: 300px;
	height: 300px;
	border: 4px solid #383A41;
	border-radius: 10px;
	background-color: #FFFFFF;
	margin: 0 auto;
	margin-top: 100px;
}

@media screen and (max-width: 400px) {
	.face {
		margin-top: 40px;
		transform: scale(.8);
	}
	.btn {
		margin: 0 auto;
		margin-top: 60px;
		margin-bottom: 50px;
		width: 200px;
	}
	h1 {
		padding-left: 20px;
		padding-right: 20px;
		font-size: 2em;
	}
}

.band {
	width: 350px;
	height: 27px;
	border: 4px solid #383A41;
	border-radius: 5px;
	margin-left: -25px;
	margin-top: 50px;
	position: relative;
	overflow: hidden;
}

.red {
	height: calc(100% / 3);
	width: 100%;
	background-color: #EB6D6D;
}

.white {
	height: calc(100% / 3);
	width: 100%;
	background-color: #FFFFFF;
}

.blue {
	height: calc(100% / 3);
	width: 100%;
	background-color: #5E7FDC;
}

.band:before {
	content: "";
	display: inline-block;
	height: 27px;
	width: 30px;
	background-color: rgba(242,238,232,0.3);
	position: absolute;	
	z-index: 999;
}

.band:after {
	content: "";
	display: inline-block;
	height: 27px;
	width: 30px;
	background-color: rgba(56,58,65,0.3);
	position: absolute;	
	z-index: 999;
	right: 0;
	top: 0;
}

.eyes {
	width: 128px;
	margin: 0 auto;
	margin-top: 40px;
	position: relative;
}

.eyes:before {
	content: "";
	display: inline-block;
	width: 30px;
	height: 15px;
	border: 7px solid #383A41;
	margin-right: 20px; 
	border-top-left-radius: 22px;
	border-top-right-radius: 22px;
	border-bottom: 0;
}

.eyes:after {
	content: "";
	display: inline-block;
	width: 30px;
	height: 15px;
	border: 7px solid #383A41;
	margin-left: 20px;
	border-top-left-radius: 22px;
	border-top-right-radius: 22px;
	border-bottom: 0;
}

.dimples {
	width: 180px;
	margin: 0 auto;
	margin-top: 15px;
	position: relative;
}

.dimples:before {
	content: "";
	display: inline-block;
	width: 10px;
	height: 10px;
	margin-right: 80px; 
	border-radius: 50%;
	background-color: rgba(235,109,109,0.4);
}

.dimples:after {
	content: "";
	display: inline-block;
	width: 10px;
	height: 10px;
	margin-left: 80px;
	border-radius: 50%;
	background-color: rgba(235,109,109,0.4);
}

.mouth {
	width: 40px;
	height: 5px;
	border-radius: 5px;
	background-color: #383A41;
	margin: 0 auto;
	margin-top: 25px;
}

h1 {
	font-weight: 800;
	color: #383A41;
	text-align: center;
	font-size: 2.5em;
	padding-top: 20px;
}

.btn {
	font-family: "Open Sans";
	font-weight: 400;
	padding: 20px;
	background-color: #5E7FDC;
	color: white;
	width: 320px;
	margin: 0 auto;
	text-align: center;
	font-size: 1.2em;
	border-radius: 5px;
	cursor: pointer; 
	margin-top: 80px;
	margin-bottom: 50px;
	transition: all .2s linear;
}

.btn:hover {
	background-color: rgba(94,127,220,0.8);
	transition: all .2s linear;
}
</style>
