<?php 

class Calendario extends CI_Controller{

    public function __construct(){

		parent::__construct();

		$this->load->helper(array('zoho_refresh/refresh_token'));

		$this->load->model(array('Developments_model'));


	}

	public function index(){
		
		$this->template->title = 'Calendario';

		$token = comprobarToken();

		$desarrollos = $this->Developments_model->all_dataDevelopment($token);
		
		var_dump($desarrollos);


		$this->template->content->view('app/calendario');

        $this->template->publish();

	}


}