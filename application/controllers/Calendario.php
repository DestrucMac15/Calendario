<?php 
use Carbon\Carbon; 

class Calendario extends CI_Controller{

    public function __construct(){

		parent::__construct();

		$this->load->helper(array('zoho_refresh/refresh_token','calendario/calendario'));

		$this->load->model(array('Developments_model','Users_model','Calendar_model', 'Potentials_model'));

	}

	public function index(){

		$this->template->title = 'Calendario';

		$token = comprobarToken();

		if(isset($_GET['final']) && isset($_GET['inicio'])){

			$final = new Carbon($_GET['final']);
			$inicio = new Carbon($_GET['inicio']);

			$calendario = $this->Calendar_model->get_allCalendar($token,$inicio->format('Y-m-d'),$final->format('Y-m-d'));

			$desarrollos = $this->Developments_model->all_dataDevelopments($token);

		}
		if(isset($_GET['final']) && isset($_GET['inicio']) && isset($_GET['desarrollo'])){

			$final = new Carbon($_GET['final']);
			$inicio = new Carbon($_GET['inicio']);
			$desarrollo = $_GET['desarrollo'];

			$calendario = $this->Calendar_model->get_allCalendar($token,$inicio->format('Y-m-d'),$final->format('Y-m-d'), $desarrollo);

			$desarrollos = $this->Developments_model->get_Development($token, $_GET['desarrollo']);

		}
		if(isset($_GET['final']) && isset($_GET['inicio']) && isset($_GET['vendedor'])){

			$final = new Carbon($_GET['final']);
			$inicio = new Carbon($_GET['inicio']);
			$vendedor = $_GET['vendedor'];

			$calendario = $this->Calendar_model->get_allCalendar($token,$inicio->format('Y-m-d'),$final->format('Y-m-d'), $desarrollo="", $vendedor);

			$desarrollos = $this->Developments_model->all_dataDevelopments($token);

		}
		if(isset($_GET['final']) && isset($_GET['inicio']) && isset($_GET['vendedor']) && isset($_GET['desarrollo'])){

			$final = new Carbon($_GET['final']);
			$inicio = new Carbon($_GET['inicio']);
			$vendedor = $_GET['vendedor'];
			$desarrollo = $_GET['desarrollo'];

			$calendario = $this->Calendar_model->get_allCalendar($token,$inicio->format('Y-m-d'),$final->format('Y-m-d'), $desarrollo, $vendedor);

			$desarrollos = $this->Developments_model->get_Development($token, $_GET['desarrollo']);

		}
		if(!isset($_GET['final']) && !isset($_GET['inicio']) && !isset($_GET['vendedor']) && !isset($_GET['desarrollo'])){

			$inicioc = Carbon::now()->startOfWeek()->toDateString();
			$finalc = Carbon::now()->endOfWeek()->toDateString();

			$inicio = new Carbon($inicioc);
			$final = new Carbon($finalc);

			$calendario = $this->Calendar_model->get_allCalendar($token,$inicio->format('Y-m-d'),$final->format('Y-m-d'));
			$desarrollos = $this->Developments_model->all_dataDevelopments($token);

		}
		
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

	public function exportar(){

		$this->template->title = 'Calendario';

		$token = comprobarToken();

		if(isset($_GET['final']) && isset($_GET['inicio'])){

			$final = new Carbon($_GET['final']);
			$inicio = new Carbon($_GET['inicio']);

			$calendario = $this->Calendar_model->get_allCalendar($token,$inicio->format('Y-m-d'),$final->format('Y-m-d'));
			
			$desarrollos = $this->Developments_model->all_dataDevelopments($token);

		}
		if(isset($_GET['final']) && isset($_GET['inicio']) && isset($_GET['desarrollo'])){

			$final = new Carbon($_GET['final']);
			$inicio = new Carbon($_GET['inicio']);
			$desarrollo = $_GET['desarrollo'];

			$calendario = $this->Calendar_model->get_allCalendar($token,$inicio->format('Y-m-d'),$final->format('Y-m-d'), $desarrollo);

			$desarrollos = $this->Developments_model->get_Development($token, $_GET['desarrollo']);

		}
		if(isset($_GET['final']) && isset($_GET['inicio']) && isset($_GET['vendedor'])){

			$final = new Carbon($_GET['final']);
			$inicio = new Carbon($_GET['inicio']);
			$vendedor = $_GET['vendedor'];

			$calendario = $this->Calendar_model->get_allCalendar($token,$inicio->format('Y-m-d'),$final->format('Y-m-d'), $desarrollo="", $vendedor);

			$desarrollos = $this->Developments_model->all_dataDevelopments($token);

		}
		if(isset($_GET['final']) && isset($_GET['inicio']) && isset($_GET['vendedor']) && isset($_GET['desarrollo'])){

			$final = new Carbon($_GET['final']);
			$inicio = new Carbon($_GET['inicio']);
			$vendedor = $_GET['vendedor'];
			$desarrollo = $_GET['desarrollo'];

			$calendario = $this->Calendar_model->get_allCalendar($token,$inicio->format('Y-m-d'),$final->format('Y-m-d'), $desarrollo, $vendedor);

			$desarrollos = $this->Developments_model->get_Development($token, $_GET['desarrollo']);

		}
		if(!isset($_GET['final']) && !isset($_GET['inicio']) && !isset($_GET['vendedor']) && !isset($_GET['desarrollo'])){

			$inicioc = Carbon::now()->startOfWeek()->toDateString();
			$finalc = Carbon::now()->endOfWeek()->toDateString();

			$inicio = new Carbon($inicioc);
			$final = new Carbon($finalc);

			$calendario = $this->Calendar_model->get_allCalendar($token,$inicio->format('Y-m-d'),$final->format('Y-m-d'));
			$desarrollos = $this->Developments_model->all_dataDevelopments($token);

		}
		
		$usuarios = $this->Users_model->all_dataUsers($token);
		
		$data = array(
			'desarrollos' => $desarrollos['data'],
			'usuarios' => $usuarios['users'],
			'calendario' => $calendario,
			'inicio' => $inicio,
			'final' => $final,
		);

		$this->template->content->view('app/exportar', $data);

        $this->template->publish();

	

	}

	public function save(){

		$token = comprobarToken();

		$data = array(
			'Fecha' => $this->input->post('fecha'),
			'Desarrollos' => $this->input->post('desarrollo'),
			'Vendedores' => $this->input->post('vendedor'),
			'Tipo' => $this->input->post('tipo'),
			'Descripcion' => $this->input->post('observaciones')
		);

		if(!empty($this->input->post('id'))){

			$json_upd = '{"data":['.json_encode($data).']}';
			$encode_data = json_encode($json_upd);
			
			$respuesta = $this->Calendar_model->upd_calendar($token,json_decode($encode_data),$this->input->post('id'))['data'][0];

		}else{

			$ower_id = array("Owner" => array("id" => $this->input->post('vendedor')));
			$data_sent = array_merge($data,$ower_id);

			$json_set = '{"data":['.json_encode($data_sent).']}';
			$encode_data = json_encode($json_set);

			$respuesta = $this->Calendar_model->create_calendar($token,json_decode($encode_data))['data'][0];

		}

		if($respuesta['status'] == 'success'){

			echo json_encode(array('estatus' => true, 'mensaje' => 'Se ha guardado correctamente'));

		}else{

			echo json_encode(array('estatus' => false, 'mensaje' => 'Error en el campo: '.$respuesta['details']['api_name']));
		}

	}

}