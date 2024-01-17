<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;

class StudnetClaendar extends Component
{
    public $events = '';

    public function getevent()
    {
        $events = Event::select('id','title','start')->get();

        return  json_encode($events);
    }


    public function render()
    {
        $this->dispatchBrowserEvent('livewire:load');
        $events = Event::select('id','title','start')->get();

        $this->events = json_encode($events);

        return view('livewire.studnet-claendar');
    }
}
