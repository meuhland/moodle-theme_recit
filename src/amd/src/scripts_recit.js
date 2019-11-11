(function($){
    // Background parallax effect
// Background parallax effect
$(window).scroll(function () {
    $(".c_parallax-recit, .parallax-pale-row, .parallax-dark-row").css("background-position","10% " + ($(this).scrollTop() / -5 + 90) + "px");
	// console.log("test yvon",$(this).scrollTop() );
});
/*
    function isInViewport(node) {
        var rect = node.getBoundingClientRect()
        return (
            (rect.height > 0 || rect.width > 0) &&
            rect.bottom >= 0 &&
            rect.right >= 0 &&
            rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.left <= (window.innerWidth || document.documentElement.clientWidth)
        )
    }
    $(window).scroll(function() {
        var scrolled = $(window).scrollTop()
        $('').each(function(index, element) {
            var initY = $(this).offset().top
            var height = $(this).height()
            var endY  = initY + $(this).height()

            // Check if the element is in the viewport.
            var visible = isInViewport(this)
            if(visible) {
                var diff = scrolled - initY
                var ratio = Math.round((diff / height) * 300)
                $(this).css('background-position','center ' + parseInt(-(ratio * -0.7)) + 'px')
            }
        })
    })*/


    // Gets the video src from the data-src on each button
    var $videoSrc;
    $('.video-btn').click(function() {
        $videoSrc = $(this).data( "src" );
    });
    console.log($videoSrc);
    // when the modal is opened autoplay it
    $('#myModal').on('shown.bs.modal', function (e) {
    // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
        $("#video").attr('src',$videoSrc + "?autoplay=0&amp;modestbranding=1&amp;showinfo=0" );
    })
    // stop playing the youtube video when I close the modal
    $('#myModal').on('hide.bs.modal', function (e) {
        // a poor man's stop video
        $("#video").attr('src',$videoSrc);
    })


    // Youtube video background
    $(".player").mb_YTPlayer({
        showControls : false,
        showYTLogo: false
    });
	
	
	$(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
	
  $('[data-toggle="popover"]').popover({
        html : true,
        trigger: 'focus',
        content: function() {
            var content = $(this).attr("data-popover-content");
            return $(content).children(".popover-body").html();
        }
    });

$('.ubeo_btn_expand').click(function() {
            $(this).parents('.math_content_expand').toggleClass('ubeo_zoom');
            $(this).parents('.container').toggleClass('ubeo_zoom');
            $(this).toggleClass('ubeo_zoom');
            $('html, body').toggleClass('ubeo_zoom');
        });
		
		

})(jQuery);


