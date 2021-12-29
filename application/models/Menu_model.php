 <?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    private $_table = 'user_sub_menu';
    private $_table2 = 'user_menu';

    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                FROM `user_sub_menu` JOIN `user_menu`
                ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
        ";

        return $this->db->query($query)->result_array();
    }

    public function deleteSubMenu($id)
    {

        return $this->db->delete($this->_table, array('id' => $id));
    }

    public function deleteMenu($id)
    {

        return $this->db->delete($this->_table2, array('id' => $id));
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
