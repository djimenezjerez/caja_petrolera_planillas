<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalExcel extends Component
{
    private $nombre, $titulo, $ruta, $fila;

    /**
     * Create a new component instance.
     */
    public function __construct(string $nombre, string $titulo, string $ruta, int $fila)
    {
        $this->nombre = $nombre;
        $this->titulo = $titulo;
        $this->ruta = $ruta;
        $this->fila = $fila;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-excel', [
            'nombre' => $this->nombre,
            'titulo' => $this->titulo,
            'ruta' => $this->ruta,
            'seleccion' => [
                'fila' => $this->fila,
            ],
        ]);
    }
}
