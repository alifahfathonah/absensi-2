<?php

    class ModelSurat extends CI_Model{
        public function addSuratIzin($data){
            return $this->db->insert('tb_surat_tidak_hadir',$data);
        }

        public function getDataIzinByIdUsers($id_users,$date){
            return $this->db->get_where('tb_surat_tidak_hadir',array('id_users' => $id_users,'tanggal'=>$date))->row_array();
        }

        public function getAllDataSuratIzinByIdUsers($id_users){
            $sql = "SELECT * FROM tb_surat_tidak_hadir 
                        JOIN tb_users  ON tb_surat_tidak_hadir.id_users = tb_users.id_users 
                        JOIN tb_absensi ON tb_surat_tidak_hadir.id_absensi = tb_absensi.id_absensi WHERE 
                        tb_surat_tidak_hadir.id_users = ?";

            return $this->db->query($sql,$id_users)->result_array();
        }

        public function getDataSuratByStatus($status){
            $sql = "SELECT * FROM tb_surat_tidak_hadir 
                        JOIN tb_users ON tb_surat_tidak_hadir.id_users = tb_users.id_users
                        JOIN tb_absensi ON tb_surat_tidak_hadir.id_absensi = tb_absensi.id_absensi 
                        JOIN tb_detail_users ON tb_users.id_users = tb_detail_users.users_id 
                        JOIN tb_jabatan ON tb_detail_users.id_jabatan = tb_jabatan.id_jabatan WHERE
                        tb_surat_tidak_hadir.status_surat = ?";
            return $this->db->query($sql,$status)->result_array();
        }

        public function updateData($changeSuratIzin,$id_absensi){
            return $this->db->update('tb_surat_tidak_hadir',$changeSuratIzin,array('id_absensi'=>$id_absensi));
        }
    }