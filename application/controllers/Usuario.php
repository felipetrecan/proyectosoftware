<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Usuario extends CI_Controller {

  function __construct()
  {

    parent::__construct();

    /* Cargamos la base de datos */
    $this->load->database();

    /* Cargamos la libreria*/
    $this->load->library('grocery_crud');

    /* Añadimos el helper al controlador */
    $this->load->helper('url');
  }

  function index()
  {
    /*
     * Mandamos todo lo que llegue a la funcion
     * administracion().
     **/
    redirect('usuario/administracion');
  }

  /*
   *
   **/
  function administracion()
  {
    try{

    /* Creamos el objeto */
    $crud = new grocery_CRUD();

    /* Seleccionamos el tema */
    $crud->set_theme('flexigrid');

    /* Seleccionmos el nombre de la tabla de nuestra base de datos*/
    $crud->set_table('usuario');

    /* Le asignamos un nombre */
    $crud->set_subject('Usuario');



    /* Asignamos el idioma español */
    $crud->set_language('spanish');

    /* Aqui le decimos a grocery que estos campos son obligatorios */
    $crud->required_fields(
      'correo',
'nombre',
'apellido',
'clave'
    );

    /* Aqui le indicamos que campos deseamos mostrar */
    $crud->columns(
'correo',
'nombre',
'apellido',
'clave'

    );

    
	

    /* Generamos la tabla */
    $output = $crud->render();

    /* La cargamos en la vista situada en
    /applications/views/usuario/administracion.php */
    $this->load->view('usuario/administracion', $output);

    }catch(Exception $e){
      /* Si algo sale mal almacenamos el error y lo mostramos */
      show_error($e->getMessage().' --- '.$e->getTraceAsString());
    }
  }
/* Funciones adicionales de validación */

public function validaRut($rut)
    {
    if(strpos($rut,"-")==false){
        $RUT[0] = substr($rut, 0, -1);
        $RUT[1] = substr($rut, -1);
    }else{
        $RUT = explode("-", trim($rut));
    }
    $elRut = str_replace(".", "", trim($RUT[0]));
    $factor = 2;
    for($i = strlen($elRut)-1; $i >= 0; $i--):
        $factor = $factor > 7 ? 2 : $factor;
        $suma += $elRut{$i}*$factor++;
    endfor;
    $resto = $suma % 11;
    $dv = 11 - $resto;
    if($dv == 11){
        $dv=0;
    }else if($dv == 10){
        $dv="k";
    }else{
        $dv=$dv;
    }
      
   if($dv == trim(strtolower($RUT[1]))){
       return TRUE;
   }else{
	$this->form_validation->set_message('validaRut', "Rut Erroneo");
       return FALSE;
   }
}



}