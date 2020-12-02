<?php

    class ModelGaji extends CI_Model{
        public function getDataTotal($id_users,$month){
            $sql = "SELECT SUM(nominal)as total from tb_uangmakan WHERE
                        MONTH(tanggal) = ? AND
                        id_users = ?";
            return $this->db->query($sql,array($month,$id_users))->row_array();
        }

        public function getAllData($id_users,$month){
            $sql = "SELECT * FROM tb_uangmakan,tb_absensi,tb_users WHERE
                        tb_uangmakan.id_users = tb_users.id_users AND
                        tb_uangmakan.id_absensi = tb_absensi.id_absensi AND
                        MONTH(tb_uangmakan.tanggal) = ? AND
                        tb_uangmakan.id_users = ?";
            return $this->db->query($sql,array($month,$id_users))->result_array();
        }
    }