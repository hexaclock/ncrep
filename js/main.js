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
	$(".actualstats").toggle();
}

function updateTableColor(n, color)
{
	$("table th:nth-child("+n+")").css("background-color", color);
	$("table tr td:nth-child("+n+")").each( function () {
		$(this).css("background-color", color);
	});
}
