function getCritere() { //this file will alow me to get the different subjects for genre in real time without refreshing the page
    var v = $("#selectTypeCritere").val();
    var that = $(this),
        url = `/book/genre/${v}`,
        type = that.attr("method"),
        data = {};

    $.ajax({
        url: url,
        type: type,
        data: data,
        success: function(response) {
            var i;
            var tab = response.data[1];
            $("#critere").empty();
            for (i =0; i< tab.length; i++) 
            console.log(tab[i]);
            $("#critere")
                    .append(`<label> Book Subject </label> <select id="genre" name="subject" class="form-control" required>  <option value="0">
                    ------
                </option> </select`);
                                                for (i =0; i< tab.length; i++) {
                                                $(`#genre`).append(
                                                    `  <option value="${tab[i]}"> ${tab[i]} </option> `
                                                );
                                                }
          

          

         
            

            
        }
    });
}
