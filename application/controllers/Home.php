<?php 

    class Home extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
            $this->load->model('ModelShift');
            $this->load->model('ModelJabatan');
            $this->load->model('ModelUsers');
        }

        public function list_pegawai(){
            $data= array(
                "breadcumb"     => "Data Karyawan",
                "title"         => "Data Karyawan - PT. Vinita",
                "data_karyawan" => $this->ModelUsers->getDataKaryawanVerified(1),
            );
               
            $this->load->view('layout/header',$data);
            $this->load->view('layout/sidebar');
            $this->load->view('layout/navbar');
            $this->load->view('data/pegawai/list_pegawai',$data);
            $this->load->view('layout/footer');
        }

        public function list_shift(){
            $data= array(
                "breadcumb"     => "Data Shift",
                "title"         => "Data Shift - PT. Vinita",
                "data_shift"    => $this->ModelShift->getDataShift(),
                "shift_active"  => "active",
            );
            $this->load->view('layout/header',$data);
            $this->load->view('layout/sidebar',$data);
            $this->load->view('layout/navbar');
            $this->load->view('data/shift/shift_page',$data);
            $this->load->view('layout/footer');
        }

        public function list_jabatan(){
            $data= array(
                "breadcumb"     => "Data Jabatan",
                "title"         => "Data Jabatan - PT. Vinita",
                "data_jabatan"  => $this->ModelJabatan->readDataJabatan(),
                "jabatan_active"    => "active"
            );
               
            $this->load->view('layout/header',$data);
            $this->load->view('layout/sidebar');
            $this->load->view('layout/navbar');
            $this->load->view('data/jabatan/list_jabatan',$data);
            $this->load->view('layout/footer');
     
        }
    }

?>