<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

class Users extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('ModelUsers');
    }

    public function register_post()
    {
        $id_pegawai = "PG-" . rand(0, 99999);
        $full_name = $this->input->post('full_name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $password = $this->input->post('password');
        $imei = $this->input->post('imei');

        if ($full_name != null && $email != null && $phone != null && $password != null) {
            $checkPhone = $this->db->get_where('tb_users', array('no_telp' => $phone))->row_array();
            $checkEmail = $this->db->get_where('tb_users', array('email' => $email))->row_array();
            $checkImei = $this->db->get_where('tb_users', array('device_id' => $imei))->row_array();
            if ($checkEmail > 0) {
                $this->response([
                    'message'   => "Email sudah digunakan, masukan email yang lain !",
                    'status'    => false
                ], 200);
            }

            if ($checkPhone > 0) {
                $this->response([
                    'message'   => "No Telepon sudah digunakan, masukan no telepon yang lain !",
                    'status'    => false
                ], 200);
            }

            if ($checkImei > 0) {
                $this->response([
                    'message'   => "Device ID sudah terdaftar, silahkan gunakan handphone yang lain !",
                    'status'    => false
                ], 200);
            }
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $data = array(
                'nama_lengkap'  => $full_name,
                'email'         => $email,
                'no_telp'       => $phone,
                'password'      => $hashPassword,
                'role'          => 0,
                'device_id'     => $imei,
                'is_verified'   => 0,
                'no_pegawai'    => $id_pegawai

            );
            $this->ModelUsers->insertUsers($data);
            $this->response([
                'message'       => "Data pegawai berhasil ditambahkan,silahkan tunggu verifikasi selanjutnya",
                'status'        => true,
            ], 200);
        } else {
            $this->response([
                'message'   => "Data harus Lengkap !",
                'status'    => false
            ], 200);
        }
    }

    public function login_post()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $device_id = $this->input->post('device_id');

        if ($email == null) {
            $this->response([
                'message'   => "Email tidak boleh kosong",
                'status'    => false
            ], 200);
        }

        if ($password == null) {
            $this->response([
                'message'   => "Password tidak boleh kosong",
                'status'    => false
            ], 200);
        }

        // Check Email di database
        // read Data dari database berdasarkan email
        $checkEmail = $this->db->get_where('tb_users', array('email' => $email))->row_array();
        $id_users = $checkEmail['id_users'];
        $users_data = $this->ModelUsers->readDataProfile($id_users);
        if ($checkEmail > 0) {

            // Jika Email ada di database langsung cek Password
            $checkPassword = $checkEmail['password'];
            if (password_verify($password, $checkPassword)) {

                //cek status verified
                $checkVerified = $checkEmail['is_verified'];
                if ($checkVerified > 0) {
                    //jika password cocok lalu cek device id
                    $checkDeviceId = $checkEmail['device_id'];
                    if ($checkDeviceId == $device_id) {
                        $this->response([
                            'message'   => "Login sukses",
                            'status'    => true,
                            'user_data' => $users_data
                        ], 200);
                    } else {
                        $this->response([
                            'message'   => "Maaf, Anda tidak bisa login di handphone lain !!",
                            'status'    => false
                        ], 200);
                    }
                }else{
                    $this->response([
                        'message'   => "Mohon Maaf, Akun anda belum diverifikasi oleh admin ... Silahkan tunggu !",
                        'status'    => false
                    ], 200);
                }
            } else {
                $this->response([
                    'message'   => "Maaf, Passoword yang anda masukan tidak cocok",
                    'status'    => false
                ], 200);
            }
        } else {
            $this->response([
                'message'   => "Maaf, Email yang anda masukan tidak terdaftar",
                'status'    => false
            ], 200);
        }
    }

    public function readDataProfil_post()
    {
        $id_users = $this->post('id_users');
        $readData = $this->ModelUsers->readDataProfile($id_users);

        $this->response([
            'message'       => "sukses",
            'status'        => false,
            'users_data'    => $readData
        ], 200);
    }

    public function updateProfil_post(){
        $id_pegawai = $this->input->post("id_pegawai");
        $no_telp = $this->input->post("no_telp");
        $date = $this->input->post("date");
        $jk = $this->input->post("jk");
        $alamat = $this->input->post("alamat");

        if($id_pegawai != null && $no_telp != null && $date != null && $jk != null && $alamat != null){
            $getData = $this->db->get_where("tb_users",array("no_pegawai"   => $id_pegawai))->row_array();
            $id_users = $getData['id_users'];
            // var_dump(($id_users));die;
            $data = array(
                "jenis_kelamin"     => $jk,
                "alamat"            => $alamat,
                "tgl_lahir"         => $date
            );

            $dataProfile = array(
                "no_telp"           => $no_telp
            );

            $this->ModelUsers->updateDetailUsers($data,$id_users);
            $this->ModelUsers->updateUsers($dataProfile,$id_users);
            $this->response([
                'message'       => "Data Profile berhasil diubah !",
                'status'        => true
            ],200);
        }else{
            $this->response([
                'message'   => "Data tidak Boleh kosong",
                'status'    => false
            ],200);
        }
    }
}
