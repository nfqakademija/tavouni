$(function () {
    $('#calendar-holder').fullCalendar({
        header: {
            left: 'prev, next, myCustomButton',
            center: 'title',
            right: 'month, agendaWeek, agendaDay,'
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
        weekends: false,
        lazyFetching: true,
        defaultView: 'agendaWeek',
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