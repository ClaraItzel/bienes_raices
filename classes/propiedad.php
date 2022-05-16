<?php
namespace App;

class Propiedad{
    //Creando conexion a BD
    protected static $db;
    protected static $columnasdb= ['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamiento','creado','vendedorId'];

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
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? 'imagen.jpg';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? ''; 
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }
     //Definiendo conexion a la bd
     public static function setDb($database){
        self::$db= $database;
    }
    public function guardar(){
        //sanitizando datos
        $atributos= $this->sanitizarDatos();

    //insertar en la bd
    $query ="INSERT INTO propiedades (";
    $query.=join(', ',array_keys( $atributos));
    $query.= " ) Values('";
    $query.=join("' , '",array_values( $atributos));
    $query.="' ) ";

 
       $resultado= self::$db->query($query);
       debuggeando($resultado);
    }
    //identifica las entradas de la bd
    public function atributos(){
        $atributos= [];
        foreach(self::$columnasdb as $col){
            if ($col=== 'id') continue;
                $atributos[$col]= $this->$col;
            
           
        }
        return $atributos;
    }
   public function sanitizarDatos(){
    $atributos= $this->atributos();
    $sanitizado=[];
    foreach($atributos as $key => $value){
        $sanitizado[$key]= self::$db->escape_string($value);
    }
    return $sanitizado;
   }
}
?> 