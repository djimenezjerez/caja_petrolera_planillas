<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalExcel extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $nombre, public string $titulo, public string $ruta)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-excel');
    }
}
