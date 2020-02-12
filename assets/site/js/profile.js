$(document).ready(function() {
    $('.programs').slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1
    });
});

$("#btnsubmit").click(function(event) {
    var form = $("#editprofile")

    if (form[0].checkValidity() === false) {
        event.preventDefault()
        event.stopPropagation()
    }
    form.addClass('was-validated');
});

$(document).ready(function() {
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    /*  className colors
      
    className: default(transparent), important(red), chill(pink), success(green), info(blue)
      
    */
    /* initialize the external events
    -----------------------------------------------------------------*/
    $('#external-events div.external-event').each(function() {
        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
        };
        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);
        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true, // will cause the event to go back to its
            revertDuration: 0 //  original position after the drag
        });
    });
    /* initialize the calendar
    -----------------------------------------------------------------*/
    var calendar = $('#calendar').fullCalendar({
        header: {
            left: 'title',
            center: 'agendaDay,agendaWeek,month',
            right: 'prev,next today'
        },
        editable: false,
        firstDay: 0, //  1(Monday) this can be changed to 0(Sunday) for the USA system
        selectable: false,
        defaultView: 'month',
        axisFormat: 'h:mm',
        columnFormat: {
            month: 'ddd', // Mon
            week: 'ddd d', // Mon 7
            day: 'dddd M/d', // Monday 9/7
            agendaDay: 'dddd d'
        },
        titleFormat: {
            month: 'MMMM yyyy', // September 2009
            week: "MMMM yyyy", // September 2009
            day: 'MMMM yyyy' // Tuesday, Sep 8, 2009
        },
        allDaySlot: false,
        selectHelper: false,
        select: false,
        // select: function(start, end, allDay) {
        //     var title = prompt('Event Title:');
        //     if (title) {
        //         calendar.fullCalendar('renderEvent', {
        //                 title: title,
        //                 start: start,
        //                 end: end,
        //                 allDay: allDay
        //             },
        //             true // make the event "stick"
        //         );
        //     }
        //     calendar.fullCalendar('unselect');
        // },
        droppable: false, // this allows things to be dropped onto the calendar !!!
        drop: function(date, allDay) { // this function is called when something is dropped
            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');
            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);
            // assign it the date that was reported
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;
            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove();
            }
        },
    });
});

$(document).ready(function() {
    $('#calendar').fullCalendar('addEventSource', events); 
    $(".activity-date").click(function () {
        $('.au-event-entry').removeClass('date-selected');
        var addressValue = $(this).attr("href");
        $(addressValue).addClass('date-selected');
    });

    
});


function progressBar($id, $percentage) {
    $($id).css("width", $percentage + '%');

    if ($percentage <= 9) {
        $('.au-pointslevel .au-ptscol:nth-child(1)').addClass('reached');
    } else if ($percentage <= 19) {
        $('.au-pointslevel .au-ptscol:nth-child(1)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(2)').addClass('reached');
    } else if ($percentage <= 29) {
        $('.au-pointslevel .au-ptscol:nth-child(1)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(2)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(3)').addClass('reached');
    } else if ($percentage <= 39) {
        $('.au-pointslevel .au-ptscol:nth-child(1)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(2)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(3)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(4)').addClass('reached');
    } else if ($percentage <= 49) {
        $('.au-pointslevel .au-ptscol:nth-child(1)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(2)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(3)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(4)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(5)').addClass('reached');
    } else if ($percentage <= 59) {
        $('.au-pointslevel .au-ptscol:nth-child(1)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(2)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(3)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(4)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(5)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(6)').addClass('reached');
    } else if ($percentage <= 69) {
        $('.au-pointslevel .au-ptscol:nth-child(1)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(2)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(3)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(4)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(5)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(6)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(7)').addClass('reached');
    } else if ($percentage <= 79) {
        $('.au-pointslevel .au-ptscol:nth-child(1)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(2)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(3)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(4)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(5)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(6)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(7)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(8)').addClass('reached');
    } else if ($percentage <= 89) {
        $('.au-pointslevel .au-ptscol:nth-child(1)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(2)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(3)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(4)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(5)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(6)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(7)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(8)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(9)').addClass('reached');
    } else if ($percentage <= 99) {
        $('.au-pointslevel .au-ptscol:nth-child(1)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(2)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(3)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(4)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(5)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(6)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(7)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(8)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(9)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(10)').addClass('reached');
    } else if ($percentage == 100) {
        $('.au-pointslevel .au-ptscol:nth-child(1)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(2)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(3)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(4)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(5)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(6)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(7)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(8)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(9)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(10)').addClass('reached');
        $('.au-pointslevel .au-ptscol:nth-child(11)').addClass('reached');
    }
}