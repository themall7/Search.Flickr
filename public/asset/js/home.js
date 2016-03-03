$(document).ready(function(){
    
    // Keyword
    $("#keyword").select2({
        tags:true,
        minimumInputLength: 3,
    });
    
    // Search
    $("#btn_search").click(function(e){
        e.preventDefault();
        // first page
        if (e.originalEvent !== undefined)
            $("#page").val("1");
        
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

$(window).scroll(function(){
    if ($(window).scrollTop() == $(document).height() - $(window).height()) {
        $("#page").val( $("#page").val() * 1 + 1 );
        $("#btn_search").trigger('click');
    }
});

var home = home || {};

home.search = {
    init : function() {
        $(app.form.msgbox).hide();
        $(app.form.class4val).remove();
        $(app.form.tag4val).removeClass('has-error');
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
                var frmFld = $('[name="' + k + '"]').closest("span");
                errMsg = response.validation[k].replace(/(<([^>]+)>)/ig, "");
                if (!frmFld.hasClass('has-error')) frmFld.addClass('has-error');
                frmFld.append('<label class="control-label" for="">' + errMsg + '</label>');
            });
            if (first_item=="keyword[]") $('#keyword').select2('open');
            else $('[name="' + first_item + '"]').focus();
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
        if ($("#page").val()=="1")
            $("#image_list").html(data);
        else
            $("#image_list").append(data);
        
        // init Masonry
        var $grid = $('.grid').masonry({
            itemSelector: '.grid-item',
            percentPosition: true,
            columnWidth: '.grid-sizer'
        });
        // layout Isotope after each image loads
        $grid.imagesLoaded().progress( function() {
            $grid.masonry();
        });
        
        // Colorbox
        $('a.gallery').colorbox({rel:'group1'});
    },
}