$(function () {
    $('#calendar-holder').fullCalendar({
        header: {
            left: 'prev, next',
            center: 'title',
            right: 'today'
        },
        customButtons: {
            myCustomButton: {
                text: 'Eksportuoti į .ics failą',
                click: function() {
                    window.location.replace("./calendar/download");
                }
            }
        },
        locale: 'lt',
        height: 'auto',
        minTime: "08:00:00",
        maxTime: "20:00:00",
        nowIndicator: true,
        weekends: false,
        lazyFetching: true,
        defaultView: 'agendaDay',
        selectable: true,
        allDaySlot: false,
        displayEventEnd: {
            month: false,
            basicWeek: true,
        },
        eventSources: [
            {
                url: '/full-calendar/load',
                type: 'POST',
                data: {},
                error: function () {}
            }
        ]
    });
});