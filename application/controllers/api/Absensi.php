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
            $no_pegawai = $this->input->post('no_pegawai');
            $time   = $this->input->post('time');
            $getDataPegawai = $this->ModelUsers->getDataUsersByIdPegawai($no_pegawai);
            $id_users = $getDataPegawai['id_users'];
            $data_checkin = $getDataPegawai['check_in'];
            if($time > $data_checkin){
                $is_late = 1;
                $start_checkin = strtotime("09:00:00");
                $time_absen = strtotime($time);
                $late = (date('H:i:s',$time_absen - $start_checkin));
            }else{
                $is_late = 0;
                $late = 0;
            }
            
            $cekDataAbsensi = $this->ModelAbsensi->getDataAbsensiByIdUsers($id_users);
            if($cekDataAbsensi['check_in'] == "00:00:00"){
                $data = array(
                    'check_in'  => $time,
                    'is_late'   => $is_late,
                    'status'    => "Hadir",
                    'late'      => $late
                );
            }else{
                $checkin_absensi = $cekDataAbsensi['check_in'];
                $start_checkout = strtotime($checkin_absensi);
                $end_checkout = strtotime($time);
                $result = $end_checkout - $start_checkout;
                $work_time = date('H:i:s',$result);
                $data = array(
                    'check_out'  => $time,
                    'work_time'  => $work_time
                );
            }

           

            $this->ModelAbsensi->updateAbsensi($data,$id_users);
            $this->response([
                'message'   => "Absensi berhasil dilakukan",
                'status'    => true
            ],200);

        }

        public function getDataAbsensiByIdUsers_post(){
            $no_pegawai = $this->input->post('id_users');
            $getDataPegawai = $this->ModelUsers->getDataUsersByIdPegawai($no_pegawai);
            $id_users = $getDataPegawai['id_users'];
            $getDataAbsensi = $this->ModelAbsensi->getDataAbsensiByIdUsers($id_users);
            $this->response([
                'message'       => "sukses",
                'status'        => true,
                'data_absensi'  => $getDataAbsensi
            ],200);
        }
    }                                        