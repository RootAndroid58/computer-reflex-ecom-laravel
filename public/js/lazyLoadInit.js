// Main Function
function StartLazyLoad() {
    console.log('😃LazyLoad Images Initiated ❤️');
    $("img.lazyImg").lazyload({ 
        effect: "fadeIn" 
    }).removeClass("lazyImg");
}
// Initiate on Document Ready
StartLazyLoad();
// Initiate on Ajax Stop (Ajax Load Finished)
$(document).ajaxStop(function(){
    StartLazyLoad();
});
// Manual trigger from HTML (i.e onCLick)
function lazyImgInit() {
    $(window).trigger("scroll");
}
