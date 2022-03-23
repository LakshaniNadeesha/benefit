<!DOCTYPE html>
<html>
<head>
    <title>Jquery Fullcalandar Integration with PHP and Mysql</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="<?= CSS_PATH ?>supervisorcalendar.css">
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script>
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                editable:true,
                header:{
                    left:'prev,next today',
                    center:'title',
                    right:'month,agendaWeek,agendaDay'
                },
                events: <?= Auth::calendar() ?>,
                selectable:true,
                selectHelper:true,
                select: function(start, end, allDay)
                {
                    var title = prompt("Enter Event Title");
                    if(title)
                    {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url:"http://localhost/benefit/Calendar",
                            type:"POST",
                            data:{title:title, start:start, end:end},
                            success:function()
                            {
                                calendar.fullCalendar('refetchEvents');
                                alert("Added Successfully");
                            }
                        })
                    }
                },
                editable:true,

                // eventDrop:function(event)
                // {
                //     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                //     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                //     var title = event.title;
                //     var id = event.id;
                //     $.ajax({
                //         url:"update.php",
                //         type:"POST",
                //         data:{title:title, start:start, end:end, id:id},
                //         success:function()
                //         {
                //             calendar.fullCalendar('refetchEvents');
                //             alert("Event Updated");
                //         }
                //     });
                // },
                //
                // eventClick:function(event)
                // {
                //     if(confirm("Are you sure you want to remove it?"))
                //     {
                //         var id = event.id;
                //         $.ajax({
                //             url:"delete.php",
                //             type:"POST",
                //             data:{id:id},
                //             success:function()
                //             {
                //                 calendar.fullCalendar('refetchEvents');
                //                 alert("Event Removed");
                //             }
                //         })
                //     }
                // },

            });
        });

    </script>
</head>
<style>
    .fc th, .fc td {
        height: 30px;
    }

    button.fc-month-button.fc-button.fc-state-default.fc-corner-left {
        display: none;
    }

    button.fc-agendaDay-button.fc-button.fc-state-default.fc-corner-right {
        display: none;
    }

    button.fc-agendaWeek-button.fc-button.fc-state-default {
        display: none;
    }


    .fc-toolbar.fc-header-toolbar {
        margin-bottom: 0;
        display: flex;
        flex-direction: column-reverse;
        margin: auto;
        text-align: center;
    }

    .fc-toolbar .fc-center {
        display: inline-block;
        margin: auto;
    }

    fc-toolbar .fc-left {
        float: left;
        display: flex;
        flex-direction: row-reverse;
    }
    /*.fc .fc-button-group > :first-child {*/
    /*    margin-left: 0;*/
    /*    display: none;*/
    /*}*/

    /*.fc .fc-button-group > * {*/
    /*    float: left;*/
    /*    margin: 0 0 0 -1px;*/
    /*    display: none;*/
    /*}*/

    .fc-toolbar.fc-header-toolbar {
         margin-bottom: 0;
    }

</style>
<body>
<br />
<br />
<div class="container">
    <div id="calendar"></div>
</div>
</body>
</html>