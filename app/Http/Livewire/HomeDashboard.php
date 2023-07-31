<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HomeDashboard extends Component
{
    public $isButtonVisible;

    public function showWTPForm(){
        $this->isButtonVisible=true;
    }

    // public function increment(){
    //     dd('true');
    // }
    

    public function render()
    {
        return view('livewire.home-dashboard');
    }
}
