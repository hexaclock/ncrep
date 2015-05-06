$(function() {
	$("table td, table th").hover(function() {
		var i = $(this).index()+1;
		updateTableColor(i, "#E8E8E8");
	}, function() {
		var i = $(this).index()+1;
		updateTableColor(i, "#fff");
	});
	
	$(".actualstats").hide();
	$(".togglestats").click({butt: "togglestats", div: "actualstats"}, toggle);
	$(".rawdata").hide();
	$(".toggleraw").click({butt: "toggleraw", div: "rawdata"}, toggle);
	
	/*$("form").submit(function() {
		$('input[type=submit]', this).val("Uploading...").attr('disabled', 'disabled');
		//return true;
	});*/
	
	$('form').on('submit', function(e) {
		$('input[type=submit]', this).val("Uploading...").prop('disabled', true);
		// e.preventDefault();
	});
	
});

function toggle(event)
{
	console.log("hi "+event.data.div);
	$(".tabbed span.highlight").removeClass("highlight");
	if($("."+event.data.div).css("display") == 'none')
	{
		$("."+event.data.div).show();
		$("."+event.data.butt).addClass("highlight");
	}
	else
	{
		$("."+event.data.div).hide();
	}
	$(".tabbed div").each(function() {
		if(!$(this).hasClass(event.data.div))
			$(this).hide();
	});
}

function updateTableColor(n, color)
{
	$("table th:nth-child("+n+")").css("background-color", color);
	$("table tr td:nth-child("+n+")").each( function () {
		$(this).css("background-color", color);
	});
}
