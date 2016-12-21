// JavaScript Document

$(document).ready(function(){

       $(".myMenu").buildMenu(
	  {
		//template:"menu.html",
		//additionalData:"pippo=1",
		menuWidth:200,
		openOnRight:false,
		menuSelector: ".menuContainer",
		//iconPath:"ico/",
		hasImages:false,
		fadeInTime:100,
		fadeOutTime:300,
		adjustLeft:2,
		minZindex:"auto",
		adjustTop:0,
		opacity:1,
		shadow:true,
		shadowColor:"#ccc",
		//hoverIntent:0,
		//openOnClick:true,
		closeOnMouseOut:true,
		closeAfter:1000
	  });
});

