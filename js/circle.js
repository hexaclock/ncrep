var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
var randomColorFactor = function(){ return Math.round(Math.random()*255)};


window.onload = function(){
	var ctx = document.getElementById("chart-area").getContext("2d");
	window.myPie = new Chart(ctx).Doughnut(pieData);
};
