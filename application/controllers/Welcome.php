<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('dccrac1model');
		$this->load->model('dccrac2model');
		$this->load->model('dccrac3model');
		$this->load->model('dccrac4model');
		$this->load->model('batteryacrac1model');
		$this->load->model('batteryacrac2model');
		$this->load->model('batterybcrac1model');
		$this->load->model('poweracrac1model');
		$this->load->model('poweracrac2model');
		$this->load->model('powerbcrac1model');

		$this->load->model('lvmdpmodel');
        $this->load->model('cosamodel');
        $this->load->model('mdpamodel');
        // $this->load->model('distributionamodel');
        // $this->load->model('upsamodel');
        // $this->load->model('rectifier1model');
        // $this->load->model('rectifier2model');
        // $this->load->model('rectifier3model');

 	}

	public function index()
	{
		$month = date('n');
		$year = date('Y');

		// $month = 11;

		$data['dccrac1'] = $this->dccrac1model->getDatapagi($month, $year);
		$data['dccrac2'] = $this->dccrac2model->getDatapagi($month, $year);
		$data['dccrac3'] = $this->dccrac3model->getDatapagi($month, $year);
		$data['dccrac4'] = $this->dccrac4model->getDatapagi($month, $year);
		$data['batteryacrac1'] = $this->batteryacrac1model->getDatapagi($month, $year);
		$data['batteryacrac2'] = $this->batteryacrac2model->getDatapagi($month, $year);
		$data['batterybcrac1'] = $this->batterybcrac1model->getDatapagi($month, $year);
		$data['poweracrac1'] = $this->poweracrac1model->getDatapagi($month, $year);
		$data['poweracrac2'] = $this->poweracrac2model->getDatapagi($month, $year);
		$data['powerbcrac1'] = $this->powerbcrac1model->getDatapagi($month, $year);

		$data['lvmdp'] = $this->lvmdpmodel->getDatapagi($month, $year);
		$data['cosa'] = $this->cosamodel->getDatapagi($month, $year);
		$data['mdpa'] = $this->mdpamodel->getDatapagi($month, $year);

		$bln = array(1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        $namabulan = $bln[$month];

		$data['month'] = $month;
		$data['year'] = $year;
		$data['namabulan'] = $namabulan;

		// dd($month);
		$data['content'] = 'dashboard';
		$this->load->view('layout', $data);
	}
}
