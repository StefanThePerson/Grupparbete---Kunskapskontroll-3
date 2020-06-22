
// ---------------update product amount in checkout page------------------------
$('.update-cart-form input[name="amount"]').on('change', function() {
	$(this).parent().submit();
});



// ------------------------search function--------------------------------------
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


	function appendPunList(data) {
		let html = '';
		for (product of data['products']) {
			// console.log(product);

			html +=
				'<li class="list-group-item search-product-list-group">' +

					'<a href="single_product.php?id=' + product['id'] +'">' +
						'<p class="float-left">' +
							'<img src="admin/' + product['img_url'] + '"/>' +
							product['title'] +
							' - ' +
							'$' + product['price'] +
						'</p>' +
					'</a>'
				'</li>';
		}

		// Append newly generetad pun list
		$('#product-list').html(html);
	}
});	



// ------------------------------image upload---------------------------------
$(document).ready(function() {
	
    let readURL = function(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
   
    $('.file-upload').on('change', function(){
        readURL(this);
    });
    
    $('.upload-button').on('click', function() {
       $('.file-upload').click();
    });
});



// ---------------add box shadow to above header on page scroll---------------
$(window).scroll(function() {
	let height = $(window).scrollTop();
	if(height  > 50) {
		$('.sticky-top').css({'box-shadow': '0 4px 8px 0 rgba(0, 0, 0, 0.5)'});
	} else{
		$('.sticky-top').css({'box-shadow': 'none'});
	}
});