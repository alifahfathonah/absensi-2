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

        public function updateAbsensi($data,$id_users,$date){
            return $this->db->update('tb_absensi',$data,array('id_users' => $id_users,'date' => $date));
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

        public function getDataAbsensiByBulanAndId($month,$id_users){
            $sql = "SELECT * FROM tb_absensi,tb_users WHERE 
                        tb_absensi.id_users =  tb_users.id_users AND
                        tb_absensi.id_users = ? AND
                        MONTH(tb_absensi.date) = ? ORDER BY date DESC";
            return $this->db->query($sql,array($id_users,$month))->result_array();
        }

        public function getDataLaporanKehadiran($id_users,$month){
            $sql = "SELECT * FROM tb_absensi WHERE 
                        id_users = ? AND
                        MONTH(date) = ? ORDER BY date";
            return $this->db->query($sql,array($id_users,$month))->result_array();
        }

        public function getDataHadir($id_users,$month,$status){
            $sql = "SELECT COUNT(id_users)as jumlah FROM tb_absensi WHERE 
                        id_users = ? AND
                        MONTH(date) = ? AND
                        status = ?";
            return $this->db->query($sql,array($id_users,$month,$status))->row_array();
        }

        public function getCountAbsensi($id_users,$month){
            $sql = "SELECT COUNT(id_users)as jumlah FROM tb_absensi WHERE 
                        id_users = ? AND
                        MONTH(date) = ? ";
            return $this->db->query($sql,array($id_users,$month))->row_array();
        }


        public function getDataAbsensiGroup($month){
            $sql = "SELECT * 
                         FROM tb_absensi,tb_users WHERE
                        tb_absensi.id_users = tb_users.id_users  AND
                        MONTH(tb_absensi.date) = ?  GROUP BY tb_absensi.id_users";
            return $this->db->query($sql,$month)->result_array();
        }
        public function getDataKehadiranByStatus($month,$status,$id_users){
            $sql = "SELECT COUNT(status) as jumlah FROM tb_absensi WHERE
                        MONTH(date) = ? AND
                        status = ? AND
                        tb_absensi.id_users = $id_users GROUP BY id_users";
            return $this->db->query($sql,array($month,$status))->row_array();
        }

        public function getDataAbsensiByIdUsersGroup($month,$id_users){
            $sql = "SELECT * FROM tb_absensi,tb_users WHERE
                        tb_absensi.id_users = tb_users.id_users  AND
                        MONTH(tb_absensi.date) = ? AND
                        tb_absensi.id_users = $id_users GROUP BY tb_absensi.id_users";
            return $this->db->query($sql,$month)->row_array();
        }

        public function getDataKehadiranTelat($month,$id_users){
            $sql = "SELECT SUM(is_late) as jumlah FROM tb_absensi WHERE
                        MONTH(date) = ? AND
                        id_users = $id_users";
            return $this->db->query($sql,$month)->row_array();
        }

        public function updateUangMakan($updateUangMakan,$id_absensi){
            return $this->db->update('tb_uangmakan',$updateUangMakan,array('id_absensi' => $id_absensi));
        }

        public function addUangMakan($data){
            return $this->db->insert('tb_uangmakan',$data);
        }
        public function addUangMakanBatch($data){
            return $this->db->insert_batch('tb_uangmakan',$data);
        }
    }