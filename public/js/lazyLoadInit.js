// Main Function
function StartLazyLoad() {
    $("img").lazyload({ 
        effect: "fadeIn" 
    });
    console.log('✔️ LazyLoad Images Initiated 🟢');
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
