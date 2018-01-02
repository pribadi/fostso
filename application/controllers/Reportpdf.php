<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportpdf extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('pdfgenerator');

		// model power system
		$this->load->model('lvmdpmodel');
		$this->load->model('cosamodel');
		$this->load->model('cosbmodel');
		$this->load->model('distributionamodel');
		$this->load->model('distributionbmodel');
		$this->load->model('mdpamodel');
		$this->load->model('mdpbmodel');
		$this->load->model('rectifier1model');
		$this->load->model('rectifier2model');
		$this->load->model('rectifier3model');
		$this->load->model('upsamodel');
		$this->load->model('upsbmodel');

		// load model cooling
		$this->load->model('batteryacrac1model');
		$this->load->model('batteryacrac2model');
		$this->load->model('batterybcrac1model');
		$this->load->model('dccrac2model');
		$this->load->model('dccrac3model');
		$this->load->model('dccrac4model');
		$this->load->model('dccrac6model');
		$this->load->model('poweracrac1model');
		$this->load->model('poweracrac2model');
		$this->load->model('powerbcrac1model');

		$this->load->model('coolingtowermodel');
		$this->load->model('wiringmodel');
		$this->load->model('logmodel');
		$this->load->model('guestbookmodel');
	}

	public function pdflvmdp($month, $year)
	{
		$data['data'] = $this->lvmdpmodel->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdflvmdp', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist LVMDP');
	}

	public function pdfcosa($month, $year)
	{
		$data['data'] = $this->cosamodel->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfcosa', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist COS A');
	}

	public function pdfcosb($month, $year)
	{
		$data['data'] = $this->cosbmodel->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfcosb', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist COS B');
	}

	public function pdfdistributiona($month, $year)
	{
		$data['data'] = $this->distributionamodel->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfdistributiona', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist Distribution A');
	}

	public function pdfdistributionb($month, $year)
	{
		$data['data'] = $this->distributionbmodel->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfdistributionb', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist Distribution B');
	}

	public function pdfmdpa($month, $year)
	{
		$data['data'] = $this->mdpamodel->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfmdpa', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist Mdp A');
	}

	public function pdfmdpb($month, $year)
	{
		$data['data'] = $this->mdpbmodel->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfmdpb', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist Mdp B');
	}

	public function pdfrectifier1($month, $year)
	{
		$data['data'] = $this->rectifier1model->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfrectifier1', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist Rectifier 1');
	}

	public function pdfrectifier2($month, $year)
	{
		$data['data'] = $this->rectifier2model->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfrectifier2', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist Rectifier 2');
	}

	public function pdfrectifier3($month, $year)
	{
		$data['data'] = $this->rectifier3model->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfrectifier3', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist Rectifier 3');
	}

	public function pdfupsa($month, $year)
	{
		$data['data'] = $this->upsamodel->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfupsa', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist ups A');
	}

	public function pdfupsb($month, $year)
	{
		$data['data'] = $this->upsbmodel->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfupsb', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist ups B');
	}

	public function pdfbatteryacrac1($month, $year)
	{
		$data['data'] = $this->batteryacrac1model->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfbatteryacrac1', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist Battery A Crac 1');
	}

	public function pdfbatteryacrac2($month, $year)
	{
		$data['data'] = $this->batteryacrac2model->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfbatteryacrac2', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist Battery A Crac 2');
	}

	public function pdfbatterybcrac1($month, $year)
	{
		$data['data'] = $this->batterybcrac1model->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfbatterybcrac1', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist Battery B Crac 1');
	}

	public function pdfdccrac2($month, $year)
	{
		$data['data'] = $this->dccrac2model->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfdccrac2', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist Data Center CRAC 2');
	}

	public function pdfdccrac3($month, $year)
	{
		$data['data'] = $this->dccrac3model->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfdccrac3', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist Data Center CRAC 3');
	}

	public function pdfdccrac4($month, $year)
	{
		$data['data'] = $this->dccrac4model->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfdccrac4', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist Data Center CRAC 4');
	}

	public function pdfdccrac6($month, $year)
	{
		$data['data'] = $this->dccrac6model->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfdccrac6', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist Data Center CRAC 6');
	}

	public function pdfpoweracrac1($month, $year)
	{
		$data['data'] = $this->poweracrac1model->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfpoweracrac1', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist Power A Crac 1');
	}

	public function pdfpoweracrac2($month, $year)
	{
		$data['data'] = $this->poweracrac2model->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfpoweracrac2', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist Power A Crac 2');
	}

	public function pdfpowerbcrac1($month, $year)
	{
		$data['data'] = $this->powerbcrac1model->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfpowerbcrac1', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist Power B Crac 1');
	}

	public function pdfcoolingtower($month, $year)
	{
		$data['data'] = $this->coolingtowermodel->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfcoolingtower', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist Cooling Tower');
	}

	public function pdfwiring($month, $year)
	{
		$data['data'] = $this->wiringmodel->getData($month, $year);
		
	    $html = $this->load->view('reportpdf/pdfwiring', $data, true);
	    $this->pdfgenerator->generate($html,'Report Checklist Wiring Room');
	}

	public function pdflog($month, $year)
	{
		$data['data'] = $this->logmodel->getData($month, $year);

	    $html = $this->load->view('reportpdf/pdflog', $data, true);
	    $this->pdfgenerator->generate($html,'Report Log Activity ');
	}

	public function pdfguestbook($month, $year)
	{
		$data['data'] = $this->guestbookmodel->getData($month, $year);

	    $html = $this->load->view('reportpdf/pdfguestbook', $data, true);
	    $this->pdfgenerator->generate($html,'Guest Book');
	}
}