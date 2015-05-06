$(function() {
	$("table td, table th").hover(function() {
		var i = $(this).index()+1;
		updateTableColor(i, "#E8E8E8");
	}, function() {
		var i = $(this).index()+1;
		updateTableColor(i, "#fff");
	});
	
	toggle_actualstats();
	$(".togglestats").click(toggle_actualstats);
	
	toggle_rawdata()
	$(".toggleraw").click(toggle_rawdata);
	
	/*$("form").submit(function() {
		$('input[type=submit]', this).val("Uploading...").attr('disabled', 'disabled');
		//return true;
	});*/
	
	$('form').on('submit', function(e) {
		$('input[type=submit]', this).val("Uploading...").prop('disabled', true);
		// e.preventDefault();
	});
	
});

function toggle_actualstats()
{
	$(".togglestats").parent().find("div").each(function() {
		if(!$(this).hasClass("actualstats"))
			$(this).hide();
	});
	if($(".actualstats").attr("display") == 'none')
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

function toggle_rawdata()
{
	$(".toggleraw").parent().find("div").each(function() { 
		if(!$(this).hasClass("rawdata"))
			$(this).hide();
	});
	if($(".rawdata").attr("display") == 'none')
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
