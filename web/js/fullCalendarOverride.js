$(function () {
    $('#calendar-holder').fullCalendar({
        header: {
            left: 'prev, next',
            center: 'title',
            right: 'month, agendaWeek, agendaDay,'
        },
        locale: 'lt',
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