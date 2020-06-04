
$('.update-cart-form input[name="amount"]').on('change', function() {
	$(this).parent().submit();
});