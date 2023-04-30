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

  // Full Calendar
  $(document).ready(function() {  
    var date = new Date();  
    var d = date.getDate();  
    var m = date.getMonth();  
    var y = date.getFullYear();  
    
    var calendar = $('#calendar').fullCalendar({  
      eventTextColor: 'white',
      displayEventTime: false,
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
          $( "#start_event " ).val(start)
          $( "#end_event " ).val(end)
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
                      '&action=update'  ,  
                type: "POST",
                success: function(json) {
                    alert("Updated Successfully"); 
                    console.log(json) 
                }  
            });  
      },  

      eventClick: function(event) {
        eventId = event.id;
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
              start_event = $("#start_event"),
              end_event = $("#end_event"),
              allFields = $( [] ).add( title ).add( date_end ).add( start_event ).add( end_event ),
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
          alert(title.val())
          alert(date_end.val())
              $.ajax({
                  url: 'http://localhost/tp_centre_equestre/controller/CoursController.php', 
                  data: 'title='+ title.val()+'&start_event='+ start_event.val() +'&end_event='+ end_event.val()+'&action=add'+'&date_end='+date_end.val(),  
                  type: "POST",
                  success: function(json) { 
                          console.log(json) 
                          alert('Added Successfully'); 
                          dialog.dialog( "close" ); 
                          calendar.fullCalendar('renderEvent',  
                              {
                                  title: title,  
                                  start: start_event,  
                                  end: end_event,  
                                  allDay: allDay  
                              },  
                              true  
                              );
                  }  
              });  
        }
        calendar.fullCalendar('unselect');
        return valid;
      }

      function deleteEvent() {
        $.ajax({  
                    type:"POST",
                    url: "http://localhost/tp_centre_equestre/controller/CoursController.php",  
                    data: "&id=" + eventId +'&action=delete',  
                    success: function(json) {  
                        calendar.fullCalendar('removeEvents', eventId);  
                        alert("Updated Successfully");
                        dialogUpdate.dialog( "close" ); 
                        console.log(json)
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

      //Dialog creation event
      dialog = $( "#dialog-form" ).dialog({
        autoOpen: false,
        height: 400,
        width: 350,
        modal: true,
        buttons: {
          "Créer un Evenement": addEvent,
          Cancel: function() {
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
        height: 150,
        width: 350,
        modal: true,
        buttons: {
          "Renommer": renameEvent,
          "Supprimer" : deleteEvent,
          Cancel: function() {
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
      <label for="start_event">Début de l'event</label>
      <input type="datetime-local" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}" name="start_event" id="start_event" value="" class="text ui-widget-content ui-corner-all">
      <label for="end_event">Fin de l'event</label>
      <input type="datetime-local" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}" name="end_event" id="end_event" value="" class="text ui-widget-content ui-corner-all">
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
    </fieldset>
  </form>
</div>


<!--<button id="create-user">Create new user</button>-->


<div id="calendar" class="" ></div>
