<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $_table = 'berita';
    private $_table2 = 'kategori_berita';

    public function getKategori($iduser)
    {
        $query = "SELECT berita.*, kategori_berita.nama_kategori
                    FROM kategori_berita JOIN berita
                    ON berita.id_kategori = kategori_berita.id_kategori
                    WHERE berita.id_user = $iduser
                    
        ";

        return $this->db->query($query)->result_array();
    }

    public function getKategoriAdmin()
    {
        $query = "SELECT berita.*, kategori_berita.nama_kategori, user.email
        FROM kategori_berita JOIN berita JOIN user
        
        ON berita.id_kategori = kategori_berita.id_kategori
                   
                    
        ";

        return $this->db->query($query)->result_array();
    }

    public function delete($id, $id2)
    {

        $this->db->delete($this->_table, array('id_berita' => $id));
        return $this->db->delete($this->_table2, array('id_kategori' => $id2));
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

    public function total_row()
    {
        return $this->db->get($this->_table)->num_rows();
    }

    public function berita_page($per_page, $awal, $iduser)
    {
        if ($awal == '') {
            $awal_page = '0';
        } else {
            $awal_page = $awal;
        }

        return $this->db->query("SELECT berita.*, kategori_berita.nama_kategori
        FROM kategori_berita JOIN berita
        ON berita.id_kategori = kategori_berita.id_kategori  WHERE berita.id_user = $iduser LIMIT $per_page OFFSET $awal_page")->result_array();
    }

    public function berita_page_admin($per_page, $awal)
    {
        if ($awal == '') {
            $awal_page = '0';
        } else {
            $awal_page = $awal;
        }

        return $this->db->query("SELECT berita.*, kategori_berita.nama_kategori
        FROM kategori_berita JOIN berita
        ON berita.id_kategori = kategori_berita.id_kategori  LIMIT $per_page OFFSET $awal_page")->result_array();
    }
}
