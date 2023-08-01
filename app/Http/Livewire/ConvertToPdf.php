<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class ConvertToPdf extends Component
{

    public function ConvertToPdf(Request $request){

        dd($request);

    }


    public function render()
    {
        return view('livewire.convert-to-pdf');
    }
}
