<?php

    class Absensi extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
            $this->load->model('ModelUsers');
            $this->load->model('ModelAbsensi');
        }

        public function startAbsensi(){
            $date = date('Y-m-d');
            $data_pegawai = $this->ModelUsers->getDataKaryawanVerified(1);
            foreach($data_pegawai as $value){
                $data = array([
                    'id_users'  => $value['id_users'],
                    'date'      => $date,
                    'status'    => 'Tidak' 
                ]);

                $this->ModelAbsensi->insertAbsensiAll($data);
            }
            $this->session->set_flashdata('toastr', "toastr");
            $this->session->set_flashdata('text_toastr', 'Absensi hari ini berhasil dimulai');
            $this->session->set_flashdata('type_toastr', 'success');
            redirect(base_url('dashboard/'));
        }
    }