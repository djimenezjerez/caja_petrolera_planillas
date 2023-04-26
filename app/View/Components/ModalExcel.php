<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalExcel extends Component
{
    private $nombre, $titulo, $ruta, $fila, $columna;

    /**
     * Create a new component instance.
     */
    public function __construct(string $nombre, string $titulo, string $ruta, int $fila, string $columna)
    {
        $this->nombre = $nombre;
        $this->titulo = $titulo;
        $this->ruta = $ruta;
        $this->fila = $fila;
        $this->columna = $columna;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-excel', [
            'columnas' => columnas_excel(),
            'nombre' => $this->nombre,
            'titulo' => $this->titulo,
            'ruta' => $this->ruta,
            'seleccion' => [
                'fila' => $this->fila,
                'columna' => $this->columna,
            ],
        ]);
    }
}
