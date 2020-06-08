
$('.update-cart-form input[name="amount"]').on('change', function() {
	$(this).parent().submit();
});




$(document).ready(function() {

	$('#search-input').on('keyup', function() {
		//console.log($(this).val());
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
				$('#form-message').html(data['message']);
				appendPunList(data);
			},
		});
	}

	// Run the function getPunlist, on new pageload
	window.load = getPunlist('');



	function appendPunList(data) {
		let html = '';
		for (pun of data['puns']) {
			console.log(pun);

			html +=
				'<li class="list-group-item">' +
					'<p class="float-left">' +
						pun['content'] +
						' - ' +
						pun['create_date'] +
					'</p>' +

					'<form action="" method="POST" class="float-right">' +
						'<input type="hidden" name="punId" value="' + pun['id'] + '">' +
						'<input type="submit" name="deleteBtn" value="Delete" class="btn btn-danger delete-pun-btn">' +
					'</form>' +

					'<button type="button" class="btn btn-warning float-right" data-toggle="modal" data-target="#exampleModal" data-pun="' + pun['content'] + '" data-id="' + pun['id'] + '">Update</button>' +
				'</li>';
		}

		// Append newly generetad pun list
		$('#pun-list').html(html);

		// Add eventlisteners
		$('.delete-pun-btn').on('click', deletePunEvent);
	}
});	