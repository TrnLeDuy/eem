$( document ).ready(function() {
	$('.sortable').sortable({
		cursor: 'move',
		items: '> .another-field',
		update: function (event, ui) {
			var panel = $(this).parent();
			update_order_numbers(panel);
			
			// Tự động sắp xếp theo số thứ tự trong tiêu đề sau khi thêm trường mới
			sortByNumericPrefix($(this));
		}
	});
	
	// Thêm hàm sắp xếp theo số thứ tự trong tiêu đề
	function sortByNumericPrefix($container) {
		var $items = $container.children('.another-field').get();
		
		$items.sort(function(a, b) {
			var titleA = $(a).find('.field-label a, .field-label input[type="text"]').first().val() || 
						 $(a).find('.field-label a, .field-label input[type="text"]').first().text() || '';
			var titleB = $(b).find('.field-label a, .field-label input[type="text"]').first().val() || 
						 $(b).find('.field-label a, .field-label input[type="text"]').first().text() || '';
			
			// Extract numeric prefix if exists (e.g., "01. abc" -> 1)
			var numA = parseInt(titleA.match(/^(\d+)\.\s*/) ? titleA.match(/^(\d+)\.\s*/)[1] : 999);
			var numB = parseInt(titleB.match(/^(\d+)\.\s*/) ? titleB.match(/^(\d+)\.\s*/)[1] : 999);
			
			return numA - numB;
		});
		
		$.each($items, function(i, item) {
			$container.append(item);
		});
		
		update_order_numbers($container.parent());
	}
	
	// Thêm nút sắp xếp vào giao diện
	$('.field_infor').each(function() {
		var $panel = $(this);
		var $sortButton = $('<button type="button" class="btn btn-sm btn-default sort-by-title" style="margin-left: 10px;">Sắp xếp theo số thứ tự</button>');
		$panel.find('.add-field-button').after($sortButton);
		
		$sortButton.on('click', function(e) {
			e.preventDefault();
			sortByNumericPrefix($panel.find('.sortable'));
		});
	});
	
	// Sắp xếp tự động khi trang tải xong
	setTimeout(function() {
		$('.sortable').each(function() {
			sortByNumericPrefix($(this));
		});
	}, 500);
});
