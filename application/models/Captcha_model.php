<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Captcha_model extends CI_Model
{
    function getCaptcha() {
        $query = "SELECT * FROM captcha ORDER BY id DESC";
        return $this->db->query($query)->row_array();
    }
}