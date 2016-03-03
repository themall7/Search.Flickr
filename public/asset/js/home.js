$(document).ready(function(){
    
    // Search
    $("#btn_search").click(function(e){
        e.preventDefault();
        
        var form_data = new FormData($("#frm_search")[0]);
        
        home.search.init();

        $.ajax({
            type: "POST",
            url: "/search",
            data: form_data,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: home.search.success,
            error: home.search.error,
        });
    });
});

var home = home || {};

home.search = {
    init : function() {
        $(app.form.msgbox).hide();
        $(app.form.class4val).remove();
        $(app.form.tag4val).removeClass('error');
    },
    success : function(response) {
        if (response.error === true) {

            $(app.form.msgbox).text(response.message).show();

            var first_item;
            var idx = 0;
            $.each(response.validation, function(k, v){
                if (idx==0) {
                    first_item = k;
                    idx++;
                }
                var frmFld = jQuery('[name=' + k + ']').closest("span");
                errMsg = response.validation[k].replace(/(<([^>]+)>)/ig, "");
                if (!frmFld.hasClass('error')) frmFld.addClass('error');
                frmFld.append('<span class="validation-advice">' + errMsg + '</span>');
            });
            jQuery('[name^=' + first_item + ']').focus();
        } else {
            $(app.form.msgbox).text("Saved").show();
            setTimeout(function() {
                home.search.display_image(response.data);
                $(app.form.msgbox).hide();
            }, app.config.timeout.submit);
        }
    },
    error : function(response) {
        console.log(data);
    },
    display_image : function(data) {
        $("#image_list").html(data);
    },
}