jQuery(document).ready(function($){
	// classic form handlers
	alternateHandler = function(){
		var parent = this;
		$('.alternates>div', this).slideUp('fast', function(){
			$('.alternates .'+$('select', parent).val()+'-container', parent).slideDown();
		});
	}
	$('.alternate-wrapper').each(alternateHandler).change(alternateHandler);
	
	optionalHandler = function(){
		if($('input:checked', this).length > 0){
			$('.optionals', this).slideDown();
		} else {
			$('.optionals', this).slideUp();
		}
	}
	$('.optional-wrapper').each(optionalHandler).change(optionalHandler);
	
	// admin table
	if($('.table-creator').length > 0){
		$table = $('.table-creator');
		
		$('.table-selector').change(function(){
			$(this).parents('form').submit();
		});
		
		$('.add-column').click(function(){
			$('tr', $table).each(function(i){
				if(i == 0) {
					$('th:last', this).clone().appendTo(this);
				}
				$td = $('td:last', this).clone().appendTo(this);
			});
			recalculateNames();
			return false;
		});
		
		$('.add-row').click(function(){
			$('tr:last', $table).clone().appendTo($table);
			recalculateNames();
			return false;
		});
		
		$('.remove-column').live('click', function(){
			var index = $(this).parent().index();
			console.log(index);
			if(index > 1){
				$('tr', $table).each(function(i){
					$('td:eq('+(index-1)+')', this).remove();
					$('th:eq('+index+')', this).remove();
				});
			}
			recalculateNames();
			return false;
		});
		
		$('.remove-row').live('click', function(){
			var index = $(this).parents('tr').index();
			if(index > 1){
				$('tr:eq('+index+')').remove();
			}
			recalculateNames();
			return false;
		});
		
		recalculateNames = function(){
			$('th .remove-row, th .remove-column').show();
			$('th .remove-row:first, th .remove-column:first').hide();
			$('td', $table).each(function(){
				var col = $(this).index() - 1;
				var row = $(this).parent().index() - 1;
				$('textarea', this).attr('name', 'cell['+row+']['+col+']');
			});
		}
		
		recalculateNames();
	}
});