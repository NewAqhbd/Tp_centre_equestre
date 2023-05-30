<?php
if (isset($_SESSION['connecte']) && $_SESSION['connecte'] === true && $_SESSION['type'] === 'a'){

} else {
    header('Location: http://localhost/tp_centre_equestre/');
}
$pagename = 'Gestion des cours';
require $headerpath;
// require "../header.php";
// $pagename = 'Gestion des Cours';
// require $headerpath;

?>
<head>
  <link rel="stylesheet" href="http://localhost/tp_centre_equestre/css/fullcalendar.min.css">
  <!-- <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>  
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>  
</head>
<script>  
  var eventId;
  var eventIdWeek;

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
          left:   'prev,next, today',  
          center: 'title',  
          right:  'month,agendaWeek,agendaDay'  
      },
    
      events: {
        url: "http://localhost/tp_centre_equestre/vue/cours/loadCours.php",
        method: "POST",
        dataType: "json"
      },
    
      eventRender: function(event, element, view) { 
        console.log('renderEvent triggered !'); 
        if (event.allDay === 'true') {  
        event.allDay = true;  
        } else {  
        event.allDay = false;  
        }  
        console.log(event.allDay);
      },  
      selectable: true,  
      selectHelper: true,  
      select: function(start, end, allDay) {  
          var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");  
          var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");  
          $( "#start_event_add " ).val(start)
          $( "#end_event_add " ).val(end)
          $( "#dialog-form" ).dialog( "open" );
      },
    
      editable: true,  
      eventDrop: function(event, delta) {  
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");  
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss"); 
            console.log(delta["_data"]);
            $.ajax({  
                url: 'http://localhost/tp_centre_equestre/controller/CoursController.php',  
                data: 'title='+ event.title+
                      '&start='+ start +
                      '&end='+ end +
                      '&id='+ event.id+
                      '&delta_days='+delta["_data"]["days"]+
                      '&delta_hours='+delta["_data"]["hours"]+
                      '&delta_minutes='+delta["_data"]["minutes"]+
                      '&action=updateAll'  ,  
                type: "POST",
                success: function(json) {
                    alert("Updated Successfully"); 
                    console.log(json) 
                }  
            });  
      },  

      eventClick: function(event) {
        eventId = event.id;
        eventIdWeek = event.idWeek;
        $("#update-form").dialog("open");
      },

      // eventClick: function(event) {  
      //   var decision = confirm("Voulez-vous vraiment supprimer ?");   
      //       if (decision) {  
      //           $.ajax({  
      //               type:"POST",
      //               url: "http://localhost/tp_centre_equestre/controller/CoursController.php",  
      //               data: "&id=" + event.id +'&action=delete',  
      //               success: function(json) {  
      //                   calendar.fullCalendar('removeEvents', event.id);  
      //                   alert("Updated Successfully");
      //                   console.log(json)
      //               }  
      //           });  
      //       }  
      //   },
      eventResize: function(event, startDelta, endDelta) {
          var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");  
          var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
          console.log(startDelta["_data"]);
          $.ajax({
            url:  'http://localhost/tp_centre_equestre/controller/CoursController.php',
            data: 'title='+ event.title+
                  '&start='+ start +
                  '&end='+ end +
                  '&id='+ event.id +
                  '&start_delta_h='+startDelta["_data"]["hours"]+
                  '&start_delta_m='+startDelta["_data"]["minutes"] +
                  '&action=resize',
            type: "POST",
            success: function(json) {
                alert("Updated Successfully");  
                console.log(json) 
            }
          });
      }    
    });  


    
    //Functions
    var dialog, form,
              title = $( "#title" ),
              titleUpdate = $( "#titleUpdate "),
              date_end = $( "#date_end" ),
              start_event_add = $("#start_event_add"),
              end_event_add = $("#end_event_add"),
              start_event_update = $("#start_event_update"),
              end_event_update = $("#end_event_update"),
              allFields = $( [] ).add( title ).add( date_end ).add( start_event_add ).add( end_event_add ),
              tips = $( ".validateTips" );
  
      function updateTips( t ) {
        tips
          .text( t )
          .addClass( "ui-state-highlight" );
        setTimeout(function() {
          tips.removeClass( "ui-state-highlight", 1500 );
        }, 500 );
      }
  
  
      function addEvent() {
        var valid = true;
        allFields.removeClass( "ui-state-error" );
  
        if ( valid ) {
              $.ajax({
                  url: 'http://localhost/tp_centre_equestre/controller/CoursController.php', 
                  data: 'title='+ title.val()+'&start_event='+ start_event_add.val() +'&end_event='+ end_event_add.val()+'&action=add'+'&date_end='+date_end.val(),  
                  type: "POST",
                  success: function(json) { 
                          console.log(json) 
                          alert('Added Successfully'); 
                          dialog.dialog( "close" ); 
                          calendar.fullCalendar('refetchEvents');
                  }  
              });  
        }
        calendar.fullCalendar('unselect');
        return valid;
      }

      function deleteEventAll() {
        $.ajax({  
                    type:"POST",
                    url: "http://localhost/tp_centre_equestre/controller/CoursController.php",  
                    data: "&id=" + eventId +'&action=deleteAll',  
                    success: function(json) {  
                        calendar.fullCalendar('removeEvents', eventId);  
                        alert("Updated Successfully");
                        dialogUpdate.dialog( "close" ); 
                        console.log(json)
                        calendar.fullCalendar('refetchEvents');
                    }  
                });  
      }

      function deleteEvent() {
        $.ajax({  
                    type:"POST",
                    url: "http://localhost/tp_centre_equestre/controller/CoursController.php",  
                    data: "&id=" + eventId + '&idWeekCours=' + eventIdWeek + '&action=delete',  
                    success: function(json) {  
                        calendar.fullCalendar('removeEvents', eventId);  
                        alert("Updated Successfully");
                        dialogUpdate.dialog( "close" ); 
                        console.log(json)
                        calendar.fullCalendar('refetchEvents');
                    }  
                });  
      }

      function renameEvent() {
        $.ajax({
                  url: 'http://localhost/tp_centre_equestre/controller/CoursController.php', 
                  data: 'titleUpdate='+ titleUpdate.val()+'&idCours='+ eventId +'&action=rename',  
                  type: "POST",
                  success: function(json) { 
                          console.log(json) 
                          alert('Updated Successfully'); 
                          dialogUpdate.dialog( "close" ); 
                          calendar.fullCalendar('refetchEvents');
                  }  
              });  
      }

      function updateEvent() {
        console.log("EventId : " + eventId);
        console.log("EventIdWeek : " + eventIdWeek);
        console.log("Event_start : " + start_event_update.val());
        console.log("Event_end : " + end_event_update.val());


        $.ajax({
          url: 'http://localhost/tp_centre_equestre/controller/CoursController.php',
          data: '&startEvent=' + start_event_update.val() + '&endEvent=' + end_event_update.val() + '&idCours=' + eventId + '&idWeekCours=' + eventIdWeek + '&action=update',
          type: 'POST',
          success: function(json) {
            alert('Horaires modifiés avec succès !');
            dialogUpdate.dialog( "close" );
            calendar.fullCalendar( "refetchEvents" );
          }
        })
      }

      //Dialog creation event
      dialog = $( "#dialog-form" ).dialog({
        autoOpen: false,
        height: 400,
        width: 350,
        modal: true,
        buttons: {
          "Créer un cours": addEvent,
          Annuler: function() {
            dialog.dialog( "close" );
          }
        },
        close: function() {
          form[ 0 ].reset();
          allFields.removeClass( "ui-state-error" );
        }
      });
  
      form = dialog.find( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        addEvent();
      });

      //Dialog modification event
      dialogUpdate = $( "#update-form" ).dialog({
        autoOpen: false,
        height: 250,
        width: 350,
        modal: true,
        buttons: {
          "Modifier" : updateEvent,
          "Renommer" : renameEvent,
          "Supprimer" : deleteEvent,
          "Supprimer TOUS" : deleteEventAll,
          Annuler: function() {
            dialogUpdate.dialog( "close" );
          }
        },
        close: function() {
          form[ 0 ].reset();
          allFields.removeClass( "ui-state-error" );
        }
      });
  
      formUpdate = dialogUpdate.find( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        renameEvent();
      });
  });  

  // function updateStartDateTimeValue() {
  //   console.log("Update start_event triggered !!!");
  //   // Get the value of the datetime-local input
  //   var dateTimeInput = document.getElementById('start_event_update');
  //   var combinedDateTime = dateTimeInput.value;

  //   // Set the value of any other hidden input field if needed
  //   var hiddenInput = document.getElementById('start_event_update_value');
  //   hiddenInput.value = combinedDateTime;
  //   console.log(combinedDateTime);
  // }

  // function updateEndDateTimeValue() {
  //   console.log("Update end_event triggered !!!");
  //   // Get the value of the datetime-local input
  //   var dateTimeInput = document.getElementById('end_event_update');
  //   var combinedDateTime = dateTimeInput.value;

  //   // Set the value of any other hidden input field if needed
  //   var hiddenInput = document.getElementById('end_event_update_value');
  //   hiddenInput.value = combinedDateTime;
  //   console.log(combinedDateTime);
  // }

</script>  
<style> 
body {  
    margin-top: 40px;  
    font-size: 14px;
    width : 80vw;

    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;  
  }   
</style>  

<div id="dialog-form" title="Ajouter un cours">
  <p class="validateTips">Tous les champs sont requis</p>

  <form>
    <fieldset>
      <label for="title">Titre</label>
      <input type="text" name="title" id="title" value="" class="text ui-widget-content ui-corner-all"></br>
      <label for="date_end">Fin de l'occurence</label>
      <input type="datetime-local" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}" name="date_end" id="date_end" value="" class="text ui-widget-content ui-corner-all">

      <label for="start_event">Début du cours</label>
      <input type="datetime-local" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}" name="start_event" id="start_event_add" value="" class="text ui-widget-content ui-corner-all">
      
      <label for="end_event">Fin du cours</label>
      <input type="datetime-local" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}" name="end_event" id="end_event_add" value="" class="text ui-widget-content ui-corner-all">
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>


<div id="update-form" title="Modifier un cours">

  <form>
    <fieldset>
      <label for="titleUpdate">Titre</label>
      <input type="text" name="titleUpdate" id="titleUpdate" value="" class="text ui-widget-content ui-corner-all" required></br>
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">

      <label for="start_event">Début du cours</label>
      <input type="datetime-local" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}" name="start_event" id="start_event_update" value="" class="text ui-widget-content ui-corner-all">
      <input type="hidden" id="start_event_update_value" value="">

      <label for="end_event">Fin du cours</label>
      <input type="datetime-local" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}" name="end_event" id="end_event_update" value="" class="text ui-widget-content ui-corner-all">
      <input type="hidden" id="end_event_update_value" value="">

      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">

    </fieldset>
  </form>
</div>


<!--<button id="create-user">Create new user</button>-->


<div id="calendar" class="" ></div>
