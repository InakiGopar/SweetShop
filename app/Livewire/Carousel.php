<?php

namespace App\Livewire;

use Livewire\Component;

class Carousel extends Component
{
    public int $img_index = 1;

    public function nextImg() {
        if($this->img_index < 3) {
            $this->img_index++;
        }
        else{
            $this->img_index = 1;
        }
    }

    public function previousImg() {
        if($this->img_index > 1)
            $this->img_index--;
    }

    public function render()
    {
        return view('livewire.carousel');
    }
}
