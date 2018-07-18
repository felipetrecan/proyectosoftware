<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Pupilo extends CI_Controller {

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
    redirect('pupilo/administracion');
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
    $crud->set_table('pupilo');
    $crud->set_subject('Pupilo');

    $crud->display_as('apoderado_id','Apoderado');
    $crud->set_relation('apoderado_id','apoderado','nombre');


    /* Asignamos el idioma español */
    $crud->set_language('spanish');


    /* Generamos la tabla */
    $output = $crud->render();

    /* La cargamos en la vista situada en
    /applications/views/pupilo/administracion.php */
    $this->load->view('pupilo/administracion', $output);

    }catch(Exception $e){
      /* Si algo sale mal almacenamos el error y lo mostramos */
      show_error($e->getMessage().' --- '.$e->getTraceAsString());
    }
  }
}