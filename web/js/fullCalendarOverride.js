$(function () {
    $('#calendar-holder').fullCalendar({
        events: [
            {
                title:  'My Event',
                start:  '2017-11-01T14:30:00',
                allDay: false
            }
            // other events here...
        ],
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