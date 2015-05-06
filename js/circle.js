var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
var randomColorFactor = function(){ return Math.round(Math.random()*255)};

var pieData = [
	{
		value: randomScalingFactor(),
		color:"#F7464A",
		highlight: "#FF5A5E",
		label: "Red"
	},
	{
		value: randomScalingFactor(),
		color: "#46BFBD",
		highlight: "#5AD3D1",
		label: "Green"
	},
	{
		value: randomScalingFactor(),
		color: "#FDB45C",
		highlight: "#FFC870",
		label: "Yellow"
	},
	{
		value: randomScalingFactor(),
		color: "#949FB1",
		highlight: "#A8B3C5",
		label: "Grey"
	},
	{
		value: randomScalingFactor(),
		color: "#4D5360",
		highlight: "#616774",
		label: "Dark Grey"
	}

];

window.onload = function(){
	var ctx = document.getElementById("chart-area").getContext("2d");
	window.myPie = new Chart(ctx).Pie(pieData);
};

$('#randomizeData').click(function(){
	$.each(pieData, function(i, piece){
		pieData[i].value = randomScalingFactor();
    	pieData[i].color = 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',.7)';
	});
 	window.myPie.update();
 });
