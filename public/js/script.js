var abc = 0; // Declaring and defining global increment variable.
$("#upload").hide();
$(document).ready(function() {
    //  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
    $("#add_more").click(function() {
        $(this).before(
            $("<div/>", {
                id: "filediv"
            })
            
            .append(
                $("<input/>", {
                    name: "image",
                    type: "file",
                    class: "btnSecond",
                    id: "file"
                }),
                $("<br/><br/>")
            )
        );
        $(this).hide();
    });
    // Following function will executes on change event of file input to select different file.
    $("body").on("change", "#file", function() {
        if (this.files && this.files[0]) {
            abc += 1; // Incrementing global variable by 1.
            var z = abc - 1;
            var x = $(this)
                .parent()
                .find("#previewimg" + z)
                .remove();
            $(this).before(
                "<div id='abcd" +
                abc +
                "' class='abcd'><img style='height:25%; width:25%' id='previewimg" +
                abc +
                "' src=''/></div>"
            );
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
            $(this).hide();
            $("#abcd" + abc).append(
                $("<img>", {
                    id: "img",
                    alt: "X"
                }).click(function() {
                    $(this)
                        .parent()
                        .parent()
                        .remove();
                    $("#upload").hide();
                    $("#add_more").show();
                })
            );
        }
    });
    // To Preview Image
    function imageIsLoaded(e) {
        $("#previewimg" + abc).attr("src", e.target.result);
        $("#upload").show();
    }
    $("#upload").click(function(e) {
        var name = $(":file").val();
        $("#abcd" + abc).hide();
        $("#add_more").show();
        $("#upload").hide();

        if (!name) {
            alert("First Image Must Be Selected");
            e.preventDefault();
        } else {
            location.reload();
        }
    });
});
//Following code will implement the image slide 
$(".slider").each(function() {
    var $this = $(this);
    var $group = $this.find(".slide_group");
    var $slides = $this.find(".slide");
    var bulletArray = [];
    var currentIndex = 0;
    var timeout;

    function move(newIndex) {
        var animateLeft, slideLeft;

        advance();

        if ($group.is(":animated") || currentIndex === newIndex) {
            return;
        }

        bulletArray[currentIndex].removeClass("active");
        bulletArray[newIndex].addClass("active");

        if (newIndex > currentIndex) {
            slideLeft = "100%";
            animateLeft = "-100%";
        } else {
            slideLeft = "-100%";
            animateLeft = "100%";
        }

        $slides.eq(newIndex).css({
            display: "block",
            left: slideLeft
        });
        $group.animate({
                left: animateLeft
            },
            function() {
                $slides.eq(currentIndex).css({
                    display: "none"
                });
                $slides.eq(newIndex).css({
                    left: 0
                });
                $group.css({
                    left: 0
                });
                currentIndex = newIndex;
            }
        );
    }

    function advance() {
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            if (currentIndex < $slides.length - 1) {
                move(currentIndex + 1);
            } else {
                move(0);
            }
        }, 4000);
    }

    $(".next_btn").on("click", function() {
        if (currentIndex < $slides.length - 1) {
            move(currentIndex + 1);
        } else {
            move(0);
        }
    });

    $(".previous_btn").on("click", function() {
        if (currentIndex !== 0) {
            move(currentIndex - 1);
        } else {
            move(3);
        }
    });

    $.each($slides, function(index) {
        var $button = $('<a class="slide_btn">&bull;</a>');

        if (index === currentIndex) {
            $button.addClass("active");
        }
        $button
            .on("click", function() {
                move(index);
            })
            .appendTo(".slide_buttons");
        bulletArray.push($button);
    });

    advance();
});