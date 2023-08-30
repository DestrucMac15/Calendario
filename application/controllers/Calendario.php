<?php 
use Carbon\Carbon; 
class Calendario extends CI_Controller{

    public function __construct(){

		parent::__construct();

		$this->load->helper(array('zoho_refresh/refresh_token'));

		$this->load->model(array('Developments_model','Users_model','Calendar_model'));

		

	}

	public function index(){

		$this->template->title = 'Calendario';

		$token = comprobarToken();

		if(isset($_GET['final']) && isset($_GET['inicio'])){
			$final = new Carbon($_GET['final']);
			$inicio = new Carbon($_GET['inicio']);
		}else{
			//$numeroSemana = Carbon::now()->week();
			$inicioc = Carbon::now()->startOfWeek()->toDateString();
			$finalc = Carbon::now()->endOfWeek()->toDateString();
			$inicio = new Carbon($inicioc);
			$final = new Carbon($finalc);
		}

		$desarrollos = $this->Developments_model->all_dataDevelopment($token);
		$usuarios = $this->Users_model->all_dataUsers($token);
		$calendario = $this->Calendar_model->get_allCalendar($token,$inicio->format('Y-m-d'),$final->format('Y-m-d'));
		var_dump($calendario);
		die();
		
		$data = array(
			'desarrollos' => $desarrollos['data'],
			'usuarios' => $usuarios['users']
		);

		$this->template->content->view('app/calendario', $data);

        $this->template->publish();

	}


}