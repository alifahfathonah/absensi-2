<?php

use chriskacerguis\RestServer\RestController;

require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

class Surat extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelAbsensi');
        $this->load->model('ModelSurat');
    }

    public function getDataSuratIzin_post(){
        $id_pegawai = $this->input->post('id_users');
        $data_users = $this->db->get_where('tb_users', array('no_pegawai' => $id_pegawai))->row_array();
        $id_users = $data_users['id_users'];

        $getDataIzin = $this->ModelSurat->getAllDataSuratIzinByIdUsers($id_users);

        $this->response([
            'data_suratizin' => $getDataIzin,
            'status'         => true
        ],200);
    }

    public function addSuratIzin_post()
    {
        $id_pegawai = $this->input->post('id_users');
        $data_users = $this->db->get_where('tb_users', array('no_pegawai' => $id_pegawai))->row_array();
        $id_users = $data_users['id_users'];
        $bukti =  $_FILES['image']['name'];
        $date = date('Y-m-d');
        $alasan = $this->input->post('alasan');

        if ($id_users != null && $alasan != null) {
            $config['upload_path']          = './assets/image_surat/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';

            $this->upload->initialize($config);
            $getDataAbsensi = $this->ModelAbsensi->getDataAbsensiByIdUsers($id_users, $date);
            if ($getDataAbsensi != null) {
                $getDataIzin = $this->ModelSurat->getDataIzinByIdUsers($id_users, $date);

                if ($getDataIzin == null) {
                    if ($this->upload->do_upload('image')) {
                        $id_absensi = $getDataAbsensi['id_absensi'];
                        $data = array(
                            'tanggal'   => $date,
                            'alasan'    => $alasan,
                            'bukti'     => $bukti,
                            'id_users'  => $id_users,
                            'id_absensi'    => $id_absensi
                        );

                        $this->ModelSurat->addSuratIzin($data);
                        $this->response([
                            'message'   => "Permohonan izin sudah tersimpan, Silahkan tunggu konfirmasi selanjutnya",
                            'status'    =>  true
                        ], 200);
                    }
                } else {
                    $this->response([
                        'message'   => "Mohon maaf, anda hanya bisa mengajukan permohonan sekali dalam sehari !",
                        'status'    =>  true
                    ], 200);
                }
            } else {
                $this->response([
                    'message'   => "Mohon maaf, Absensi belum dimulai ... Silahkan ajukan permohonan nanti ",
                    'status'    =>  false
                ], 200);
            }
        } else {
            $this->response([
                'message'   => 'Data Tidak Boleh kosong !!',
                'status'    => false
            ], 200);
        }
    }
}
