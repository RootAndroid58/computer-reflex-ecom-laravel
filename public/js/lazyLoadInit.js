// Main Function
function StartLazyLoad() {
    $('img').Lazy({
        effect: 'fadeIn',
        visibleOnly: true,
        onError: function(e) {
            console.log('error loading ' + e.data('src'));
        },
        beforeLoad: function(e) {
            console.log('About to load ' + e.data('src'));
        },
        afterLoad: function(e) {
            console.log('Loaded ' + e.data('src'));
        },
        onFinishedAll: function() {
            console.log('All Loaded ');
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
