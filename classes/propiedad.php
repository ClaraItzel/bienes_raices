<?php
namespace App;

class Propiedad{
    //Creando conexion a BD
    protected static $db;
    protected static $columnasdb= ['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamiento','creado','vendedorId'];

    //Errores
    protected static $errores = [];
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    public function __construct($args =[])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? ''; 
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? 0;
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
       return $resultado;
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

   //Validacion
   public static function getErrores(){
       return self::$errores;
   }

   //Subiendo imagenes con la libreria intervetion Image
   public function setImagen($imagen){
       //Eliminando imagen anterior
       if ($this->id) {
           //Comprobar si existe el archivo
           $existeArch= file_exists(CARPETA_IMAGENES . $this->imagen);
           if ($existeArch) {
             
               unlink(CARPETA_IMAGENES . $this->imagen);
           }
       }
       //Asignar al atributo el nombre de la imagen
       if (isset($imagen)) {
           $this->imagen= $imagen;
       }
   }
   public function validar(){

     
    if(!$this->titulo){
        self::$errores[]= "Debes añadir un titulo";
    }
    if (!$this->precio) {
        self::$errores[]= 'El precio es obligatorio';
    }
    if ($this->vendedorId==0) {
        self::$errores[]='Seleccione un vendedor';
       }
    if (strlen($this->descripcion) <50) {
        self::$errores[]='La descripción es obligatoria y debe tener almenos 50 caracteres';
    }
    if (!$this->habitaciones) {
        self::$errores[]='El numero de habitaciones es obligatorio';
    }
    if (!$this->wc) {
        self::$errores[]='El numero de baños es obligatorio';
    }
    if (!$this->estacionamiento) {
        self::$errores[]='El numero de lugares de estacionamiento es obligatorio';
    }
     if (!$this->imagen) {
         self::$errores[]='La imagen es obligatoria';
     }

    return self::$errores;
   }
   //listando propiedades
   public static function all(){
   $query= "SELECT * FROM propiedades";
    $result= self::consultarSQL($query);
    return $result;
   }
   //Buscando propiedad por si ID o registro
   public static function find($id){
    $query="SELECT * FROM propiedades WHERE id=".$id;
    $result= self::consultarSQL($query);
    return array_shift($result);
   }
   public static function consultarSQL($query){
    //Consultando bd
    $resultado= self::$db->query($query);
    //iterando
    $array=[];
    while($registro = $resultado->fetch_assoc()):
        $array[]=self::crearObj($registro);
    endwhile;
    //liberar memoria
    $resultado->free();
    //retornar result
    return $array;
       }
   protected static function crearObj($registro){
    $obj= new self;

    foreach($registro as $key => $val){
       if (property_exists( $obj, $key )) {
           $obj->$key = $val;
       }
       
    }
        return $obj;
    }
    //SICRONIZA EL OBJETO CON LOS CAMBIOS REALIZADOS POR EL USUARIO
    public function sincronizar($args=[]){
        foreach($args as $key=>$value){
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key= $value;
            }
        }
    }
}
?> 