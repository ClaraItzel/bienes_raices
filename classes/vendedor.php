<?php
namespace App;

class Vendedor extends ActiveRecord{
    protected static $tabla="vendedores";
    protected static $columnasdb= ['id, nombre, apellidos, telefono'];

    public $id;
    public $nombre;
    public $apellidos;
    public $telefono;

    public function __construct($args =[])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellidos = $args['apellidos'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }
}

?>