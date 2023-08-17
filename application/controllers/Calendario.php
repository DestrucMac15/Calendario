<?php 

class Calendario extends CI_Controller{

    public function __construct(){

		parent::__construct();


	}

	public function index(){
		
		$this->template->title = 'Calendario';

		$this->template->content->view('app/calendario');

        $this->template->publish();

	}


}