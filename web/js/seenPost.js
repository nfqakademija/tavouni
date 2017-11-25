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
            url: "/student/set_post_seen/" + panel.attr("id"),
            type: "POST",
            dataType: "json",
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
    var count = $('span#count').text();
    if (count !== null) {
        document.title = '(' + count + ') ' + 'TavoUni';
    } else {
      document.title = 'TavoUni';
    }
}
function decrementCount() {
    var count = $('span#count').text();
    $('span#count').text(count - 1);
}