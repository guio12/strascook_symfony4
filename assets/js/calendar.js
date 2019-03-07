$(function () {
    $('#calendar-holder').fullCalendar({
        locale: 'fr',
        aspectRatio: 2.5,
        defaultView: 'agendaWeek',
        nowIndicator: true,
        minTime: "18:00:00",
        header: {
            left: 'prev, next, today',
            center: 'title',
            right: 'month, agendaWeek, agendaDay'
        },
        lazyFetching: true,
        navLinks: true,
        eventSources: [
            {
                url: "/fc-load-events",
                type: 'POST',
                data:  {
                    filters: {}
                },
                error: function () {
                    alert('There was an error while fetching FullCalendar!');
                }
            }
        ]
    });
});