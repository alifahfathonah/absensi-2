<?php

    use chriskacerguis\RestServer\RestController;
    require APPPATH . 'libraries/Format.php';
    require APPPATH . 'libraries/RestController.php';

    class Absensi extends RestController{
        public function __construct()
        {
            parent::__construct();
            $this->load->model('ModelUsers');
            $this->load->model('ModelAbsensi');
        }        

        public function addAbsensi_post(){
            // ini proses absensi
            $date = date('Y-m-d'); // ini ambil tanggal hari ini
            $no_pegawai = $this->input->post('no_pegawai'); // ambil dari no pegawai
            $time   = $this->input->post('time'); // ambil dari waktu yang ada di handphone

            $getDataPegawai = $this->ModelUsers->getDataUsersByIdPegawai($no_pegawai); //mengambil id users dari no pegawai
            $id_users = $getDataPegawai['id_users']; // id users yang diambil dari getDataPegawai diatas 
            $data_checkin = $getDataPegawai['check_in']; // mengambil data check in dari database, nilai default nya 08:00:00

            if($time > $data_checkin){ // membandingkan waktu absen dengan data checkin yang ada didatabase
                //ini proses dimana jika waktu absen melebihi jam 08:00:00
                $is_late = 1;
                $start_checkin = strtotime($data_checkin) + 3600; // mengubah waktu menjadi string
                $time_absen = strtotime($time); // sama seperti diatas

                $late = (date('H:i:s',$time_absen - $start_checkin)); //mengurangi waktu absen untuk mengambil waktu telat
            }else{
                //ini proses jika tidak telat
                $is_late = 0;
                $late = 0;
            }
            
            $cekDataAbsensi = $this->ModelAbsensi->getDataAbsensiByIdUsers($id_users,$date); //mengambil data absensi hari ini, tujuan nya untuk mengecek si pegawai absen masuk atau absen pulang
            
            if($cekDataAbsensi['check_in'] == "00:00:00"){
                // ini proses dimana pegawai melakukan absen masuk
                $data = array(
                    'check_in'  => $time,
                    'is_late'   => $is_late,
                    'status'    => "Hadir",
                    'late'      => $late
                );
            }else{
                //ini proses dimana pegawai melakukan absen keluar
                if($cekDataAbsensi['check_out'] == "00:00:00"){
                    $checkin_absensi = $cekDataAbsensi['check_in'];
                    $start_checkout = strtotime($checkin_absensi);
                    $end_checkout = strtotime($time);
                    $result = ($end_checkout - 3600) - $start_checkout;
                    $work_time = date('H:i:s',$result);
                    $data = array(
                        'check_out'  => $time,
                        'work_time'  => $work_time
                    );
                }else{
                    $this->response([
                        'message'   => "Maaf, Anda sudah melakukan absensi !!",
                        'status'    => true
                    ],200);
                }
               
                
            }
            $this->ModelAbsensi->updateAbsensi($data,$id_users);
            $this->response([
                'message'   => "Absensi berhasil dilakukan",
                'status'    => true
            ],200);
 

        }

        public function getDataAbsensiByIdUsers_post(){
            $no_pegawai = $this->input->post('id_users');
            $date = date('Y-m-d');
            $getDataPegawai = $this->ModelUsers->getDataUsersByIdPegawai($no_pegawai);
            $id_users = $getDataPegawai['id_users'];
            $getDataAbsensi = $this->ModelAbsensi->getDataAbsensiByIdUsers($id_users,$date);
            $this->response([
                'message'       => "sukses",
                'status'        => true,
                'data_absensi'  => $getDataAbsensi
            ],200);
        }

        public function getLaporanKehadiran_post(){
            $month = date('m');
            $no_pegawai = $this->input->post('id_users');
            $getDataPegawai = $this->ModelUsers->getDataUsersByIdPegawai($no_pegawai);
            $id_users = $getDataPegawai['id_users'];
            $getDataLaporanKehadiran = $this->ModelAbsensi->getDataLaporanKehadiran($id_users,$month);
            $getDataHadir = $this->ModelAbsensi->getDataHadir($id_users,$month,'Hadir');
            $getDataTidakHadir = $this->ModelAbsensi->getDataHadir($id_users,$month,'Tidak');
            $getDataIzin = $this->ModelAbsensi->getDataHadir($id_users,$month,'Izin');

            $this->response([
                'message'       => "data berhasil didapatkan",
                'status'        => true,
                'data_laporan'  => $getDataLaporanKehadiran,
                'hadir'         => $getDataHadir['jumlah'],
                'tidak_hadir'   => $getDataTidakHadir['jumlah'],
                'izin'          => $getDataIzin['jumlah']
            ],200);

        }
    }                                        