<?php

    class ModelAbsensi extends CI_Model{
        public function getDataAbsensi($date){
            return $this->db->get_where('tb_absensi',array('date' => $date))->result_array();
        }

        public function insertAbsensiAll($data){
            return $this->db->insert_batch('tb_absensi',$data);
        }

        public function getDataAbsensiByStatus($status,$date){
            return $this->db->get_where('tb_absensi',array('status' => $status,'date' => $date))->result_array();
        }

        public function getDataAbsensiByTime(){
            $sql = "SELECT * FROM tb_absensi WHERE check_in > '08:00:00'";
            return $this->db->query($sql)->result_array();
        }

        public function updateAbsensi($data,$id_users){
            return $this->db->update('tb_absensi',$data,array('id_users' => $id_users));
        }

        public function getDataAbsensiByIdUsers($id_users){
            return $this->db->get_where('tb_absensi',array('id_users' => $id_users))->row_array();
        }
    }