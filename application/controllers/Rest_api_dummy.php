<?php

class Rest_api_dummy extends CI_Controller
{

    var $API = '';

    function __construct()
    {
        parent::__construct();
        $this->API = "http://localhost/backendlanjutan/REST_API";
        $this->load->library('curl');
    }

    function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['data_api'] = json_decode($this->curl->simple_get($this->API . '/berita'), TRUE);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('api_view/view_api', $data);
        $this->load->view('templates/footer');
    }

    function tambah_berita()
    {
        if (isset($_POST['submit'])) {
            $data = array(
                'judul_berita'      =>  $this->input->post('judul_berita'),
                'isi_berita' =>  $this->input->post('isi_berita')
            );
            $insert =  $this->curl->simple_post($this->API . '/berita', $data, array(CURLOPT_BUFFERSIZE => 10));

            if ($insert) {
                $this->session->set_flashdata('hasil', 'Insert Data Berhasil');
            } else {
                $this->session->set_flashdata('hasil', 'Insert Data Gagal');
            }
            redirect('rest_api_dummy');
        }
    }

    function delete($id_berita)
    {
        if (isset($id_berita)) {
            $hapus =  $this->curl->simple_delete($this->API . '/berita', array('id_berita' => $id_berita), array(CURLOPT_BUFFERSIZE => 10));
            if ($hapus) {
                $this->session->set_flashdata('hasil', 'Delete Data Berhasil');
            } else {
                $this->session->set_flashdata('hasil', 'Delete Data Gagal');
            }
            redirect('rest_api_dummy');
        }
    }

    function edit($id)
    {
        $id_berita = decrypt_url($id);
        $data['title'] = 'Edit Berita';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->table = ('berita');
        $data['ubah'] = $this->model->get_data($this->table, ['id_berita' => $id_berita])->row();
    }
}
