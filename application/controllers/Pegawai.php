<?php

    class Pegawai extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
            $this->load->model('ModelUsers');

        }

        public function verifikasi_data(){
            $id_user = $this->input->post('id_users');
            $jabatan = $this->input->post('jabatan');

            if($jabatan != null ){
                $data = array(
                    'users_id'      => $id_user,
                    'id_jabatan'    => $jabatan,
                    'check_in'      => '08:00:00',
                    'check_out'     => '15:00:00'
                );
                $updateVerified = array(
                    'is_verified'    => 1
                );
                $this->ModelUsers->updateUsers($updateVerified,$id_user);
                $this->ModelUsers->verifKaryawan($data);
                $this->session->set_flashdata('icon', 'success');
                $this->session->set_flashdata('text', 'Data Karyawan berhasil di verifikasi');
                $this->session->set_flashdata('title', 'Verifikasi Sukses !');
                redirect(base_url('home/verifikasi_pegawai/'));

            }else{
                $this->session->set_flashdata('icon', 'warning');
                $this->session->set_flashdata('text', 'Data Harus Lengkap');
                $this->session->set_flashdata('title', 'Verifikasi Gagal !');
                redirect(base_url('home/verifikasi_pegawai/'));
            }
        }

        public function delete_pegawai(){
            $id_user = $this->uri->segment(3);

            $this->ModelUsers->deleteUsers($id_user);
            $this->session->set_flashdata('icon', 'success');
            $this->session->set_flashdata('text', 'Data Karyawan berhasil di hapus');
            $this->session->set_flashdata('title', 'Hapus Berhasil !');
            redirect(base_url('dashboard/list_karyawan_not_verified/'));
        }
    }