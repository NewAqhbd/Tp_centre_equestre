<?php
$pagename = 'Cours d\'équitation';
require $headerpath;
?>

<head>
    <link rel="stylesheet" href="http://localhost/tp_centre_equestre/css/fullcalendar.min.css">
    <!-- <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/locale/fr.js"></script>
</head>

<script>

    // Full Calendar
    $(document).ready(function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        var calendar = $('#calendar').fullCalendar({
            eventTextColor: 'white',
            displayEventTime: true,
            editable: true,
            header: {
                left: 'prev,next, today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {
                today: 'Ajourd\'hui',
                month: 'Mois',
                week: 'Semaine',
                day: 'Jour'
            },
            locale: 'fr',

            events: {
                url: "http://localhost/tp_centre_equestre/vue/cours/loadCours.php",
                method: "POST",
                dataType: "json"
            },

            eventRender: function(event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
                console.log(event.allDay);
            },
            selectable: false,
            selectHelper: false,
            editable: false,

        });
    });
</script>


<div id="calendar" class=""></div>