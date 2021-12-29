<?php

class Api extends CI_Controller
{

    var $API = '';

    function __construct()
    {
        parent::__construct();
        $this->API = "http://localhost/uas_backend/REST_API";
        $this->load->library('curl');
    }

    function index()
    {
        $data['title'] = 'Data API';
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
                'isi_berita' =>  $this->input->post('isi_berita'),
                'tgl' => time()
            );
            $insert =  $this->curl->simple_post($this->API . '/berita', $data, array(CURLOPT_BUFFERSIZE => 10));

            if ($insert) {
                $this->session->set_flashdata('hasil', 'Insert Data Berhasil');
            } else {
                $this->session->set_flashdata('hasil', 'Insert Data Gagal');
            }
            redirect('api');
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
            redirect('api');
        }
    }

    function edit($id)
    {
        $this->load->model('user_model', 'model');
        $this->table = ('berita');
        $id_berita = decrypt_url($id);
        $data['title'] = 'Edit Berita';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['ubah'] = $this->model->get_data($this->table, ['id_berita' => $id_berita])->row();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('api_view/edit_api', $data);
        $this->load->view('templates/footer');
    }

    function update()
    {
        $this->load->model('user_model', 'berita');
        $id =  $this->input->post('id_berita');
        $judul_berita = $this->input->post('judul_berita');
        $isi_berita = $this->input->post('isi_berita');

        if ($id) {

            $input = [

                'id_berita' => $id,
                'judul_berita' => $judul_berita,
                'isi_berita'    => $isi_berita,
                'tgl' => time()
            ];

           

            $this->curl->simple_put($this->API . '/berita', $input, array(CURLOPT_BUFFERSIZE => 10));
            redirect('api');
        }
    }
}
