/* console shim*/
(function () {
    var f = function () {};
    if (!window.console) {
        window.console = {
            log:f, info:f, warn:f, debug:f, error:f
        };
    }
}());

$(document).ajaxStart(function(){
    console.log("ajaxStart");
    $.blockUI({ message: '<h2>Loading</h2>', css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff',
        } });
}).ajaxStop(function(){
    console.log("ajaxStop");
    $.unblockUI();
});
