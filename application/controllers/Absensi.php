<?php

    class Absensi extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
            $this->load->model('ModelUsers');
            $this->load->model('ModelAbsensi');
            $this->load->model('ModelSurat');
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
            $getDataAbsensi = $this->db->get_where('tb_absensi',array('date' => $date))->result_array();
                foreach($getDataAbsensi as $gda){
                    $addUangMakan = array([
                        'nominal'       => 0,
                        'tanggal'       => $date,
                        'id_users'      => $gda['id_users'],
                        'id_absensi'    => $gda['id_absensi']
                        ]
                    );
                    $this->ModelAbsensi->addUangMakanBatch($addUangMakan);
                }
            $this->session->set_flashdata('toastr', "toastr");
            $this->session->set_flashdata('text_toastr', 'Absensi hari ini berhasil dimulai');
            $this->session->set_flashdata('type_toastr', 'success');
            redirect(base_url('dashboard/'));
        }

        public function changeStatusIzin(){
            $id_absensi = $this->uri->segment(3);
            $date = $this->uri->segment(4);
            $id_users = $this->uri->segment(5);
            if($id_absensi != null){
                $changeAbsensi = array(
                    'status'    => "Izin",
                );

                $changeSuratIzin = array(
                    'status_surat'  => 1
                );

                
                $this->ModelAbsensi->updateAbsensi($changeAbsensi,$id_users,$date);
                $this->ModelSurat->updateData($changeSuratIzin,$id_absensi);
                $this->session->set_flashdata('icon', 'success');
                $this->session->set_flashdata('text', 'Surat Izin berhasil dikonfirmasi');
                $this->session->set_flashdata('title', 'Konfirmasi Sukses !');
                redirect(base_url('home/surat_izin'));
            }else{
                redirect(base_url('home/surat_izin'));
            }
        }
    }