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

function toggle(e)
{
	$(".tabbed span.highlight").removeClass("highlight");
	if($("."+e.data.div).css("display" == 'none')
	{
		$("."+e.data.div).show();
		$("."+e.data.butt).addClass("highlight");
	}
	else
	{
		$("."+e.data.div).hide();
	}
}

function toggle_actualstats()
{
	resetHighlight();
	$(".togglestats").parent().find("div").each(function() {
		if(!$(this).hasClass("actualstats"))
			$(this).hide();
	});
	if($(".actualstats").css("display") == 'none')
	{
		$(".actualstats").show();
		$(".togglestats").addClass("highlight");
	}
	else
	{
		$(".actualstats").hide();
		$(".togglestats").removeClass("highlight");
	}
}

function resetHighlight()
{
	$(".tabbed span.highlight").removeClass("highlight");
}

function toggle_rawdata()
{
	resetHighlight();
	$(".toggleraw").parent().find("div").each(function() {
		if(!$(this).hasClass("rawdata"))
			$(this).hide();
	});
	if($(".rawdata").css("display") == 'none')
	{
		$(".rawdata").show();
		$(".toggleraw").addClass("highlight");
	}
	else
	{
		$(".rawdata").hide();
		$(".toggleraw").removeClass("highlight");
	}
}

function updateTableColor(n, color)
{
	$("table th:nth-child("+n+")").css("background-color", color);
	$("table tr td:nth-child("+n+")").each( function () {
		$(this).css("background-color", color);
	});
}
