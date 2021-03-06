$(".smooth-scroll").on("click", function(e){
    e.preventDefault();
	var c = $(this).prop("href").split('#');
	console.log($("#" + c[1])[0].offsetTop);
	$('body,html').animate({scrollTop: $("#" + c[1])[0].offsetTop}, 600, "swing");    
});

$(".left-side-menu a").on("click", function() {
	console.log($(this).html());
	$(".left-side-menu a").removeClass("active");
	$(this).addClass("active");
	var lnk = $(this).attr("href").split("#");
	var hrf = document.location.href.split("#");
	if (lnk[0] == hrf[0])
		$(".page-title-content").html($(this).html());
});
$("#copy2clipboard").on("mouseup", setClipboard);

$("h6.dropdown-header").on({
	"click" : function() {
		$("h6.dropdown-header").removeClass("active");
		$(this).addClass("active");
	}
});
// mobile menu
$("h6.level-1").on({
	"click" : function() {
		$("h6.level-1").removeClass("active");
		$(this).addClass("active");
	}
});		
$("h6.level-2").on({
	"click" : function() {
		$("h6.level-2").removeClass("active");
		$(this).addClass("active");
}
});
$("button.navbar-toggler").on({
	"click" : function() {
		$(".screen-shadow").toggle();
	}
});
$(".screen-shadow, .level-2-submenu a").on({
	"click" : function() {
		$(".navbar.top-navbar .navbar-toggler").attr("aria-expanded", "false");
		$(".screen-shadow").toggle();
		$(".navbar-collapse.collapse").removeClass("show");
	}
});
$(".level-2-submenu a").on({
	"click" : function() {
		$(".level-2-submenu a").removeClass("active");
		$(this).addClass("active");
		var lnk = $(this).attr("href").split("#");
		var hrf = document.location.href.split("#");
		if (lnk[0] == hrf[0])
			$(".page-title-content").html($(this).html());
	}
});

		
function setClipboard(){
    var id = "_tmp";
    var existsTextarea = document.getElementById(id);

    if(!existsTextarea){
        var textarea = document.createElement("textarea");
        textarea.id = id;
        textarea.style.position = 'fixed';
        textarea.style.top = 0;
        textarea.style.left = 0;

        textarea.style.width = '1px';
        textarea.style.height = '1px';
        textarea.style.padding = 0;
        textarea.style.border = 'none';
        textarea.style.outline = 'none';
        textarea.style.boxShadow = 'none';
        textarea.style.background = 'transparent';
        document.querySelector("body").appendChild(textarea);
        existsTextarea = document.getElementById(id);
    }
    existsTextarea.value = $(".tab-pane.active").text();
    existsTextarea.select();

    try {
        var status = document.execCommand('copy');
        if(!status){
            //console.error("Cannot copy text");
        }else{
            //console.log("The text is now on the clipboard");
        }
    } catch (err) {
        //console.log('Unable to copy.');
    }
}

function showInfo(msg) {
	$("#formInfo").html(msg);
}