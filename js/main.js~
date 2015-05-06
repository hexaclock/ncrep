$(function() {
	$("table td, table th").hover(function() {
		var i = $(this).index()+1;
		updateTableColor(i, "#E8E8E8");
	}, function() {
		var i = $(this).index()+1;
		updateTableColor(i, "#fff");
	});
	
	// event listeners for form
	$('#falseupload').click(function(){
		$("#packet").click();
	});
	
	$("#packet").change(function() {
		var filename = $('input[type=file]').val().split('\\').pop();
		$(".filepath").text(filename);
	});
	
	$('form').on('submit', function(e) {
		$('input[type=submit]', this).val("Uploading...").prop('disabled', true);
	});
	
	
	// tabbed content listeners
	$(".actualstats").hide();
	$(".togglestats").click({butt: "togglestats", div: "actualstats"}, toggle);
	$(".rawdata").hide();
	$(".toggleraw").click({butt: "toggleraw", div: "rawdata"}, toggle);
	
	
	
});

function toggle(event)
{
	// reset highlights
	$(".tabbed span.highlight").removeClass("highlight");
	
	//toggle view and highlight if necessary
	if($("."+event.data.div).css("display") == 'none')
	{
		$("."+event.data.div).show();
		$("."+event.data.butt).addClass("highlight");
	}
	else
	{
		$("."+event.data.div).hide();
	}
	
	//hide all other divs
	$(".tabbed>div").each(function() {
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
