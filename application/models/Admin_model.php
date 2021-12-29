<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    private $_table = 'user';

    public function getRole()
    {
        $query = " SELECT user.*, user_role.role
                    FROM user JOIN user_role
                    ON user.role_id = user_role.id
            ";

        return $this->db->query($query)->result_array();
    }

    public function deleteUser($id)
    {

        return $this->db->delete($this->_table, array('id' => $id));
    }

    public function get_data($table, $data)
    {
        return $this->db->get_where($table, $data);
    }


    public function update_data($table, $set, $where)
    {
        //melakukan perintah mengubah data tabel
        return $this->db->where($where)->update($table, $set);
    }

   
}
