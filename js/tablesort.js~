$(function() {
	$('.packet-info th').click(function(e) {
		 var tosort = this;
		 var $table = $('.packet-info');
		 var index = $(this).index()+1;
		 var $rows = $('tr:gt(1)',$table);
		 $rows.sort(function(a, b) {
			  var keyA = $('td:nth-child('+index+')',a).text();
			  var keyB = $('td:nth-child('+index+')',b).text();
			  if($(tosort).hasClass('asc')){
					return (keyA > keyB) ? 1 : 0;
			  } else {
					return (keyA > keyB) ? 0 : 1;
			  }
		 });
		 
		 $.each($rows, function(index, row) {
		 	$table.append(row);
		 });
		 
		 if($(tosort).hasClass('asc'))
		 	{
		 		$(tosort).removeClass('asc').addClass('dec');
		 	}
		 else
		 	$(tosort).removeClass('dec').addClass('asc');
		 	
		 
		 e.preventDefault();
	});
});
