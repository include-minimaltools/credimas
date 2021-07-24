<?php require_once "views/Shared/Layout.php"; ?>



<div class="animated fadeIn"> 
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Calendario de pagos</h4>
                    <div class="calender-cont widget-calender">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>

<script>

!function($) {
    "use strict";

    var CalendarApp = function() {
        this.$body = $("body")
        this.$modal = $('#event-modal'),
        this.$event = ('#external-events div.external-event'),
        this.$calendar = $('#calendar'),
        // this.$saveCategoryBtn = $('.save-category'),
        this.$categoryForm = $('#add-category form'),
        this.$extEvents = $('#external-events'),
        this.$calendarObj = null
    };

    //#region methods
    /* on click on event */
    CalendarApp.prototype.onEventClick =  function (calEvent, jsEvent, view) 
    {
        if(calEvent.id == 0)
            return;

        if(calEvent.status == "pending" || calEvent.status == "late")
            window.location = '<?php echo constant('URL'); ?>/payfee/render/' + calEvent.id;
    },

    CalendarApp.prototype.enableDrag = function() {
        //init events
        $(this.$event).each(function () {
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
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
        });
    }
    //#endregion
    

    /* Initializing */
    CalendarApp.prototype.init = function() {
        // this.enableDrag();
        /*  Initialize the calendar  */
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var form = '';
        var today = new Date($.now());

        var defaultEvents =  [<?php echo $this->data['defaultEvents']; ?>{
                id: 0,
                title: 'Hoy',
                start: today,
                end: today,
                className: 'bg-primary'
            }];
        
        var $this = this;

        console.log(defaultEvents);
        $this.$calendarObj = $this.$calendar.fullCalendar({
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
            slotDuration: '00:15:00', /* If we want to split day time each 15minutes */
            minTime: '08:00:00',
            maxTime: '19:00:00',  
            defaultView: 'month',  
            handleWindowResize: true,   
            height: $(window).height() - 200,   
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: defaultEvents,
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar !!!
            eventLimit: false, // allow "more" link when too many events
            selectable: false,
            eventClick: function(calEvent, jsEvent, view) { $this.onEventClick(calEvent, jsEvent, view); }

        });
    },

   //init CalendarApp
    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp
    
}(window.jQuery),

//initializing CalendarApp
function($) {
    "use strict";
    $.CalendarApp.init()
}(window.jQuery);

</script>

<?php require_once 'views/Shared/Footer.php'?>