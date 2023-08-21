<?php 

class Calendario extends CI_Controller{

    public function __construct(){

		parent::__construct();

		$this->load->helper(array('zoho_refresh/refresh_token'));

		$this->load->model(array('Developments_model','Users_model'));

		

	}

	public function index(){

		$this->template->title = 'Calendario';

		$token = comprobarToken();

		$desarrollos = $this->Developments_model->all_dataDevelopment($token);
		$usuarios = $this->Users_model->all_dataUsers($token);
		
		$data = array(
			'desarrollos' => $desarrollos['data'],
			'usuarios' => $usuarios['users']
		);

		$this->template->content->view('app/calendario', $data);

        $this->template->publish();

	}


}