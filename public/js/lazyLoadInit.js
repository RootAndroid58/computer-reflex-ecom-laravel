// Main Function
function StartLazyLoad() {
    $('img').Lazy({
        effect: 'fadeIn',
        visibleOnly: true,
        onError: function(e) {
            
        },
        beforeLoad: function(e) {
           
        },
        afterLoad: function(e) {
            
        },
        onFinishedAll: function() {
            
        }
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
