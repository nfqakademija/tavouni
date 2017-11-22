$("a.title").click(function () {
    var panel = $(this).closest(".timeline-panel");
    if (panel.hasClass("bg-info")) {
        panel.removeClass("bg-info");
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