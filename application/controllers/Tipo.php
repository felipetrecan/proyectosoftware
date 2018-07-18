<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Tipo extends CI_Controller {

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
    redirect('tipo/administracion');
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
    $crud->set_table('tipo');
    $crud->set_subject('Tipo');
$crud->columns('id','tipo');
	$crud->set_rules('tipo','tipo','callback_checar_tipo');

        


    /* Asignamos el idioma español */
    $crud->set_language('spanish');


    /* Generamos la tabla */
    $output = $crud->render();

    /* La cargamos en la vista situada en
    /applications/views/tipo/administracion.php */
    $this->load->view('tipo/administracion', $output);

    }catch(Exception $e){
      /* Si algo sale mal almacenamos el error y lo mostramos */
      show_error($e->getMessage().' --- '.$e->getTraceAsString());
    }
  }
public function checar_tipo($tipo)
        {
          if ($tipo== 'neutra') 
          {
                $this->form_validation->set_message('checar_tipo', "No puede ingresar neutra");
                return FALSE;
          }
          else
          {
                return TRUE;
          }
        }
}