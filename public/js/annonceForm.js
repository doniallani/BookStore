$("form.my_form").on("submit", function() { //this is the ajax file processing the forms
    var that = $(this),
        url = that.attr("action"),
        type = that.attr("method"),
        data = {};

    that.find("[name]").each(function(index, value) {
        if (!$(this).is(':checkbox') || $(this).is(':checked')) {
            var that = $(this),
                name = that.attr("name"),
                value = that.val();

            data[name] = value;
        } else {
            var that = $(this),
                name = that.attr("name"),
                value = 0;

            data[name] = value;
        }

    });


    $.ajax({
        url: url,
        type: type,
        data: data,
        success: function(response) {
            console.log(response);
            document.location.reload();
        }
    });

    return false;
});
