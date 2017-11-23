$("a[class *= 'title'], a[class *= 'timeline-badge']").click(function () {
    var panel;
    var badge;
    var icon;
    if ($(this).hasClass('timeline-badge')) {
        badge = $(this);
        panel = badge.next(".timeline-panel")
    }
    else {
        panel = $(this).closest(".timeline-panel");
        badge = panel.prev(".timeline-badge");
    }
    icon = badge.children("i");
    if (panel.hasClass("bg-info")) {
        panel.removeClass("bg-info");
        badge.removeClass("info");
        icon.removeClass("blink");
        decrementCount();
        changeTitle();
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

$(function () {
    changeTitle();
});

function changeTitle() {
    var count = $('div.counter').data('unseen-count');
    console.log(count);
    if (count !== 0) {
        console.log(count);
        document.title = '(' + count + ') ' + 'TavoUni';
    }
}
function decrementCount() {
    var count = $('div.counter').data('unseen-count');
    $('div.counter').data('unseen-count', count - 1);
}