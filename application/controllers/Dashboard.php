<?php

    class Dashboard extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
            if($this->session->userdata('login_admin') == true || $this->session->userdata('login_pegawai') == true){
                
            }else{
                redirect(base_url('login'));
            }
            $this->load->model('ModelUsers');
            $this->load->model('ModelShift');
            $this->load->model('ModelJabatan');
        }

        public function index(){
            $data= array(
                "breadcumb"     => "Data Shift",
                "title"         => "Dashboard - PT. Vinita",
                "shift_index"   => "active",
            );
            $this->load->view('layout/header',$data);
            $this->load->view('layout/sidebar');
            $this->load->view('layout/navbar');
            $this->load->view('dashboard/index');
            $this->load->view('layout/footer');
        }

        // public function list_shift(){
        //     $data= array(
        //         "breadcumb"     => "Data Shift",
        //         "title"         => "Data Shift - PT. Vinita",
        //         "data_shift"    => $this->ModelShift->getDataShift(),
        //         "shift_active"  => "active",
        //     );
        //     $this->load->view('layout/header',$data);
        //     $this->load->view('layout/sidebar',$data);
        //     $this->load->view('layout/navbar');
        //     $this->load->view('data/shift/list_shift',$data);
        //     $this->load->view('layout/footer');
        // }

        public function list_karyawan_not_verified(){
            $data= array(
                "breadcumb"     => "Data Karyawan",
                "title"         => "Data Karyawan - PT. Vinita",
                "data_karyawan" => $this->ModelUsers->getDataKaryawanNotVerified(0),
                "data_shift"    => $this->ModelShift->getDataShift(),
                "data_jabatan" => $this->ModelJabatan->readDataJabatan()
            );
            
            $this->load->view('layout/header',$data);
            $this->load->view('layout/topbar');
            $this->load->view('layout/left_sidebar');
            $this->load->view('layout/right_sidebar');
            $this->load->view('data/pegawai/list_pegawai_not',$data);
            $this->load->view('layout/footer');
        }

        public function list_karyawan(){
            $data= array(
                "breadcumb"     => "Data Karyawan",
                "title"         => "Data Karyawan - PT. Vinita",
                "data_karyawan" => $this->ModelUsers->getDataKaryawanVerified(1),
            );
               
            $this->load->view('layout/header',$data);
            $this->load->view('layout/topbar');
            $this->load->view('layout/left_sidebar');
            $this->load->view('layout/right_sidebar');
            $this->load->view('data/pegawai/list_pegawai',$data);
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
            $this->load->view('layout/footer');
        }
    }