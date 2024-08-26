<?php

namespace App\Livewire;

use Livewire\Component;

class Message extends Component
{
    public $message;

    public function mount()
    {
        $this->message = session('message', null);
    }

    public function clearMessage() 
    {
        $this->message = null;
    }

    public function render()
    {
        return view('livewire.message');
    }
}
