<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Excel extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('upload','PHPExcel','PHPExcel/IOFactory'));
        $this->load->helper('file');
    }
    public function index()
    {
        $this->load->view('excel');
    }
    public function upload(){
        $fileName = time().$_FILES['file']['name'];

         
        $config['upload_path'] = './assets/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 100000;
         
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();
             
        $media = $this->upload->data('file');
        $inputFileName = './assets/'.$fileName;

        // dd($_FILES);
        try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            // posisi sheet pada file excel
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
             
            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                                                 
                //Sesuaikan sama nama kolom tabel di database                                
                 $data = array(
                    "datetime_coolingtower"           => $rowData[0][0],
                    "shift"           => $rowData[0][1],
                    "motor_cooling"              => $rowData[0][2],
                    "pump_cooling"              => $rowData[0][3],
                    "meter_cooling"             => $rowData[0][4],
                    "water_supply"             => $rowData[0][5],
                    "remark"         => $rowData[0][6],
                    "fs_name"         => $rowData[0][7]
                    );



                //sesuaikan nama dengan nama tabel
                $insert = $this->db->insert('coolingtower',$data);
                // unlink('./assets/'.$fileName);
                     
            }
        redirect('excel/');
    }
}