<?php

namespace App\View\Components;

use Illuminate\View\Component;

class layout extends Component
{
   /**
    * @return void
    */
   public function __construct()
   {
      //
   }

   /**
    * @return \Illuminate\Contracts\View\View|\Closure|string
    */
   public function render()
   {
      return view('components.layout');
   }
}
