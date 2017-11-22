$("a.title").click(function () {
    var panel = $(this).closest(".timeline-panel");
    var icon = panel.prev(".timeline-badge").children("i");
    if (panel.hasClass("bg-info")) {
        panel.removeClass("bg-info");
        icon.removeClass("blink");
        $.ajax ({
            url: "/student/set_post_seen",
            type: "POST",
            dataType: "json",
            data: {
                "post_id": panel.attr("id")
            },
            async: true,
            error: function (xhr, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                console.log(xhr.responseText);
            }
        });
    }
});