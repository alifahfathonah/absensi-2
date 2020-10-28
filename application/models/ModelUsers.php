<?php

    class ModelUsers extends CI_Model{

        public function getDataUsersByEmail($email){
            return $this->db->get_where('tb_users',array('email' => $email))->row_array();
        }

        public function insertUsers($data){
            return $this->db->insert('tb_users',$data);
        }

        
        public function updateUsers($data,$id_user){
            return $this->db->update('tb_users',$data,array('id_users' => $id_user));
        }

        public function updateDetailUsers($data,$id_user){
            return $this->db->update('tb_detail_users',$data,array('users_id' => $id_user));
        }

        public function deleteUsers($id_user){
            return $this->db->delete('tb_users',array('id_users' => $id_user));
        } 
        
        public function getDataKaryawanNotVerified($status){
            return $this->db->get_where('tb_users',array("is_verified" => $status))->result_array();
        }


        public function verifKaryawan($data){
            return $this->db->insert('tb_detail_users',$data);
        }

        public function readDataProfile($id_users){
            $sql = "SELECT * from tb_users,tb_detail_users WHERE
                        tb_users.id_users = tb_detail_users.users_id AND
                        tb_users.id_users = ?";
            return $this->db->query($sql,$id_users)->row_array();
        }

        public function getDataKaryawanVerified($status){
            $sql = "SELECT * from tb_users,tb_detail_users WHERE
                        tb_detail_users.users_id = tb_users.id_users AND
                        is_verified = ?";
            return $this->db->query($sql,$status)->result_array();
        }
    }