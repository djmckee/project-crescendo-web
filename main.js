/**
 * A JavaScript file to animate image transitions between app screenshots for
 * the Sonata App promotional website.
 *
 * Created by Craig Hirst on 18/04/2016.
 */

function cycleImages(){
    var $active = $('#image_holder .active');
    var $next = ($active.next().length > 0) ? $active.next() : $('#image_holder img:first');
    $next.css('z-index', 2); //move the next image up the pile
    $active.fadeOut(1500,function(){ //fade out the top image
        $active.css('z-index', 1).show().removeClass('active'); //reset the z-index and unhide the image
        $next.css('z-index', 3).addClass('active'); //make the next image the top one
    });
}

$(document).ready(function(){
    setInterval('cycleImages()', 5500);
});
