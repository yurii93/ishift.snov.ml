
/* Checkboxes */
$('input .children').click(function () {
    $('.children-info').toggle();
});

$('.children-label').click(function () {
    $('.children-info').toggle();
});

$('input .breakfast').click(function () {
    $('.breakfast-info').toggle();
});

$('.breakfast-label').click(function () {
    $('.breakfast-info').toggle();
});

/* Breakfast */
$('#breakfast').click(function(){
    if ($('#breakfast').is(':not(:checked)')) {
        $('#saturday').attr("checked", false);
        $('#sunday').attr("checked", false);
    }
});

/* Breakfast */
$('#children').click(function(){
    if ($('#children').is(':not(:checked)')) {
        $('#childrenInfo').val('');
    }
});

/* Hide messages */
if(device.desktop()) {
	setTimeout(function() {
		$('div.message').fadeOut('slow');
	}, 15000);
}

/* Pay button */
$('#oportunity').click(function(){
	
	console.log('asd');
    if ($('#oportunity').is(':checked')) {
        $('.pay-btn').val('ЗАРЕГИСТРИРОВАТЬСЯ');
    }
	if ($('#oportunity').is(':not(:checked)')) {
		$('.pay-btn').val('ОПЛАТИТЬ');
	}
	
});

/* Reload if resize */
 $(document).ready(function(){
	 
	var width = $(window).width();
	
	$(window).resize(function(){
		if($(window).width() != width) {
			window.location.reload()
		}
	});
});

/* Reload if resize */
/*
$(document).ready(function(){
    $(window).resize(function(){
        console.log('adasdad');
        window.location.reload();
    });
});*/

/*
if ($(window).width() > 1000){
    $('head').html($('head').html().html("<script src='webroot/js/bundle.js'</script>"));
}*/
