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

        public function getDataAbsensiByTime($date){
            $sql = "SELECT * FROM tb_absensi WHERE check_in > '08:00:00' AND date = ?";
            return $this->db->query($sql,$date)->result_array();
        }

        public function updateAbsensi($data,$id_users){
            return $this->db->update('tb_absensi',$data,array('id_users' => $id_users));
        }

        public function getDataAbsensiByIdUsers($id_users,$date){
            return $this->db->get_where('tb_absensi',array('id_users' => $id_users,'date' => $date))->row_array();
        }

        public function getDataAbsensiByBulan($month){
            $sql = "SELECT * FROM tb_absensi,tb_users WHERE 
                        tb_absensi.id_users =  tb_users.id_users AND
                        MONTH(tb_absensi.date) = ? ORDER BY date DESC";
            return $this->db->query($sql,$month)->result_array();
        }

        public function getDataLaporanKehadiran($id_users,$month){
            $sql = "SELECT * FROM tb_absensi WHERE 
                        id_users = ? AND
                        MONTH(date) = ? ";
            return $this->db->query($sql,array($id_users,$month))->result_array();
        }

        public function getDataHadir($id_users,$month,$status){
            $sql = "SELECT COUNT(id_users)as jumlah FROM tb_absensi WHERE 
                        id_users = ? AND
                        MONTH(date) = ? AND
                        status = ?";
            return $this->db->query($sql,array($id_users,$month,$status))->row_array();
        }
    }