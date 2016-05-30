<script src="js/jcarousel.js"></script>
<style type="text/css">

.partners_slideshow {
	margin-top: 10px;	
    overflow: hidden;
    padding: 0;
    width: 250px !important; 
    height: 250px;  
    border-radius: 8px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.75);  
}

.partners {
    z-index: 1;
    margin: 0;
    padding: 0;
    list-style-type: none;
}
.partner {
    float: left;
    width: 250px;
    height: 250px;
    cursor: pointer;
}


</style>

<script> 
    var carousel1Options = {
        auto: true,
        visible: 2,
        speed: 500,
        pause: true,
        btnPrev: function() {
            return $(this).find('.prev');
        },
        btnNext: function() {
            return $(this).find('.next');
        }
    };   


</script>
<div class="module_header">	
Наши партнеры:
</div>

<div class="partners" style="position: absolute; z-index: 2; width: 249px;">
	<div class="partners_slideshow">
        <ul class="partners">

            <a class="partner" href="/partners">
            <img class="partner_item" src="images/partner_1.jpg" href="">
            </a>

            <a class="partner" href="/partners">
            <img class="partner_item" src="images/partner_2.jpg">
            </a>

            <a class="partner" href="/partners">
            <img class="partner_item" src="images/partner_3.jpg" href="">
            </a>

            <a class="partner" href="/partners">
            <img class="partner_item" src="images/partner_4.jpg" href="">
            </a>

            <!-- <a class="partner" href="/partners">
            <img class="partner_item" src="images/partner_5.jpg" href="">
            </a> -->

        </ul>
    </div>
</div>

<script>	
	$(document).ready(function() {
        $('.partners_slideshow').jCarouselLite(carousel1Options);
        $('.prev').width(($(window).width() - $('.slideshow').width())/2);
        $('.prev').css('left', -($(window).width() - $('.slideshow').width())/2);
        $('.next').width(($(window).width() - $('.slideshow').width())/2);
        $('.slideshow').offset({ left: ($(window).width()/2) - $('.slideshow').width()/2});
	});

</script>