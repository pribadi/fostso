<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        $this->load->library('excelgenerator');
        $this->load->helper('form');
        $this->load->library('form_validation');

        // load model electrical
        $this->load->model('lvmdpmodel');
        $this->load->model('cosamodel');
        $this->load->model('mdpamodel');
        $this->load->model('distributionamodel');
        $this->load->model('upsamodel');
        $this->load->model('rectifier1model');
        $this->load->model('rectifier2model');
        $this->load->model('rectifier3model');

        // load model cooling
        $this->load->model('poweracrac1model');
        $this->load->model('poweracrac2model');
        $this->load->model('powerbcrac1model');
        $this->load->model('dccrac1model');
        $this->load->model('dccrac2model');
        $this->load->model('dccrac3model');
        $this->load->model('dccrac4model');
        $this->load->model('batteryacrac1model');
        $this->load->model('batteryacrac2model');
        $this->load->model('batterybcrac1model');

        $this->load->model('coolingtowermodel');
        $this->load->model('gensetmodel');
        $this->load->model('issuemodel');

    }

    public function search($month, $year)
    {
        $month  = date('n');
        $bulan  = date('m');
        $year   = date('Y');

        if ($this->input->post()) {
            $month  = $this->input->post('month');
            $bulan  = $this->input->post('month');
            $year   = $this->input->post('year');
        }

        $bln = array(1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

        $namabulan = $bln[$bulan];

        $data['month']  = $month;
        $data['year']   = $year;
        $data['namabulan']  = $namabulan;

        $data['content'] = 'report/search';
        $this->load->view('layout', $data);
    }

    public function checklist()
    {
        if ($this->input->post()) {
            $this->form_validation->set_rules('tanggal', 'Date', 'trim|required');
            $this->form_validation->set_rules('jam', 'Time', 'trim|required');

            // Jika validasi berhasil
            if ($this->form_validation->run() == FALSE)
            {
                $data['content'] = 'report/checklist';
                $this->load->view('layout', $data);
            } else {

                $tanggal = $this->input->post('tanggal').' '.$this->input->post('jam');
                $tanggalChecklist = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

                $dataLvmdp = $this->db->select('*')
                    ->where('datetime_lvmdp', $tanggalChecklist->format('Y-m-d H:i') )
                    ->get('lvmdp')->result_array();

                $dataGenset = $this->db->select('*')
                    ->order_by('datetime_genset DESC')
                    ->get('genset')->result_array();

                $dataMdpa = $this->db->select('*')
                    ->where('datetime_mdpa', $tanggalChecklist->format('Y-m-d H:i') )
                    ->get('mdpa')->result_array();

                $dataUpsa = $this->db->select('*')
                    ->where('datetime_upsa', $tanggalChecklist->format('Y-m-d H:i') )
                    ->get('upsa')->result_array();

                $dataDistributiona = $this->db->select('*')
                    ->where('datetime_distributiona', $tanggalChecklist->format('Y-m-d H:i') )
                    ->get('distributiona')->result_array();

                $dataRectifier1 = $this->db->select('*')
                    ->where('datetime_rectifier1', $tanggalChecklist->format('Y-m-d H:i') )
                    ->get('rectifier1')->result_array();

                $dataRectifier2 = $this->db->select('*')
                    ->where('datetime_rectifier2', $tanggalChecklist->format('Y-m-d H:i') )
                    ->get('rectifier2')->result_array();

                $dataRectifier3 = $this->db->select('*')
                    ->where('datetime_rectifier3', $tanggalChecklist->format('Y-m-d H:i') )
                    ->get('rectifier3')->result_array();

                $dataRectifier3 = $this->db->select('*')
                    ->where('datetime_rectifier3', $tanggalChecklist->format('Y-m-d H:i') )
                    ->get('rectifier3')->result_array();

                $dataIssue = $this->db->select('*')
                    ->where('status', 'Open')
                    ->order_by('tanggal ASC')
                    ->get('issue')->result_array();

                $data['tanggalChecklist'] = $tanggalChecklist;
                $data['dataLvmdp'] = $dataLvmdp;
                $data['dataGenset'] = $dataGenset[0];
                $data['dataMdpa'] = $dataMdpa;
                $data['dataUpsa'] = $dataUpsa;
                $data['dataDistributiona'] = $dataDistributiona;
                $data['dataRectifier1'] = $dataRectifier1;
                $data['dataRectifier2'] = $dataRectifier2;
                $data['dataRectifier3'] = $dataRectifier3;
                $data['dataIssue'] = $dataIssue;
                $data['content'] = 'report/checklist';
                $this->load->view('layout', $data);
            }
        } else {
            // $tanggal = $tanggal.' '.$jam;
            // dd($tanggal);
            // $tanggalChecklist = DateTime::createFromFormat('d/m/Y H:i', $tanggal);
            // $data['tanggalChecklist'] = $tanggalChecklist;
            $data['content'] = 'report/checklist';
            $this->load->view('layout', $data);
        }
    }

    public function download($month, $year)
    {
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getProperties()
                    ->setCreator("Wahyu Pribadi")
                    ->setLastModifiedBy("Wahyu")
                    ->setTitle("Reports")
                    ->setSubject("Excel Turorials")
                    ->setDescription("Test document")
                    ->setKeywords("phpExcel")
                    ->setCategory("Test file");

        /***** STYLE TABLE *****/
        // Title
        $titleStyle = array(
            'font'  => array(
                'bold'  => true,
                'size'  => 14
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );

        // heading table
        $theadStyle = array(
            'font'  => array(
                'bold'  => true
            )
        );

       // border table
        $styleTabel = array(
            'borders' => array(
                'top' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000'),
                    ),
                'left' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000'),
                    ),
                'right' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000'),
                    ),
                'bottom' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000'),
                    ),
                ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );


        // **************************************** LVMDP ****************************************

        $objPHPExcel->setActiveSheetIndex(0);

        // auto size kolom
        foreach (range('A','P') as $i) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }

        //Title page
        $objPHPExcel->getActiveSheet()->mergeCells('A1:P1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DAILY ELECTRICAL WORK CHECKLIST');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:P2');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Customer : PT. TELKOMSEL');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:P3');
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Equipment : LVMDP');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:P4');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Location : Power House');
        $objPHPExcel->getActiveSheet()->mergeCells('A5:P5');
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Floor : B1');

        // Heading Tabel
        $objPHPExcel->getActiveSheet()->getStyle('A6:P6')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A7:P7')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A8:P8')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A6:P6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A7:P7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A8:P8')->applyFromArray($styleTabel);

        //color heading table
        $objPHPExcel->getActiveSheet()->getStyle('A6:P6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A7:P7')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A8:P8')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );

        $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Date');
        $objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Time');
        $objPHPExcel->getActiveSheet()->mergeCells('C6:H6');
        $objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Voltage (Volt)');
        $objPHPExcel->getActiveSheet()->mergeCells('I6:K6');
        $objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('I6', 'Current');
        $objPHPExcel->getActiveSheet()->getStyle('I6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('L6', 'Freq');
        $objPHPExcel->getActiveSheet()->getStyle('L6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('M6', 'KVA');
        $objPHPExcel->getActiveSheet()->getStyle('M6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('N6', 'PF');
        $objPHPExcel->getActiveSheet()->getStyle('N6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('O6', 'Remark');
        $objPHPExcel->getActiveSheet()->getStyle('O6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('P6', 'Name');
        $objPHPExcel->getActiveSheet()->getStyle('P6')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Tanggal');
        $objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Waktu');
        $objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('C7:E7');
        $objPHPExcel->getActiveSheet()->SetCellValue('C7', 'Phase To Phase');
        $objPHPExcel->getActiveSheet()->getStyle('C7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('F7:H7');
        $objPHPExcel->getActiveSheet()->SetCellValue('F7', 'Phase To Neutral');
        $objPHPExcel->getActiveSheet()->getStyle('F7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('I7:K7');
        $objPHPExcel->getActiveSheet()->SetCellValue('I7', '(Amp)');
        $objPHPExcel->getActiveSheet()->getStyle('I7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('L7', '(Hz)');
        $objPHPExcel->getActiveSheet()->getStyle('L7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('M7', '');
        $objPHPExcel->getActiveSheet()->getStyle('M7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('N7', '');
        $objPHPExcel->getActiveSheet()->getStyle('N7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('O7', 'Catatan');
        $objPHPExcel->getActiveSheet()->getStyle('O7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('P7', 'Nama');
        $objPHPExcel->getActiveSheet()->getStyle('P7')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A8', '');
        $objPHPExcel->getActiveSheet()->getStyle('A8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B8', '');
        $objPHPExcel->getActiveSheet()->getStyle('B8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C8', 'R-S');
        $objPHPExcel->getActiveSheet()->getStyle('C8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D8', 'S-T');
        $objPHPExcel->getActiveSheet()->getStyle('D8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E8', 'T-R');
        $objPHPExcel->getActiveSheet()->getStyle('E8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F8', 'R-N');
        $objPHPExcel->getActiveSheet()->getStyle('F8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G8', 'S-N');
        $objPHPExcel->getActiveSheet()->getStyle('G8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('H8', 'T-N');
        $objPHPExcel->getActiveSheet()->getStyle('H8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('I8', 'R');
        $objPHPExcel->getActiveSheet()->getStyle('I8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('J8', 'S');
        $objPHPExcel->getActiveSheet()->getStyle('J8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('K8', 'T');
        $objPHPExcel->getActiveSheet()->getStyle('K8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('L8', '');
        $objPHPExcel->getActiveSheet()->getStyle('L8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('M8', '');
        $objPHPExcel->getActiveSheet()->getStyle('M8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('N8', '');
        $objPHPExcel->getActiveSheet()->getStyle('N8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('O8', '');
        $objPHPExcel->getActiveSheet()->getStyle('O8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('P8', '');
        $objPHPExcel->getActiveSheet()->getStyle('P8')->applyFromArray($styleTabel);

        //ambil data dari model
        $data = $this->lvmdpmodel->getData($month, $year);

        $c = 9;
        $limit = $c + count($data);

        for ($i=$c; $i < $limit ; $i++) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, date("d-M-y",strtotime($data[$i-$c]['datetime_lvmdp'])));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, date("H:i", strtotime($data[$i-$c]['datetime_lvmdp'])));
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $data[$i-$c]['rs']);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $data[$i-$c]['st']);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $data[$i-$c]['tr']);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $data[$i-$c]['rn']);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $data[$i-$c]['sn']);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, $data[$i-$c]['tn']);
            $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, $data[$i-$c]['r']);
            $objPHPExcel->getActiveSheet()->getStyle('I'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, $data[$i-$c]['s']);
            $objPHPExcel->getActiveSheet()->getStyle('J'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, $data[$i-$c]['t']);
            $objPHPExcel->getActiveSheet()->getStyle('K'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, $data[$i-$c]['freq']);
            $objPHPExcel->getActiveSheet()->getStyle('L'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, $data[$i-$c]['kva']);
            $objPHPExcel->getActiveSheet()->getStyle('M'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, $data[$i-$c]['pf']);
            $objPHPExcel->getActiveSheet()->getStyle('N'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, $data[$i-$c]['remark']);
            $objPHPExcel->getActiveSheet()->getStyle('O'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('P'.$i, $data[$i-$c]['fs_name']);
            $objPHPExcel->getActiveSheet()->getStyle('P'.$i)->applyFromArray($styleTabel);
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('LVMDP');


        // **************************************** Sheet COS A ****************************************

        $objPHPExcel->createSheet();

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(1);

        // auto size kolom
        foreach (range('A','P') as $i) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }

        //Title page
        $objPHPExcel->getActiveSheet()->mergeCells('A1:P1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DAILY ELECTRICAL WORK CHECKLIST');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:P2');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Customer : PT. TELKOMSEL');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:P3');
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Equipment : COS A');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:P4');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Location : Power House');
        $objPHPExcel->getActiveSheet()->mergeCells('A5:P5');
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Floor : B1');

        // Heading Tabel
        $objPHPExcel->getActiveSheet()->getStyle('A6:P6')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A7:P7')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A8:P8')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A6:P6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A7:P7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A8:P8')->applyFromArray($styleTabel);

        //color heading table
        $objPHPExcel->getActiveSheet()->getStyle('A6:P6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A7:P7')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A8:P8')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );

        // Heading table
        $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Date');
        $objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Time');
        $objPHPExcel->getActiveSheet()->mergeCells('C6:H6');
        $objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Voltage (Volt)');
        $objPHPExcel->getActiveSheet()->mergeCells('I6:K6');
        $objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('I6', 'Current');
        $objPHPExcel->getActiveSheet()->getStyle('I6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('L6', 'Freq');
        $objPHPExcel->getActiveSheet()->getStyle('L6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('M6', 'KVA');
        $objPHPExcel->getActiveSheet()->getStyle('M6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('N6', 'PF');
        $objPHPExcel->getActiveSheet()->getStyle('N6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('O6', 'Remark');
        $objPHPExcel->getActiveSheet()->getStyle('O6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('P6', 'Name');
        $objPHPExcel->getActiveSheet()->getStyle('P6')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Tanggal');
        $objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Waktu');
        $objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('C7:E7');
        $objPHPExcel->getActiveSheet()->SetCellValue('C7', 'Phase To Phase');
        $objPHPExcel->getActiveSheet()->getStyle('C7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('F7:H7');
        $objPHPExcel->getActiveSheet()->SetCellValue('F7', 'Phase To Neutral');
        $objPHPExcel->getActiveSheet()->getStyle('F7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('I7:K7');
        $objPHPExcel->getActiveSheet()->SetCellValue('I7', '(Amp)');
        $objPHPExcel->getActiveSheet()->getStyle('I7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('L7', '(Hz)');
        $objPHPExcel->getActiveSheet()->getStyle('L7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('M7', '');
        $objPHPExcel->getActiveSheet()->getStyle('M7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('N7', '');
        $objPHPExcel->getActiveSheet()->getStyle('N7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('O7', 'Catatan');
        $objPHPExcel->getActiveSheet()->getStyle('O7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('P7', 'Nama');
        $objPHPExcel->getActiveSheet()->getStyle('P7')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A8', '');
        $objPHPExcel->getActiveSheet()->getStyle('A8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B8', '');
        $objPHPExcel->getActiveSheet()->getStyle('B8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C8', 'R-S');
        $objPHPExcel->getActiveSheet()->getStyle('C8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D8', 'S-T');
        $objPHPExcel->getActiveSheet()->getStyle('D8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E8', 'T-R');
        $objPHPExcel->getActiveSheet()->getStyle('E8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F8', 'R-N');
        $objPHPExcel->getActiveSheet()->getStyle('F8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G8', 'S-N');
        $objPHPExcel->getActiveSheet()->getStyle('G8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('H8', 'T-N');
        $objPHPExcel->getActiveSheet()->getStyle('H8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('I8', 'R');
        $objPHPExcel->getActiveSheet()->getStyle('I8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('J8', 'S');
        $objPHPExcel->getActiveSheet()->getStyle('J8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('K8', 'T');
        $objPHPExcel->getActiveSheet()->getStyle('K8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('L8', '');
        $objPHPExcel->getActiveSheet()->getStyle('L8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('M8', '');
        $objPHPExcel->getActiveSheet()->getStyle('M8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('N8', '');
        $objPHPExcel->getActiveSheet()->getStyle('N8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('O8', '');
        $objPHPExcel->getActiveSheet()->getStyle('O8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('P8', '');
        $objPHPExcel->getActiveSheet()->getStyle('P8')->applyFromArray($styleTabel);

        //ambil data dari model
        $data = $this->cosamodel->getData($month, $year);

        $c = 9;
        $limit = $c + count($data);

        for ($i=$c; $i < $limit ; $i++) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, date("d-M-y",strtotime($data[$i-$c]['datetime_cosa'])));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, date("H:i", strtotime($data[$i-$c]['datetime_cosa'])));
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $data[$i-$c]['rs']);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $data[$i-$c]['st']);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $data[$i-$c]['tr']);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $data[$i-$c]['rn']);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $data[$i-$c]['sn']);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, $data[$i-$c]['tn']);
            $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, $data[$i-$c]['r']);
            $objPHPExcel->getActiveSheet()->getStyle('I'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, $data[$i-$c]['s']);
            $objPHPExcel->getActiveSheet()->getStyle('J'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, $data[$i-$c]['t']);
            $objPHPExcel->getActiveSheet()->getStyle('K'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, $data[$i-$c]['freq']);
            $objPHPExcel->getActiveSheet()->getStyle('L'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, $data[$i-$c]['kva']);
            $objPHPExcel->getActiveSheet()->getStyle('M'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, $data[$i-$c]['pf']);
            $objPHPExcel->getActiveSheet()->getStyle('N'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, $data[$i-$c]['remark']);
            $objPHPExcel->getActiveSheet()->getStyle('O'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('P'.$i, $data[$i-$c]['fs_name']);
            $objPHPExcel->getActiveSheet()->getStyle('P'.$i)->applyFromArray($styleTabel);
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('COS A');


        // **************************************** MDP A ****************************************
        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(2);

        // auto size kolom
        foreach (range('A','P') as $i) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }

        //Title page
        $objPHPExcel->getActiveSheet()->mergeCells('A1:P1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DAILY ELECTRICAL WORK CHECKLIST');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:P2');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Customer : PT. TELKOMSEL');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:P3');
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Equipment : MDP A');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:P4');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Location : Power A');
        $objPHPExcel->getActiveSheet()->mergeCells('A5:P5');
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Floor : 7');

        // Heading Tabel
        $objPHPExcel->getActiveSheet()->getStyle('A6:P6')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A7:P7')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A8:P8')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A6:P6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A7:P7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A8:P8')->applyFromArray($styleTabel);

        //color heading table
        $objPHPExcel->getActiveSheet()->getStyle('A6:P6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A7:P7')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A8:P8')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );

        // Heading table
        $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Date');
        $objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Time');
        $objPHPExcel->getActiveSheet()->mergeCells('C6:H6');
        $objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Voltage (Volt)');
        $objPHPExcel->getActiveSheet()->mergeCells('I6:K6');
        $objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('I6', 'Current');
        $objPHPExcel->getActiveSheet()->getStyle('I6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('L6', 'Freq');
        $objPHPExcel->getActiveSheet()->getStyle('L6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('M6', 'KVA');
        $objPHPExcel->getActiveSheet()->getStyle('M6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('N6', 'PF');
        $objPHPExcel->getActiveSheet()->getStyle('N6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('O6', 'Remark');
        $objPHPExcel->getActiveSheet()->getStyle('O6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('P6', 'Name');
        $objPHPExcel->getActiveSheet()->getStyle('P6')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Tanggal');
        $objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Waktu');
        $objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('C7:E7');
        $objPHPExcel->getActiveSheet()->SetCellValue('C7', 'Phase To Phase');
        $objPHPExcel->getActiveSheet()->getStyle('C7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('F7:H7');
        $objPHPExcel->getActiveSheet()->SetCellValue('F7', 'Phase To Neutral');
        $objPHPExcel->getActiveSheet()->getStyle('F7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('I7:K7');
        $objPHPExcel->getActiveSheet()->SetCellValue('I7', '(Amp)');
        $objPHPExcel->getActiveSheet()->getStyle('I7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('L7', '(Hz)');
        $objPHPExcel->getActiveSheet()->getStyle('L7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('M7', '');
        $objPHPExcel->getActiveSheet()->getStyle('M7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('N7', '');
        $objPHPExcel->getActiveSheet()->getStyle('N7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('O7', 'Catatan');
        $objPHPExcel->getActiveSheet()->getStyle('O7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('P7', 'Nama');
        $objPHPExcel->getActiveSheet()->getStyle('P7')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A8', '');
        $objPHPExcel->getActiveSheet()->getStyle('A8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B8', '');
        $objPHPExcel->getActiveSheet()->getStyle('B8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C8', 'R-S');
        $objPHPExcel->getActiveSheet()->getStyle('C8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D8', 'S-T');
        $objPHPExcel->getActiveSheet()->getStyle('D8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E8', 'T-R');
        $objPHPExcel->getActiveSheet()->getStyle('E8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F8', 'R-N');
        $objPHPExcel->getActiveSheet()->getStyle('F8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G8', 'S-N');
        $objPHPExcel->getActiveSheet()->getStyle('G8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('H8', 'T-N');
        $objPHPExcel->getActiveSheet()->getStyle('H8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('I8', 'R');
        $objPHPExcel->getActiveSheet()->getStyle('I8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('J8', 'S');
        $objPHPExcel->getActiveSheet()->getStyle('J8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('K8', 'T');
        $objPHPExcel->getActiveSheet()->getStyle('K8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('L8', '');
        $objPHPExcel->getActiveSheet()->getStyle('L8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('M8', '');
        $objPHPExcel->getActiveSheet()->getStyle('M8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('N8', '');
        $objPHPExcel->getActiveSheet()->getStyle('N8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('O8', '');
        $objPHPExcel->getActiveSheet()->getStyle('O8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('P8', '');
        $objPHPExcel->getActiveSheet()->getStyle('P8')->applyFromArray($styleTabel);

        //ambil data dari model
        $data = $this->mdpamodel->getData($month, $year);

        $c = 9;
        $limit = $c + count($data);

        for ($i=$c; $i < $limit ; $i++) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, date("d-M-y",strtotime($data[$i-$c]['datetime_mdpa'])));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, date("H:i", strtotime($data[$i-$c]['datetime_mdpa'])));
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $data[$i-$c]['rs']);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $data[$i-$c]['st']);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $data[$i-$c]['tr']);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $data[$i-$c]['rn']);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $data[$i-$c]['sn']);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, $data[$i-$c]['tn']);
            $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, $data[$i-$c]['r']);
            $objPHPExcel->getActiveSheet()->getStyle('I'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, $data[$i-$c]['s']);
            $objPHPExcel->getActiveSheet()->getStyle('J'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, $data[$i-$c]['t']);
            $objPHPExcel->getActiveSheet()->getStyle('K'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, $data[$i-$c]['freq']);
            $objPHPExcel->getActiveSheet()->getStyle('L'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, $data[$i-$c]['kva']);
            $objPHPExcel->getActiveSheet()->getStyle('M'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, $data[$i-$c]['pf']);
            $objPHPExcel->getActiveSheet()->getStyle('N'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, $data[$i-$c]['remark']);
            $objPHPExcel->getActiveSheet()->getStyle('O'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('P'.$i, $data[$i-$c]['fs_name']);
            $objPHPExcel->getActiveSheet()->getStyle('P'.$i)->applyFromArray($styleTabel);
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('MDP A');


        // **************************************** Distribution A ****************************************
        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(3);

        // auto size kolom
        foreach (range('A','P') as $i) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }

        //Title page
        $objPHPExcel->getActiveSheet()->mergeCells('A1:P1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DAILY ELECTRICAL WORK CHECKLIST');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:P2');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Customer : PT. TELKOMSEL');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:P3');
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Equipment : Distribution A');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:P4');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Location : Power A');
        $objPHPExcel->getActiveSheet()->mergeCells('A5:P5');
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Floor : 7');

        // Heading Tabel
        $objPHPExcel->getActiveSheet()->getStyle('A6:P6')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A7:P7')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A8:P8')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A6:P6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A7:P7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A8:P8')->applyFromArray($styleTabel);

        //color heading table
        $objPHPExcel->getActiveSheet()->getStyle('A6:P6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A7:P7')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A8:P8')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );

        // Heading table
        $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Date');
        $objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Time');
        $objPHPExcel->getActiveSheet()->mergeCells('C6:H6');
        $objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Voltage (Volt)');
        $objPHPExcel->getActiveSheet()->mergeCells('I6:K6');
        $objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('I6', 'Current');
        $objPHPExcel->getActiveSheet()->getStyle('I6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('L6', 'Freq');
        $objPHPExcel->getActiveSheet()->getStyle('L6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('M6', 'KVA');
        $objPHPExcel->getActiveSheet()->getStyle('M6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('N6', 'PF');
        $objPHPExcel->getActiveSheet()->getStyle('N6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('O6', 'Remark');
        $objPHPExcel->getActiveSheet()->getStyle('O6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('P6', 'Name');
        $objPHPExcel->getActiveSheet()->getStyle('P6')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Tanggal');
        $objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Waktu');
        $objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('C7:E7');
        $objPHPExcel->getActiveSheet()->SetCellValue('C7', 'Phase To Phase');
        $objPHPExcel->getActiveSheet()->getStyle('C7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('F7:H7');
        $objPHPExcel->getActiveSheet()->SetCellValue('F7', 'Phase To Neutral');
        $objPHPExcel->getActiveSheet()->getStyle('F7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('I7:K7');
        $objPHPExcel->getActiveSheet()->SetCellValue('I7', '(Amp)');
        $objPHPExcel->getActiveSheet()->getStyle('I7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('L7', '(Hz)');
        $objPHPExcel->getActiveSheet()->getStyle('L7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('M7', '');
        $objPHPExcel->getActiveSheet()->getStyle('M7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('N7', '');
        $objPHPExcel->getActiveSheet()->getStyle('N7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('O7', 'Catatan');
        $objPHPExcel->getActiveSheet()->getStyle('O7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('P7', 'Nama');
        $objPHPExcel->getActiveSheet()->getStyle('P7')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A8', '');
        $objPHPExcel->getActiveSheet()->getStyle('A8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B8', '');
        $objPHPExcel->getActiveSheet()->getStyle('B8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C8', 'R-S');
        $objPHPExcel->getActiveSheet()->getStyle('C8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D8', 'S-T');
        $objPHPExcel->getActiveSheet()->getStyle('D8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E8', 'T-R');
        $objPHPExcel->getActiveSheet()->getStyle('E8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F8', 'R-N');
        $objPHPExcel->getActiveSheet()->getStyle('F8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G8', 'S-N');
        $objPHPExcel->getActiveSheet()->getStyle('G8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('H8', 'T-N');
        $objPHPExcel->getActiveSheet()->getStyle('H8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('I8', 'R');
        $objPHPExcel->getActiveSheet()->getStyle('I8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('J8', 'S');
        $objPHPExcel->getActiveSheet()->getStyle('J8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('K8', 'T');
        $objPHPExcel->getActiveSheet()->getStyle('K8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('L8', '');
        $objPHPExcel->getActiveSheet()->getStyle('L8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('M8', '');
        $objPHPExcel->getActiveSheet()->getStyle('M8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('N8', '');
        $objPHPExcel->getActiveSheet()->getStyle('N8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('O8', '');
        $objPHPExcel->getActiveSheet()->getStyle('O8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('P8', '');
        $objPHPExcel->getActiveSheet()->getStyle('P8')->applyFromArray($styleTabel);

        //ambil data dari model
        $data = $this->distributionamodel->getData($month, $year);

        $c = 9;
        $limit = $c + count($data);

        for ($i=$c; $i < $limit ; $i++) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, date("d-M-y",strtotime($data[$i-$c]['datetime_distributiona'])));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, date("H:i", strtotime($data[$i-$c]['datetime_distributiona'])));
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $data[$i-$c]['rs']);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $data[$i-$c]['st']);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $data[$i-$c]['tr']);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $data[$i-$c]['rn']);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $data[$i-$c]['sn']);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, $data[$i-$c]['tn']);
            $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, $data[$i-$c]['r']);
            $objPHPExcel->getActiveSheet()->getStyle('I'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, $data[$i-$c]['s']);
            $objPHPExcel->getActiveSheet()->getStyle('J'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, $data[$i-$c]['t']);
            $objPHPExcel->getActiveSheet()->getStyle('K'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, $data[$i-$c]['freq']);
            $objPHPExcel->getActiveSheet()->getStyle('L'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, $data[$i-$c]['kva']);
            $objPHPExcel->getActiveSheet()->getStyle('M'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, $data[$i-$c]['pf']);
            $objPHPExcel->getActiveSheet()->getStyle('N'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, $data[$i-$c]['remark']);
            $objPHPExcel->getActiveSheet()->getStyle('O'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('P'.$i, $data[$i-$c]['fs_name']);
            $objPHPExcel->getActiveSheet()->getStyle('P'.$i)->applyFromArray($styleTabel);
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Distribution A');


        // **************************************** UPS A ****************************************
        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(4);

        // auto size kolom
        foreach (range('A','R') as $i) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }

        //Title page
        $objPHPExcel->getActiveSheet()->mergeCells('A1:R1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DAILY ELECTRICAL WORK CHECKLIST');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:R2');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Customer : PT. TELKOMSEL');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:R3');
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Equipment : UPS A');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:R4');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Location : Power A');
        $objPHPExcel->getActiveSheet()->mergeCells('A5:R5');
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Floor : 7');

        // Heading Tabel
        $objPHPExcel->getActiveSheet()->getStyle('A6:R6')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A6:R6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A7:R7')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A7:R7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A8:R8')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A8:R8')->applyFromArray($styleTabel);

        //color heading table
        $objPHPExcel->getActiveSheet()->getStyle('A6:R6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A7:R7')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A8:R8')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );

        // Heading table
        $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Date');
        $objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Time');
        $objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('C6:E6');
        $objPHPExcel->getActiveSheet()->SetCellValue('C6', ' ');
        $objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('F6:O6');
        $objPHPExcel->getActiveSheet()->SetCellValue('F6', ' ');
        $objPHPExcel->getActiveSheet()->getStyle('F6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('P6', 'Batt');
        $objPHPExcel->getActiveSheet()->getStyle('P6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('Q6', 'REMARK');
        $objPHPExcel->getActiveSheet()->getStyle('Q6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('R6', 'NAME');
        $objPHPExcel->getActiveSheet()->getStyle('R6')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Tanggal');
        $objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Waktu');
        $objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('C7:E7');
        $objPHPExcel->getActiveSheet()->getStyle('C7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C7', 'VOLTAGE (Volt)');
        $objPHPExcel->getActiveSheet()->SetCellValue('F7', 'FREQ');
        $objPHPExcel->getActiveSheet()->getStyle('F7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('G7:I7');
        $objPHPExcel->getActiveSheet()->getStyle('G7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G7', 'CURRENT (Amp)');
        $objPHPExcel->getActiveSheet()->mergeCells('J7:L7');
        $objPHPExcel->getActiveSheet()->getStyle('J7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('J7', 'CURRENT (%)');
        $objPHPExcel->getActiveSheet()->mergeCells('M7:N7');
        $objPHPExcel->getActiveSheet()->getStyle('M7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('M7', 'LOAD');
        $objPHPExcel->getActiveSheet()->SetCellValue('O7', 'AUTO');
        $objPHPExcel->getActiveSheet()->getStyle('O7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('P7', 'Volt.');
        $objPHPExcel->getActiveSheet()->getStyle('P7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('Q7', 'Catatan');
        $objPHPExcel->getActiveSheet()->getStyle('Q7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('R7', 'NAME');
        $objPHPExcel->getActiveSheet()->getStyle('R7')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A8', '');
        $objPHPExcel->getActiveSheet()->getStyle('A8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B8', '');
        $objPHPExcel->getActiveSheet()->getStyle('B8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C8', 'R-S');
        $objPHPExcel->getActiveSheet()->getStyle('C8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D8', 'S-T');
        $objPHPExcel->getActiveSheet()->getStyle('D8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E8', 'T-R');
        $objPHPExcel->getActiveSheet()->getStyle('E8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F8', '(Hz)');
        $objPHPExcel->getActiveSheet()->getStyle('F8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G8', 'R');
        $objPHPExcel->getActiveSheet()->getStyle('G8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('H8', 'S');
        $objPHPExcel->getActiveSheet()->getStyle('H8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('I8', 'T');
        $objPHPExcel->getActiveSheet()->getStyle('I8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('J8', 'R');
        $objPHPExcel->getActiveSheet()->getStyle('J8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('K8', 'S');
        $objPHPExcel->getActiveSheet()->getStyle('K8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('L8', 'T');
        $objPHPExcel->getActiveSheet()->getStyle('L8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('M8', 'KVA');
        $objPHPExcel->getActiveSheet()->getStyle('M8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('N8', '%');
        $objPHPExcel->getActiveSheet()->getStyle('N8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('O8', '(Min)');
        $objPHPExcel->getActiveSheet()->getStyle('O8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('P8', '(Ub)');
        $objPHPExcel->getActiveSheet()->getStyle('P8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('Q8', '');
        $objPHPExcel->getActiveSheet()->getStyle('Q8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('R8', '');
        $objPHPExcel->getActiveSheet()->getStyle('R8')->applyFromArray($styleTabel);

        //ambil data dari model
        $data = $this->upsamodel->getData($month, $year);

        $c = 9;
        $limit = $c + count($data);

        for ($i=$c; $i < $limit ; $i++) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, date("d-M-y",strtotime($data[$i-$c]['datetime_upsa'])));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, date("H:i", strtotime($data[$i-$c]['datetime_upsa'])));
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleTabel);

            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $data[$i-$c]['rs']);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $data[$i-$c]['st']);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $data[$i-$c]['tr']);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleTabel);

            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $data[$i-$c]['freq']);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleTabel);

            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $data[$i-$c]['current_amp_r']);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, $data[$i-$c]['current_amp_s']);
            $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, $data[$i-$c]['current_amp_t']);
            $objPHPExcel->getActiveSheet()->getStyle('I'.$i)->applyFromArray($styleTabel);

            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, $data[$i-$c]['current_persen_r']);
            $objPHPExcel->getActiveSheet()->getStyle('J'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, $data[$i-$c]['current_persen_s']);
            $objPHPExcel->getActiveSheet()->getStyle('K'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, $data[$i-$c]['current_persen_t']);
            $objPHPExcel->getActiveSheet()->getStyle('L'.$i)->applyFromArray($styleTabel);

            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, $data[$i-$c]['load_kva']);
            $objPHPExcel->getActiveSheet()->getStyle('M'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, $data[$i-$c]['load_persen']);
            $objPHPExcel->getActiveSheet()->getStyle('N'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, $data[$i-$c]['auto_minutes']);
            $objPHPExcel->getActiveSheet()->getStyle('O'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('P'.$i, $data[$i-$c]['battery']);
            $objPHPExcel->getActiveSheet()->getStyle('P'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$i, $data[$i-$c]['remark']);
            $objPHPExcel->getActiveSheet()->getStyle('Q'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('R'.$i, $data[$i-$c]['fs_name']);
            $objPHPExcel->getActiveSheet()->getStyle('R'.$i)->applyFromArray($styleTabel);
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('UPS A');


        // **************************************** Rectifier 1 ****************************************
        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(5);

        // auto size kolom
        foreach (range('A','I') as $i) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }

        //Title page
        $objPHPExcel->getActiveSheet()->mergeCells('A1:I1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DAILY ELECTRICAL WORK CHECKLIST');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:I2');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Customer : PT. TELKOMSEL');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:I3');
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Equipment : Rectifier 1');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:I4');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Location : Power B');
        $objPHPExcel->getActiveSheet()->mergeCells('A5:I5');
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Floor : 7');

        // Heading Tabel
        $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A7:I7')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A7:I7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A8:I8')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A8:I8')->applyFromArray($styleTabel);

        //color heading table
        $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A7:I7')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A8:I8')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );

        // Heading table
        $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Date');
        $objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Time');
        $objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('C6:D6');
        $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Reading - Pembacaan');
        $objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E6', 'Accupancy');
        $objPHPExcel->getActiveSheet()->getStyle('E6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F6', 'Autonomi');
        $objPHPExcel->getActiveSheet()->getStyle('F6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G6', 'Alarm Condition');
        $objPHPExcel->getActiveSheet()->getStyle('G6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('H6', 'Remark');
        $objPHPExcel->getActiveSheet()->getStyle('H6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('I6', 'Name');
        $objPHPExcel->getActiveSheet()->getStyle('I6')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Tanggal');
        $objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Waktu');
        $objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C7', 'Load');
        $objPHPExcel->getActiveSheet()->getStyle('C7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D7', 'Voltage');
        $objPHPExcel->getActiveSheet()->getStyle('D7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E7', '%');
        $objPHPExcel->getActiveSheet()->getStyle('E7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F7', 'Minutes');
        $objPHPExcel->getActiveSheet()->getStyle('F7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G7', 'Kondisi Alarm');
        $objPHPExcel->getActiveSheet()->getStyle('G7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('H7', 'Catatan');
        $objPHPExcel->getActiveSheet()->getStyle('H7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('I7', 'Nama');
        $objPHPExcel->getActiveSheet()->getStyle('I7')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A8', '');
        $objPHPExcel->getActiveSheet()->getStyle('A8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B8', '');
        $objPHPExcel->getActiveSheet()->getStyle('B8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C8', '(Amp)');
        $objPHPExcel->getActiveSheet()->getStyle('C8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D8', '(V)');
        $objPHPExcel->getActiveSheet()->getStyle('D8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E8', '');
        $objPHPExcel->getActiveSheet()->getStyle('E8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F8', '');
        $objPHPExcel->getActiveSheet()->getStyle('F8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G8', '');
        $objPHPExcel->getActiveSheet()->getStyle('G8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('H8', '');
        $objPHPExcel->getActiveSheet()->getStyle('H8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('I8', '');
        $objPHPExcel->getActiveSheet()->getStyle('I8')->applyFromArray($styleTabel);

        //ambil data dari model
        $data = $this->rectifier1model->getData($month, $year);

        $c = 9;
        $limit = $c + count($data);

        for ($i=$c; $i < $limit ; $i++) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, date("d-M-y",strtotime($data[$i-$c]['datetime_rectifier1'])));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, date("H:i", strtotime($data[$i-$c]['datetime_rectifier1'])));
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $data[$i-$c]['load_rectifier1']);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $data[$i-$c]['voltage']);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $data[$i-$c]['accupancy']. ' %');
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $data[$i-$c]['autonomi']. ' Menit');
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $data[$i-$c]['alarm_condition']);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, $data[$i-$c]['remark']);
            $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, $data[$i-$c]['fs_name']);
            $objPHPExcel->getActiveSheet()->getStyle('I'.$i)->applyFromArray($styleTabel);
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Rectifier 1');



        // **************************************** Rectifier 2 ****************************************
        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(6);

        // auto size kolom
        foreach (range('A','I') as $i) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }

        //Title page
        $objPHPExcel->getActiveSheet()->mergeCells('A1:I1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DAILY ELECTRICAL WORK CHECKLIST');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:I2');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Customer : PT. TELKOMSEL');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:I3');
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Equipment : Rectifier 2');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:I4');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Location : Power B');
        $objPHPExcel->getActiveSheet()->mergeCells('A5:I5');
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Floor : 7');

        // Heading Tabel
        $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A7:I7')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A7:I7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A8:I8')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A8:I8')->applyFromArray($styleTabel);

        //color heading table
        $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A7:I7')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A8:I8')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );

        // Heading table
        $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Date');
        $objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Time');
        $objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('C6:D6');
        $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Reading - Pembacaan');
        $objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E6', 'Accupancy');
        $objPHPExcel->getActiveSheet()->getStyle('E6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F6', 'Autonomi');
        $objPHPExcel->getActiveSheet()->getStyle('F6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G6', 'Alarm Condition');
        $objPHPExcel->getActiveSheet()->getStyle('G6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('H6', 'Remark');
        $objPHPExcel->getActiveSheet()->getStyle('H6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('I6', 'Name');
        $objPHPExcel->getActiveSheet()->getStyle('I6')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Tanggal');
        $objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Waktu');
        $objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C7', 'Load');
        $objPHPExcel->getActiveSheet()->getStyle('C7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D7', 'Voltage');
        $objPHPExcel->getActiveSheet()->getStyle('D7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E7', '%');
        $objPHPExcel->getActiveSheet()->getStyle('E7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F7', '%');
        $objPHPExcel->getActiveSheet()->getStyle('F7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G7', 'Kondisi Alarm');
        $objPHPExcel->getActiveSheet()->getStyle('G7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('H7', 'Catatan');
        $objPHPExcel->getActiveSheet()->getStyle('H7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('I7', 'Nama');
        $objPHPExcel->getActiveSheet()->getStyle('I7')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A8', '');
        $objPHPExcel->getActiveSheet()->getStyle('A8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B8', '');
        $objPHPExcel->getActiveSheet()->getStyle('B8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C8', '(Amp)');
        $objPHPExcel->getActiveSheet()->getStyle('C8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D8', '(V)');
        $objPHPExcel->getActiveSheet()->getStyle('D8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E8', '');
        $objPHPExcel->getActiveSheet()->getStyle('E8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F8', '');
        $objPHPExcel->getActiveSheet()->getStyle('F8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G8', '');
        $objPHPExcel->getActiveSheet()->getStyle('G8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('H8', '');
        $objPHPExcel->getActiveSheet()->getStyle('H8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('I8', '');
        $objPHPExcel->getActiveSheet()->getStyle('I8')->applyFromArray($styleTabel);

        //ambil data dari model
        $data = $this->rectifier2model->getData($month, $year);

        $c = 9;
        $limit = $c + count($data);

        for ($i=$c; $i < $limit ; $i++) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, date("d-M-y",strtotime($data[$i-$c]['datetime_rectifier2'])));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, date("H:i", strtotime($data[$i-$c]['datetime_rectifier2'])));
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $data[$i-$c]['load_rectifier2']);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $data[$i-$c]['voltage']);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $data[$i-$c]['accupancy']. ' %');
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $data[$i-$c]['autonomi']. ' Menit');
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $data[$i-$c]['alarm_condition']);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, $data[$i-$c]['remark']);
            $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, $data[$i-$c]['fs_name']);
            $objPHPExcel->getActiveSheet()->getStyle('I'.$i)->applyFromArray($styleTabel);
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Rectifier 2');


        // **************************************** Rectifier 3 ****************************************
        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(7);

        // auto size kolom
        foreach (range('A','I') as $i) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }

        //Title page
        $objPHPExcel->getActiveSheet()->mergeCells('A1:I1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DAILY ELECTRICAL WORK CHECKLIST');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:I2');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Customer : PT. TELKOMSEL');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:I3');
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Equipment : Rectifier 3');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:I4');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Location : Battery B');
        $objPHPExcel->getActiveSheet()->mergeCells('A5:I5');
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Floor : 7');

        // Heading Tabel
        $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A7:I7')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A7:I7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A8:I8')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A8:I8')->applyFromArray($styleTabel);

        //color heading table
        $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A7:I7')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A8:I8')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );

        // Heading table
        $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Date');
        $objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Time');
        $objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('C6:D6');
        $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Reading - Pembacaan');
        $objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E6', 'Accupancy');
        $objPHPExcel->getActiveSheet()->getStyle('E6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F6', 'Autonomi');
        $objPHPExcel->getActiveSheet()->getStyle('F6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G6', 'Alarm Condition');
        $objPHPExcel->getActiveSheet()->getStyle('G6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('H6', 'Remark');
        $objPHPExcel->getActiveSheet()->getStyle('H6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('I6', 'Name');
        $objPHPExcel->getActiveSheet()->getStyle('I6')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Tanggal');
        $objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Waktu');
        $objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C7', 'Load');
        $objPHPExcel->getActiveSheet()->getStyle('C7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D7', 'Voltage');
        $objPHPExcel->getActiveSheet()->getStyle('D7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E7', '%');
        $objPHPExcel->getActiveSheet()->getStyle('E7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F7', '%');
        $objPHPExcel->getActiveSheet()->getStyle('F7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G7', 'Kondisi Alarm');
        $objPHPExcel->getActiveSheet()->getStyle('G7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('H7', 'Catatan');
        $objPHPExcel->getActiveSheet()->getStyle('H7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('I7', 'Nama');
        $objPHPExcel->getActiveSheet()->getStyle('I7')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A8', '');
        $objPHPExcel->getActiveSheet()->getStyle('A8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B8', '');
        $objPHPExcel->getActiveSheet()->getStyle('B8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C8', '(Amp)');
        $objPHPExcel->getActiveSheet()->getStyle('C8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D8', '(V)');
        $objPHPExcel->getActiveSheet()->getStyle('D8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E8', '');
        $objPHPExcel->getActiveSheet()->getStyle('E8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F8', '');
        $objPHPExcel->getActiveSheet()->getStyle('F8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G8', '');
        $objPHPExcel->getActiveSheet()->getStyle('G8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('H8', '');
        $objPHPExcel->getActiveSheet()->getStyle('H8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('I8', '');
        $objPHPExcel->getActiveSheet()->getStyle('I8')->applyFromArray($styleTabel);

        //ambil data dari model
        $data = $this->rectifier3model->getData($month, $year);

        $c = 9;
        $limit = $c + count($data);

        for ($i=$c; $i < $limit ; $i++) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, date("d-M-y",strtotime($data[$i-$c]['datetime_rectifier3'])));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, date("H:i", strtotime($data[$i-$c]['datetime_rectifier3'])));
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $data[$i-$c]['load_rectifier3']);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $data[$i-$c]['voltage']);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $data[$i-$c]['accupancy']. '%');
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $data[$i-$c]['autonomi']. 'Menit');
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $data[$i-$c]['alarm_condition']);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, $data[$i-$c]['remark']);
            $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, $data[$i-$c]['fs_name']);
            $objPHPExcel->getActiveSheet()->getStyle('I'.$i)->applyFromArray($styleTabel);
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Rectifier 3');


        // **************************************** Crac Power A 1 ****************************************
        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(8);

        // auto size kolom
        foreach (range('A','G') as $i) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }

        //Title page
        $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DAILY COOLING CRAC WORK CHECKLIST');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Customer : PT. TELKOMSEL');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:G3');
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Equipment : CRAC 1');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:G4');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Location : Power A');
        $objPHPExcel->getActiveSheet()->mergeCells('A5:G5');
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Floor : 7');

        // Heading Tabel
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray($styleTabel);

        //color heading table
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );

        // Heading table
        $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Date');
        $objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Time');
        $objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('C6:D6');
        $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Reading - Pembacaan');
        $objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E6', 'Alarm Condition');
        $objPHPExcel->getActiveSheet()->getStyle('E6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F6', 'Remark');
        $objPHPExcel->getActiveSheet()->getStyle('F6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G6', 'Name');
        $objPHPExcel->getActiveSheet()->getStyle('G6')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Tanggal');
        $objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Jam');
        $objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C7', 'Actual');
        $objPHPExcel->getActiveSheet()->getStyle('C7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D7', 'Relative');
        $objPHPExcel->getActiveSheet()->getStyle('D7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E7', 'Kondisi Alarm');
        $objPHPExcel->getActiveSheet()->getStyle('E7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F7', 'Catatan');
        $objPHPExcel->getActiveSheet()->getStyle('F7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G7', 'Nama');
        $objPHPExcel->getActiveSheet()->getStyle('G7')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A8', '');
        $objPHPExcel->getActiveSheet()->getStyle('A8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B8', '');
        $objPHPExcel->getActiveSheet()->getStyle('B8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C8', 'Temperature (C)');
        $objPHPExcel->getActiveSheet()->getStyle('C8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D8', 'Humidity');
        $objPHPExcel->getActiveSheet()->getStyle('D8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E8', '');
        $objPHPExcel->getActiveSheet()->getStyle('E8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F8', '');
        $objPHPExcel->getActiveSheet()->getStyle('F8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G8', '');
        $objPHPExcel->getActiveSheet()->getStyle('G8')->applyFromArray($styleTabel);

        //ambil data dari model
        $data = $this->poweracrac1model->getData($month, $year);

        $c = 9;
        $limit = $c + count($data);

        for ($i=$c; $i < $limit ; $i++) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, date("d-M-y",strtotime($data[$i-$c]['datetime_poweracrac1'])));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, date("H:i", strtotime($data[$i-$c]['datetime_poweracrac1'])));
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleTabel);

            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $data[$i-$c]['temperature']);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $data[$i-$c]['humidity']);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $data[$i-$c]['alarm_condition']);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $data[$i-$c]['remark']);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $data[$i-$c]['fs_name']);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleTabel);
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Crac Power A 1');


        // **************************************** Crac Power A 2 ****************************************
        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(9);

        // auto size kolom
        foreach (range('A','G') as $i) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }

        //Title page
        $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DAILY COOLING CRAC WORK CHECKLIST');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Customer : PT. TELKOMSEL');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:G3');
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Equipment : CRAC 2');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:G4');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Location : Power A');
        $objPHPExcel->getActiveSheet()->mergeCells('A5:G5');
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Floor : 7');

        // Heading Tabel
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray($styleTabel);

        //color heading table
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );

        // Heading table
        $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Date');
        $objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Time');
        $objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('C6:D6');
        $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Reading - Pembacaan');
        $objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E6', 'Alarm Condition');
        $objPHPExcel->getActiveSheet()->getStyle('E6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F6', 'Remark');
        $objPHPExcel->getActiveSheet()->getStyle('F6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G6', 'Name');
        $objPHPExcel->getActiveSheet()->getStyle('G6')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Tanggal');
        $objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Jam');
        $objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C7', 'Actual');
        $objPHPExcel->getActiveSheet()->getStyle('C7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D7', 'Relative');
        $objPHPExcel->getActiveSheet()->getStyle('D7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E7', 'Kondisi Alarm');
        $objPHPExcel->getActiveSheet()->getStyle('E7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F7', 'Catatan');
        $objPHPExcel->getActiveSheet()->getStyle('F7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G7', 'Nama');
        $objPHPExcel->getActiveSheet()->getStyle('G7')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A8', '');
        $objPHPExcel->getActiveSheet()->getStyle('A8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B8', '');
        $objPHPExcel->getActiveSheet()->getStyle('B8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C8', 'Temperature (C)');
        $objPHPExcel->getActiveSheet()->getStyle('C8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D8', 'Humidity');
        $objPHPExcel->getActiveSheet()->getStyle('D8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E8', '');
        $objPHPExcel->getActiveSheet()->getStyle('E8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F8', '');
        $objPHPExcel->getActiveSheet()->getStyle('F8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G8', '');
        $objPHPExcel->getActiveSheet()->getStyle('G8')->applyFromArray($styleTabel);

        //ambil data dari model
        $data = $this->poweracrac2model->getData($month, $year);

        $c = 9;
        $limit = $c + count($data);

        for ($i=$c; $i < $limit ; $i++) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, date("d-M-y",strtotime($data[$i-$c]['datetime_poweracrac2'])));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, date("H:i", strtotime($data[$i-$c]['datetime_poweracrac2'])));
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleTabel);

            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $data[$i-$c]['temperature']);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $data[$i-$c]['humidity']);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $data[$i-$c]['alarm_condition']);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $data[$i-$c]['remark']);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $data[$i-$c]['fs_name']);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleTabel);
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Crac Power A 2');


        // **************************************** Crac Power B 1 ****************************************
        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(10);

        // auto size kolom
        foreach (range('A','G') as $i) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }

        //Title page
        $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DAILY COOLING CRAC WORK CHECKLIST');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Customer : PT. TELKOMSEL');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:G3');
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Equipment : CRAC 1');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:G4');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Location : Power B');
        $objPHPExcel->getActiveSheet()->mergeCells('A5:G5');
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Floor : 7');

        // Heading Tabel
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray($styleTabel);

        //color heading table
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );

        // Heading table
        $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Date');
        $objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Time');
        $objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('C6:D6');
        $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Reading - Pembacaan');
        $objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E6', 'Alarm Condition');
        $objPHPExcel->getActiveSheet()->getStyle('E6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F6', 'Remark');
        $objPHPExcel->getActiveSheet()->getStyle('F6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G6', 'Name');
        $objPHPExcel->getActiveSheet()->getStyle('G6')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Tanggal');
        $objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Jam');
        $objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C7', 'Actual');
        $objPHPExcel->getActiveSheet()->getStyle('C7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D7', 'Relative');
        $objPHPExcel->getActiveSheet()->getStyle('D7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E7', 'Kondisi Alarm');
        $objPHPExcel->getActiveSheet()->getStyle('E7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F7', 'Catatan');
        $objPHPExcel->getActiveSheet()->getStyle('F7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G7', 'Nama');
        $objPHPExcel->getActiveSheet()->getStyle('G7')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A8', '');
        $objPHPExcel->getActiveSheet()->getStyle('A8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B8', '');
        $objPHPExcel->getActiveSheet()->getStyle('B8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C8', 'Temperature (C)');
        $objPHPExcel->getActiveSheet()->getStyle('C8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D8', 'Humidity');
        $objPHPExcel->getActiveSheet()->getStyle('D8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E8', '');
        $objPHPExcel->getActiveSheet()->getStyle('E8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F8', '');
        $objPHPExcel->getActiveSheet()->getStyle('F8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G8', '');
        $objPHPExcel->getActiveSheet()->getStyle('G8')->applyFromArray($styleTabel);

        //ambil data dari model
        $data = $this->powerbcrac1model->getData($month, $year);

        $c = 9;
        $limit = $c + count($data);

        for ($i=$c; $i < $limit ; $i++) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, date("d-M-y",strtotime($data[$i-$c]['datetime_powerbcrac1'])));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, date("H:i", strtotime($data[$i-$c]['datetime_powerbcrac1'])));
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleTabel);

            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $data[$i-$c]['temperature']);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $data[$i-$c]['humidity']);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $data[$i-$c]['alarm_condition']);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $data[$i-$c]['remark']);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $data[$i-$c]['fs_name']);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleTabel);
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Crac Power B 1');


        // **************************************** Crac Battery A 1 ****************************************
        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(11);

        // auto size kolom
        foreach (range('A','G') as $i) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }

        //Title page
        $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DAILY COOLING CRAC WORK CHECKLIST');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Customer : PT. TELKOMSEL');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:G3');
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Equipment : CRAC 1');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:G4');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Location : Battery A');
        $objPHPExcel->getActiveSheet()->mergeCells('A5:G5');
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Floor : 7');

        // Heading Tabel
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray($styleTabel);

        //color heading table
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );

        // Heading table
        $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Date');
        $objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Time');
        $objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('C6:D6');
        $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Reading - Pembacaan');
        $objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E6', 'Alarm Condition');
        $objPHPExcel->getActiveSheet()->getStyle('E6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F6', 'Remark');
        $objPHPExcel->getActiveSheet()->getStyle('F6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G6', 'Name');
        $objPHPExcel->getActiveSheet()->getStyle('G6')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Tanggal');
        $objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Jam');
        $objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C7', 'Actual');
        $objPHPExcel->getActiveSheet()->getStyle('C7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D7', 'Relative');
        $objPHPExcel->getActiveSheet()->getStyle('D7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E7', 'Kondisi Alarm');
        $objPHPExcel->getActiveSheet()->getStyle('E7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F7', 'Catatan');
        $objPHPExcel->getActiveSheet()->getStyle('F7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G7', 'Nama');
        $objPHPExcel->getActiveSheet()->getStyle('G7')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A8', '');
        $objPHPExcel->getActiveSheet()->getStyle('A8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B8', '');
        $objPHPExcel->getActiveSheet()->getStyle('B8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C8', 'Temperature (C)');
        $objPHPExcel->getActiveSheet()->getStyle('C8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D8', 'Humidity');
        $objPHPExcel->getActiveSheet()->getStyle('D8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E8', '');
        $objPHPExcel->getActiveSheet()->getStyle('E8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F8', '');
        $objPHPExcel->getActiveSheet()->getStyle('F8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G8', '');
        $objPHPExcel->getActiveSheet()->getStyle('G8')->applyFromArray($styleTabel);

        //ambil data dari model
        $data = $this->batteryacrac1model->getData($month, $year);

        $c = 9;
        $limit = $c + count($data);

        for ($i=$c; $i < $limit ; $i++) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, date("d-M-y",strtotime($data[$i-$c]['datetime_batteryacrac1'])));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, date("H:i", strtotime($data[$i-$c]['datetime_batteryacrac1'])));
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleTabel);

            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $data[$i-$c]['temperature']);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $data[$i-$c]['humidity']);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $data[$i-$c]['alarm_condition']);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $data[$i-$c]['remark']);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $data[$i-$c]['fs_name']);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleTabel);
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Crac Battery A 1');


        // **************************************** Crac Battery A 2 ****************************************
        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(12);

        // auto size kolom
        foreach (range('A','G') as $i) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }

        //Title page
        $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DAILY COOLING CRAC WORK CHECKLIST');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Customer : PT. TELKOMSEL');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:G3');
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Equipment : CRAC 2');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:G4');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Location : Battery A');
        $objPHPExcel->getActiveSheet()->mergeCells('A5:G5');
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Floor : 7');

        // Heading Tabel
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray($styleTabel);

        //color heading table
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );

        // Heading table
        $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Date');
        $objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Time');
        $objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('C6:D6');
        $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Reading - Pembacaan');
        $objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E6', 'Alarm Condition');
        $objPHPExcel->getActiveSheet()->getStyle('E6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F6', 'Remark');
        $objPHPExcel->getActiveSheet()->getStyle('F6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G6', 'Name');
        $objPHPExcel->getActiveSheet()->getStyle('G6')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Tanggal');
        $objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Jam');
        $objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C7', 'Actual');
        $objPHPExcel->getActiveSheet()->getStyle('C7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D7', 'Relative');
        $objPHPExcel->getActiveSheet()->getStyle('D7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E7', 'Kondisi Alarm');
        $objPHPExcel->getActiveSheet()->getStyle('E7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F7', 'Catatan');
        $objPHPExcel->getActiveSheet()->getStyle('F7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G7', 'Nama');
        $objPHPExcel->getActiveSheet()->getStyle('G7')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A8', '');
        $objPHPExcel->getActiveSheet()->getStyle('A8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B8', '');
        $objPHPExcel->getActiveSheet()->getStyle('B8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C8', 'Temperature (C)');
        $objPHPExcel->getActiveSheet()->getStyle('C8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D8', 'Humidity');
        $objPHPExcel->getActiveSheet()->getStyle('D8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E8', '');
        $objPHPExcel->getActiveSheet()->getStyle('E8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F8', '');
        $objPHPExcel->getActiveSheet()->getStyle('F8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G8', '');
        $objPHPExcel->getActiveSheet()->getStyle('G8')->applyFromArray($styleTabel);

        //ambil data dari model
        $data = $this->batteryacrac2model->getData($month, $year);

        $c = 9;
        $limit = $c + count($data);

        for ($i=$c; $i < $limit ; $i++) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, date("d-M-y",strtotime($data[$i-$c]['datetime_batteryacrac2'])));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, date("H:i", strtotime($data[$i-$c]['datetime_batteryacrac2'])));
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleTabel);

            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $data[$i-$c]['temperature']);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $data[$i-$c]['humidity']);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $data[$i-$c]['alarm_condition']);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $data[$i-$c]['remark']);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $data[$i-$c]['fs_name']);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleTabel);
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Crac Battery A 2');


        // **************************************** Crac Battery B 1 ****************************************
        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(13);

        // auto size kolom
        foreach (range('A','G') as $i) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }

        //Title page
        $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DAILY COOLING CRAC WORK CHECKLIST');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Customer : PT. TELKOMSEL');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:G3');
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Equipment : CRAC 1');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:G4');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Location : Battery B');
        $objPHPExcel->getActiveSheet()->mergeCells('A5:G5');
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Floor : 7');

        // Heading Tabel
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray($styleTabel);

        //color heading table
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );

        // Heading table
        $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Date');
        $objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Time');
        $objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('C6:D6');
        $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Reading - Pembacaan');
        $objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E6', 'Alarm Condition');
        $objPHPExcel->getActiveSheet()->getStyle('E6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F6', 'Remark');
        $objPHPExcel->getActiveSheet()->getStyle('F6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G6', 'Name');
        $objPHPExcel->getActiveSheet()->getStyle('G6')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Tanggal');
        $objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Jam');
        $objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C7', 'Actual');
        $objPHPExcel->getActiveSheet()->getStyle('C7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D7', 'Relative');
        $objPHPExcel->getActiveSheet()->getStyle('D7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E7', 'Kondisi Alarm');
        $objPHPExcel->getActiveSheet()->getStyle('E7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F7', 'Catatan');
        $objPHPExcel->getActiveSheet()->getStyle('F7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G7', 'Nama');
        $objPHPExcel->getActiveSheet()->getStyle('G7')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A8', '');
        $objPHPExcel->getActiveSheet()->getStyle('A8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B8', '');
        $objPHPExcel->getActiveSheet()->getStyle('B8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C8', 'Temperature (C)');
        $objPHPExcel->getActiveSheet()->getStyle('C8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D8', 'Humidity');
        $objPHPExcel->getActiveSheet()->getStyle('D8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E8', '');
        $objPHPExcel->getActiveSheet()->getStyle('E8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F8', '');
        $objPHPExcel->getActiveSheet()->getStyle('F8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G8', '');
        $objPHPExcel->getActiveSheet()->getStyle('G8')->applyFromArray($styleTabel);

        //ambil data dari model
        $data = $this->batterybcrac1model->getData($month, $year);

        $c = 9;
        $limit = $c + count($data);

        for ($i=$c; $i < $limit ; $i++) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, date("d-M-y",strtotime($data[$i-$c]['datetime_batterybcrac1'])));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, date("H:i", strtotime($data[$i-$c]['datetime_batterybcrac1'])));
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleTabel);

            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $data[$i-$c]['temperature']);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $data[$i-$c]['humidity']);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $data[$i-$c]['alarm_condition']);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $data[$i-$c]['remark']);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $data[$i-$c]['fs_name']);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleTabel);
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Crac Battery B 1');


        // **************************************** Crac DC 1 ****************************************
        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(14);

        // auto size kolom
        foreach (range('A','G') as $i) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }

        //Title page
        $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DAILY COOLING CRAC WORK CHECKLIST');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Customer : PT. TELKOMSEL');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:G3');
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Equipment : CRAC 1');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:G4');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Location : Data Center');
        $objPHPExcel->getActiveSheet()->mergeCells('A5:G5');
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Floor : 7');

        // Heading Tabel
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray($styleTabel);

        //color heading table
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );

        // Heading table
        $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Date');
        $objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Time');
        $objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('C6:D6');
        $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Reading - Pembacaan');
        $objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E6', 'Alarm Condition');
        $objPHPExcel->getActiveSheet()->getStyle('E6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F6', 'Remark');
        $objPHPExcel->getActiveSheet()->getStyle('F6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G6', 'Name');
        $objPHPExcel->getActiveSheet()->getStyle('G6')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Tanggal');
        $objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Jam');
        $objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C7', 'Actual');
        $objPHPExcel->getActiveSheet()->getStyle('C7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D7', 'Relative');
        $objPHPExcel->getActiveSheet()->getStyle('D7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E7', 'Kondisi Alarm');
        $objPHPExcel->getActiveSheet()->getStyle('E7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F7', 'Catatan');
        $objPHPExcel->getActiveSheet()->getStyle('F7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G7', 'Nama');
        $objPHPExcel->getActiveSheet()->getStyle('G7')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A8', '');
        $objPHPExcel->getActiveSheet()->getStyle('A8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B8', '');
        $objPHPExcel->getActiveSheet()->getStyle('B8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C8', 'Temperature (C)');
        $objPHPExcel->getActiveSheet()->getStyle('C8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D8', 'Humidity');
        $objPHPExcel->getActiveSheet()->getStyle('D8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E8', '');
        $objPHPExcel->getActiveSheet()->getStyle('E8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F8', '');
        $objPHPExcel->getActiveSheet()->getStyle('F8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G8', '');
        $objPHPExcel->getActiveSheet()->getStyle('G8')->applyFromArray($styleTabel);

        //ambil data dari model
        $data = $this->dccrac1model->getData($month, $year);

        $c = 9;
        $limit = $c + count($data);

        for ($i=$c; $i < $limit ; $i++) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, date("d-M-y",strtotime($data[$i-$c]['datetime_dccrac1'])));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, date("H:i", strtotime($data[$i-$c]['datetime_dccrac1'])));
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleTabel);

            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $data[$i-$c]['temperature']);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $data[$i-$c]['humidity']);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $data[$i-$c]['alarm_condition']);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $data[$i-$c]['remark']);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $data[$i-$c]['fs_name']);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleTabel);
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Crac DC 1');


        // **************************************** Crac DC 2 ****************************************
        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(15);

        // auto size kolom
        foreach (range('A','G') as $i) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }

        //Title page
        $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DAILY COOLING CRAC WORK CHECKLIST');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Customer : PT. TELKOMSEL');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:G3');
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Equipment : CRAC 2');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:G4');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Location : Data Center');
        $objPHPExcel->getActiveSheet()->mergeCells('A5:G5');
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Floor : 7');

        // Heading Tabel
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray($styleTabel);

        //color heading table
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );

        // Heading table
        $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Date');
        $objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Time');
        $objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('C6:D6');
        $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Reading - Pembacaan');
        $objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E6', 'Alarm Condition');
        $objPHPExcel->getActiveSheet()->getStyle('E6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F6', 'Remark');
        $objPHPExcel->getActiveSheet()->getStyle('F6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G6', 'Name');
        $objPHPExcel->getActiveSheet()->getStyle('G6')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Tanggal');
        $objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Jam');
        $objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C7', 'Actual');
        $objPHPExcel->getActiveSheet()->getStyle('C7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D7', 'Relative');
        $objPHPExcel->getActiveSheet()->getStyle('D7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E7', 'Kondisi Alarm');
        $objPHPExcel->getActiveSheet()->getStyle('E7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F7', 'Catatan');
        $objPHPExcel->getActiveSheet()->getStyle('F7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G7', 'Nama');
        $objPHPExcel->getActiveSheet()->getStyle('G7')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A8', '');
        $objPHPExcel->getActiveSheet()->getStyle('A8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B8', '');
        $objPHPExcel->getActiveSheet()->getStyle('B8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C8', 'Temperature (C)');
        $objPHPExcel->getActiveSheet()->getStyle('C8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D8', 'Humidity');
        $objPHPExcel->getActiveSheet()->getStyle('D8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E8', '');
        $objPHPExcel->getActiveSheet()->getStyle('E8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F8', '');
        $objPHPExcel->getActiveSheet()->getStyle('F8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G8', '');
        $objPHPExcel->getActiveSheet()->getStyle('G8')->applyFromArray($styleTabel);

        //ambil data dari model
        $data = $this->dccrac2model->getData($month, $year);

        $c = 9;
        $limit = $c + count($data);

        for ($i=$c; $i < $limit ; $i++) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, date("d-M-y",strtotime($data[$i-$c]['datetime_dccrac2'])));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, date("H:i", strtotime($data[$i-$c]['datetime_dccrac2'])));
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $data[$i-$c]['temperature']);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $data[$i-$c]['humidity']);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $data[$i-$c]['alarm_condition']);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $data[$i-$c]['remark']);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $data[$i-$c]['fs_name']);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleTabel);
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Crac DC 2');


        // **************************************** Crac DC 3 ****************************************
        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(16);

        // auto size kolom
        foreach (range('A','G') as $i) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }

        //Title page
        $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DAILY COOLING CRAC WORK CHECKLIST');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);
        $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Customer : PT. TELKOMSEL');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:G3');
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Equipment : CRAC 3');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:G4');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Location : Data Center');
        $objPHPExcel->getActiveSheet()->mergeCells('A5:G5');
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Floor : 7');

        // Heading Tabel
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray($styleTabel);

        //color heading table
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );

        // Heading table
        $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Date');
        $objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Time');
        $objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('C6:D6');
        $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Reading - Pembacaan');
        $objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E6', 'Alarm Condition');
        $objPHPExcel->getActiveSheet()->getStyle('E6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F6', 'Remark');
        $objPHPExcel->getActiveSheet()->getStyle('F6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G6', 'Name');
        $objPHPExcel->getActiveSheet()->getStyle('G6')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Tanggal');
        $objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Jam');
        $objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C7', 'Actual');
        $objPHPExcel->getActiveSheet()->getStyle('C7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D7', 'Relative');
        $objPHPExcel->getActiveSheet()->getStyle('D7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E7', 'Kondisi Alarm');
        $objPHPExcel->getActiveSheet()->getStyle('E7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F7', 'Catatan');
        $objPHPExcel->getActiveSheet()->getStyle('F7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G7', 'Nama');
        $objPHPExcel->getActiveSheet()->getStyle('G7')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A8', '');
        $objPHPExcel->getActiveSheet()->getStyle('A8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B8', '');
        $objPHPExcel->getActiveSheet()->getStyle('B8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C8', 'Temperature (C)');
        $objPHPExcel->getActiveSheet()->getStyle('C8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D8', 'Humidity');
        $objPHPExcel->getActiveSheet()->getStyle('D8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E8', '');
        $objPHPExcel->getActiveSheet()->getStyle('E8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F8', '');
        $objPHPExcel->getActiveSheet()->getStyle('F8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G8', '');
        $objPHPExcel->getActiveSheet()->getStyle('G8')->applyFromArray($styleTabel);

        //ambil data dari model
        $data = $this->dccrac3model->getData($month, $year);

        $c = 9;
        $limit = $c + count($data);

        for ($i=$c; $i < $limit ; $i++) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, date("d-M-y",strtotime($data[$i-$c]['datetime_dccrac3'])));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, date("H:i", strtotime($data[$i-$c]['datetime_dccrac3'])));
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $data[$i-$c]['temperature']);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $data[$i-$c]['humidity']);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $data[$i-$c]['alarm_condition']);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $data[$i-$c]['remark']);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $data[$i-$c]['fs_name']);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleTabel);
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Crac DC 3');



        // **************************************** Crac DC 4 ****************************************
        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(17);

        // auto size kolom
        foreach (range('A','G') as $i) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }

        //Title page
        $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DAILY COOLING CRAC WORK CHECKLIST');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Customer : PT. TELKOMSEL');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:G3');
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Equipment : CRAC 4');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:G4');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Location : Data Center');
        $objPHPExcel->getActiveSheet()->mergeCells('A5:G5');
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Floor : 7');

        // Heading Tabel
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray($styleTabel);

        //color heading table
        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A8:G8')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );

        // Heading table
        $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Date');
        $objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Time');
        $objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->mergeCells('C6:D6');
        $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Reading - Pembacaan');
        $objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E6', 'Alarm Condition');
        $objPHPExcel->getActiveSheet()->getStyle('E6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F6', 'Remark');
        $objPHPExcel->getActiveSheet()->getStyle('F6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G6', 'Name');
        $objPHPExcel->getActiveSheet()->getStyle('G6')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Tanggal');
        $objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Jam');
        $objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C7', 'Actual');
        $objPHPExcel->getActiveSheet()->getStyle('C7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D7', 'Relative');
        $objPHPExcel->getActiveSheet()->getStyle('D7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E7', 'Kondisi Alarm');
        $objPHPExcel->getActiveSheet()->getStyle('E7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F7', 'Catatan');
        $objPHPExcel->getActiveSheet()->getStyle('F7')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G7', 'Nama');
        $objPHPExcel->getActiveSheet()->getStyle('G7')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A8', '');
        $objPHPExcel->getActiveSheet()->getStyle('A8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B8', '');
        $objPHPExcel->getActiveSheet()->getStyle('B8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C8', 'Temperature (C)');
        $objPHPExcel->getActiveSheet()->getStyle('C8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D8', 'Humidity');
        $objPHPExcel->getActiveSheet()->getStyle('D8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E8', '');
        $objPHPExcel->getActiveSheet()->getStyle('E8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F8', '');
        $objPHPExcel->getActiveSheet()->getStyle('F8')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G8', '');
        $objPHPExcel->getActiveSheet()->getStyle('G8')->applyFromArray($styleTabel);

        //ambil data dari model
        $data = $this->dccrac4model->getData($month, $year);

        $c = 9;
        $limit = $c + count($data);

        for ($i=$c; $i < $limit ; $i++) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, date("d-M-y",strtotime($data[$i-$c]['datetime_dccrac4'])));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, date("H:i", strtotime($data[$i-$c]['datetime_dccrac4'])));
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $data[$i-$c]['temperature']);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $data[$i-$c]['humidity']);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $data[$i-$c]['alarm_condition']);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $data[$i-$c]['remark']);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $data[$i-$c]['fs_name']);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleTabel);
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Crac DC 4');


        // **************************************** Cooling Tower ****************************************
        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(18);

        // auto size kolom
        foreach (range('A','H') as $i) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }

        //Title page
        $objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DAILY COOLING TOWER WORK CHECKLIST');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Customer : PT. TELKOMSEL');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:H3');
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Equipment : Cooling Tower');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:H4');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Floor : B2 & Rooftop');

        // Heading Tabel
        $objPHPExcel->getActiveSheet()->getStyle('A5:H5')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A5:H5')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A6:H6')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A6:H6')->applyFromArray($styleTabel);

        //color heading table
        $objPHPExcel->getActiveSheet()->getStyle('A5:H5')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A6:H6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );

        // Heading table
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Date');
        $objPHPExcel->getActiveSheet()->getStyle('A5')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B5', 'Time');
        $objPHPExcel->getActiveSheet()->getStyle('B5')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C5', 'Motor Cooling Tower');
        $objPHPExcel->getActiveSheet()->getStyle('C5')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D5', 'Pump Cooling Tower');
        $objPHPExcel->getActiveSheet()->getStyle('D5')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E5', 'Meter Cooling Tower');
        $objPHPExcel->getActiveSheet()->getStyle('E5')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F5', 'Water Supply Pump');
        $objPHPExcel->getActiveSheet()->getStyle('F5')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G5', 'Remark');
        $objPHPExcel->getActiveSheet()->getStyle('G5')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('H5', 'Name');
        $objPHPExcel->getActiveSheet()->getStyle('H5')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Tanggal');
        $objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Jam');
        $objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C6', '');
        $objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D6', '');
        $objPHPExcel->getActiveSheet()->getStyle('D6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E6', 'm3');
        $objPHPExcel->getActiveSheet()->getStyle('E6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F6', '');
        $objPHPExcel->getActiveSheet()->getStyle('F6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G6', 'Catatan');
        $objPHPExcel->getActiveSheet()->getStyle('G6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('H6', 'Nama');
        $objPHPExcel->getActiveSheet()->getStyle('H6')->applyFromArray($styleTabel);

        //ambil data dari model
        $data = $this->coolingtowermodel->getData($month, $year);

        $c = 7;
        $limit = $c + count($data);

        for ($i=$c; $i < $limit ; $i++) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, date("d-M-y",strtotime($data[$i-$c]['datetime_coolingtower'])));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, date("H:i", strtotime($data[$i-$c]['datetime_coolingtower'])));
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $data[$i-$c]['motor_cooling']);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $data[$i-$c]['pump_cooling']);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $data[$i-$c]['meter_cooling']);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $data[$i-$c]['water_supply']);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $data[$i-$c]['remark']);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, $data[$i-$c]['fs_name']);
            $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->applyFromArray($styleTabel);
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Cooling Tower');


        // **************************************** Genset ****************************************
        $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(19);

        // auto size kolom
        foreach (range('A','I') as $i) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }

        //Title page
        $objPHPExcel->getActiveSheet()->mergeCells('A1:I1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'RUNNING GENSET WORK CHECKLIST');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);

        $objPHPExcel->getActiveSheet()->mergeCells('A2:I2');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Customer : PT. TELKOMSEL');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:I3');
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Equipment : Genset');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:I4');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Floor : B1');

        // Heading Tabel
        $objPHPExcel->getActiveSheet()->getStyle('A5:I5')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A5:I5')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->applyFromArray($theadStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->applyFromArray($styleTabel);

        //color heading table
        $objPHPExcel->getActiveSheet()->getStyle('A5:I5')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B0ECF8')
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );

        // Heading table
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Date');
        $objPHPExcel->getActiveSheet()->getStyle('A5')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B5', 'Time');
        $objPHPExcel->getActiveSheet()->getStyle('B5')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C5', 'Start (s)');
        $objPHPExcel->getActiveSheet()->getStyle('C5')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D5', 'Engine Runtime');
        $objPHPExcel->getActiveSheet()->getStyle('D5')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E5', 'Battrey Voltage');
        $objPHPExcel->getActiveSheet()->getStyle('E5')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F5', 'Solar Harian');
        $objPHPExcel->getActiveSheet()->getStyle('F5')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G5', 'Solar Cadangan');
        $objPHPExcel->getActiveSheet()->getStyle('G5')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('H5', 'Total Solar');
        $objPHPExcel->getActiveSheet()->getStyle('H5')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('I5', 'Remark');
        $objPHPExcel->getActiveSheet()->getStyle('I5')->applyFromArray($styleTabel);

        $objPHPExcel->getActiveSheet()->SetCellValue('A6', '');
        $objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', '');
        $objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('C6', '');
        $objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('D6', '');
        $objPHPExcel->getActiveSheet()->getStyle('D6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('E6', '(Volt.)');
        $objPHPExcel->getActiveSheet()->getStyle('E6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('F6', '(L)');
        $objPHPExcel->getActiveSheet()->getStyle('F6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('G6', '(L)');
        $objPHPExcel->getActiveSheet()->getStyle('G6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('H6', '(L)');
        $objPHPExcel->getActiveSheet()->getStyle('H6')->applyFromArray($styleTabel);
        $objPHPExcel->getActiveSheet()->SetCellValue('I6', '');
        $objPHPExcel->getActiveSheet()->getStyle('I6')->applyFromArray($styleTabel);

        //ambil data dari model
        $data = $this->gensetmodel->getData($month, $year);


        $c = 7;
        $limit = $c + count($data);

        for ($i=$c; $i < $limit ; $i++) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, date("d-M-y",strtotime($data[$i-$c]['datetime_genset'])));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, date("H:i", strtotime($data[$i-$c]['datetime_genset'])));
            $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $data[$i-$c]['start']);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $data[$i-$c]['runtime_hour'].' H '.$data[$i-$c]['runtime_minute'].' m');
            $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $data[$i-$c]['battery_voltage']);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $data[$i-$c]['solar_harian']);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $data[$i-$c]['solar_cadangan']);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, $data[$i-$c]['solar_harian']+$data[$i-$c]['solar_cadangan']);
            $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->applyFromArray($styleTabel);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, $data[$i-$c]['remark']);
            $objPHPExcel->getActiveSheet()->getStyle('I'.$i)->applyFromArray($styleTabel);
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Genset');

        $bulan = array(1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

        $namabulan = $bulan[$month];

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Checklist '.$namabulan.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

}
