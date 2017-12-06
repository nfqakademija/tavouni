$("a[class *= 'title'], a[class *= 'vtimeline-badge']").click(function () {
    var panel;
    var badge;
    var icon;
    if ($(this).hasClass('vtimeline-badge')) {
        badge = $(this);
        panel = badge.next(".vtimeline-panel")
    }
    else {
        panel = $(this).closest(".vtimeline-panel");
        badge = panel.prev(".vtimeline-badge");
    }
    icon = badge.children("i");
    if (panel.hasClass("post-content-unseen")) {
        panel.removeClass("post-content-unseen");
        badge.removeClass("info");
        icon.removeClass("blink");
        decrementCount();
        changeTitle();
        $.ajax ({
            url: "/student/set-post-seen/" + panel.attr("id"),
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