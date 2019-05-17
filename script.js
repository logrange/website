$(".smooth-scroll").on("click", function(e){
    e.preventDefault();
	var c = $(this).prop("href").split('#');
	console.log($("#" + c[1])[0].offsetTop);
	$('body,html').animate({scrollTop: $("#" + c[1])[0].offsetTop}, 600, "swing");    
});