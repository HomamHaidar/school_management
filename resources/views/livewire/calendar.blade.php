<div>
    <div id='calendar-container' wire:ignore>
        <div id='calendar'></div>
    </div>
</div>

@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>

    <script>
        document.addEventListener('livewire:load', function () {
            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;
            var calendarEl = document.getElementById('calendar');
            var checkbox = document.getElementById('drop-remove');
            var data = @this.events;
            var calendar = new Calendar(calendarEl, {
                events: JSON.parse(data),
                dateClick(info) {
                    var title = prompt("{{trans('main_trans.Enter_Event_Title')}}");
                    var date = new Date(info.dateStr + 'T00:00:00');
                    if (title != null && title != '') {
                        calendar.addEvent({
                            title: title,
                            start: date,
                            allDay: true
                        });
                        var eventAdd = {title: title, start: date};
                    @this.addevent(eventAdd);
                        alert("{{trans('main_trans.Event_added')}}");
                    } else {
                        alert("{{trans('main_trans.Event_Title_Is_Required')}}");
                    }
                },
                editable: true,
                selectable: true,
                displayEventTime: false,
                droppable: true, // this allows things to be dropped onto the calendar
                drop: function (info) {
                    // is the "remove after drop" checkbox checked?
                    if (checkbox.checked) {
                        // if so, remove the element from the "Draggable Events" list
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                },
                eventDrop: info => @this.eventDrop(info.event, info.oldEvent),
                eventClick: function (info) {
                    if (confirm("{{trans('main_trans.Event_Delete')}}")) {
                        var id = info.event.id;
                        var eventDelete = id;
                    @this.deleteevent(eventDelete);
                        alert("{{trans('main_trans.Event_Deleted')}}");
                    } else {
                        alert("{{trans('main_trans.Delete_Event_Cancel')}}");
                    }
                },


                loading: function (isLoading) {
                    if (!isLoading) {
                        // Reset custom events
                        this.getEvents().forEach(function (e) {
                            if (e.source === null) {
                                e.remove();
                            }
                        });
                    }
                }
            });
            calendar.render();
        @this.on(`refreshCalendar`, () => {
            calendar.refetchEvents()
        });
        });
    </script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet'/>
@endpush
