var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
var randomColorFactor = function(){ return Math.round(Math.random()*255)};


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
