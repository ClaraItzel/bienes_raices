<?php
namespace App;

class Propiedad{
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendorId;

    public function __construct($args =[])
    {
        $this->titulo = $args['titulo'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->titulo = $args['titulo'] ?? ''; 
        $this->titulo = $args['titulo'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
    }
}
?> 