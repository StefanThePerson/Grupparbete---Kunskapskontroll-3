
$('.update-cart-form input[name="amount"]').on('change', function() {
	$(this).parent().submit();
});



$(document).ready(function() {

	$('#search-input').on('keyup', function() {
		getPunlist($(this).val());
	});

	function getPunlist(searchQuery) {
		$.ajax({
			method: 'GET',
			url: 'search.php',
			data: { // Skickas till search.php i form av GET parametrar
				searchQuery: searchQuery 
			},
			dataType: 'json',
			success: function(data) {
				console.log(data);
				appendPunList(data);
			},
		});
	}

	// Run the function getPunlist, on new pageload
	// window.load = getPunlist('');



	function appendPunList(data) {
		let html = '';
		for (product of data['products']) {
			// console.log(product);

			html +=
				'<li class="list-group-item">' +
					'<form action="single_product.php" method="get">' +
						'<input type="hidden" name="id" value="' + product['id'] + '">' +
						// '<input type="submit" class="btn btn-primary" value="Product Details">' +

						'<p class="float-left">' +
							'<img src="admin/' + product['img_url'] + '"/>' +
							product['title'] +
							' - ' +
							'$' + product['price'] +
						'</p>' +

					'</form>' +
				'</li>';
		}

		// Append newly generetad pun list
		$('#product-list').html(html);
	}
});	