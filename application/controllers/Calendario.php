<?php 
use Carbon\Carbon; 
class Calendario extends CI_Controller{

    public function __construct(){

		parent::__construct();

		$this->load->helper(array('zoho_refresh/refresh_token','calendario/calendario'));

		$this->load->model(array('Developments_model','Users_model','Calendar_model'));

		

	}

	public function index(){

		$this->template->title = 'Calendario';

		$token = comprobarToken();

		if(isset($_GET['final']) && isset($_GET['inicio'])){

			$final = new Carbon($_GET['final']);
			$inicio = new Carbon($_GET['inicio']);

			$calendario = $this->Calendar_model->get_allCalendar($token,$inicio->format('Y-m-d'),$final->format('Y-m-d'));

		}
		if(isset($_GET['final']) && isset($_GET['inicio']) && isset($_GET['desarrollo'])){

			$final = new Carbon($_GET['final']);
			$inicio = new Carbon($_GET['inicio']);
			$desarrollo = $_GET['desarrollo'];

			$calendario = $this->Calendar_model->get_allCalendar($token,$inicio->format('Y-m-d'),$final->format('Y-m-d'), $desarrollo);

		}
		if(isset($_GET['final']) && isset($_GET['inicio']) && isset($_GET['vendedor'])){

			$final = new Carbon($_GET['final']);
			$inicio = new Carbon($_GET['inicio']);
			$vendedor = $_GET['vendedor'];

			$calendario = $this->Calendar_model->get_allCalendar($token,$inicio->format('Y-m-d'),$final->format('Y-m-d'), $desarrollo="", $vendedor);

		}
		if(isset($_GET['final']) && isset($_GET['inicio']) && isset($_GET['vendedor']) && isset($_GET['desarrollo'])){

			$final = new Carbon($_GET['final']);
			$inicio = new Carbon($_GET['inicio']);
			$vendedor = $_GET['vendedor'];
			$desarrollo = $_GET['desarrollo'];

			$calendario = $this->Calendar_model->get_allCalendar($token,$inicio->format('Y-m-d'),$final->format('Y-m-d'), $desarrollo, $vendedor);

		}
		if(!isset($_GET['final']) && !isset($_GET['inicio']) && !isset($_GET['vendedor']) && !isset($_GET['desarrollo'])){

			$inicioc = Carbon::now()->startOfWeek()->toDateString();
			$finalc = Carbon::now()->endOfWeek()->toDateString();

			$inicio = new Carbon($inicioc);
			$final = new Carbon($finalc);

			$calendario = $this->Calendar_model->get_allCalendar($token,$inicio->format('Y-m-d'),$final->format('Y-m-d'));

		}

		$desarrollos = $this->Developments_model->all_dataDevelopment($token);
		$usuarios = $this->Users_model->all_dataUsers($token);
		
		$data = array(
			'desarrollos' => $desarrollos['data'],
			'usuarios' => $usuarios['users'],
			'calendario' => $calendario,
			'inicio' => $inicio,
			'final' => $final,
		);

		$this->template->content->view('app/calendario', $data);

        $this->template->publish();

	}

	public function save(){

		$data = array(
			'fecha' => $this->input->post('fecha'),
			'desarrollo' => $this->input->post('desarrollo'),
			'vendedor' => $this->input->post('vendedor'),
			'tipo' => $this->input->post('tipo'),
			'observaciones' => $this->input->post('observaciones')
		);

		if(empty($this->input->post('id'))){

			//Código de Editar
			$data['id'] = $this->input->post('id');

		}else{
			
			//Código de insertar

		}


	}


}