<?php

namespace App\Livewire;

use Livewire\Component;

class Carousel extends Component
{
    private int $max_img = 3;
    public int $img_index = 1;

    public function nextImg() {
        if($this->img_index < $this->max_img) {
            $this->img_index++;
        }
        else{
            $this->img_index = 1;
        }
    }

    public function previousImg() {
        if($this->img_index > 1)
            $this->img_index--;
        else 
            $this->img_index = $this->max_img;
    }

    public function render()
    {
        return view('livewire.carousel');
    }
}
