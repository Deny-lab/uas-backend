<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            //cek gambar jika diupload 
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '5120';
                $config['upload_path'] = './assets/img/profile/';



                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                   
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">
            Your profile has been updated!
            </div>');
            redirect('user');
        }
    }

    public function changepassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules(
            'new_password1',
            'New Password',
            'required|trim|min_length[3]|matches[new_password2]'
        );
        $this->form_validation->set_rules(
            'new_password2',
            'Confirm New Password',
            'required|trim|min_length[3]|matches[new_password1]'
        );

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert
                alert-danger" role="alert">
                Wrong current password!
                </div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert
                    alert-danger" role="alert">
                    New password cannot be the same as current password!
                    </div>');
                    redirect('user/changepassword');
                } else {
                    //password benar
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata['email']);
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert
                    alert-success" role="alert">
                    Password changed!
                    </div>');
                    redirect('user/changepassword');
                }
            }
        }
    }

    public function berita()
    {


        $data['title'] = 'List Berita';

        $this->load->model('User_model', 'user');

        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $iduser = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        if ($iduser['role_id'] == 1) {
            redirect('admin/berita');
        } else {

            $data['berita'] = $this->user->getKategori($iduser['id']);




            $this->form_validation->set_rules('judul_berita', 'Judul Berita', 'required');
            $this->form_validation->set_rules('isi_berita', 'Isi Berita', 'required');

            //pagination
            $total_row = $this->user->total_row();
            $config['base_url'] = base_url() . 'user/berita/';
            $config['total_rows'] = $total_row;
            $config['per_page'] = 5;
            $awal = $this->uri->segment(3);

            $this->pagination->initialize($config);
            $data_page = $this->user->berita_page($config['per_page'], $awal, $iduser['id']);

            $data_berita_page = array(
                'berita' => $data_page,
            );


            if ($this->form_validation->run() == false) {

                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/berita', $data_berita_page);

                $this->load->view('templates/footer');
            } else {
                $data3 = $this->db->get_where('user', ['email' =>
                $this->session->userdata('email')])->row_array();

                $data2 = [
                    'nama_kategori' => $this->input->post('nama_kategori'),
                    'id_user' => $data3['id'],

                ];
                $this->db->insert('kategori_berita', $data2);

                $ambilid = $this->db->get_where('kategori_berita', ['nama_kategori' =>
                $this->input->post('nama_kategori')])->row_array();

                $iduser = $this->db->get_where('user', ['email' =>
                $this->session->userdata('email')])->row_array();


                $data = [
                    'id_user' => $iduser['id'],
                    'judul_berita' => $this->input->post('judul_berita'),
                    'isi_berita' => $this->input->post('isi_berita'),
                    'tgl' => time(),
                    'id_kategori' => $ambilid['id_kategori'],

                ];


                $this->db->insert('berita', $data);


                $this->session->set_flashdata('message', '<div class="alert
               alert-success" role="alert">
               New Berita added!
                </div>');
                redirect('user/berita');
            }
        }
    }

    public function deleteberita($id, $id2)
    {
        $this->load->model('User_model', 'model');
        if ($this->model->delete($id, $id2)) {
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">
            Berita has been deleted!
             </div>');
            redirect('user/berita');
        }
    }

    public function editberita($id, $id2)
    {
        $id_berita = decrypt_url($id);
        $id_kategori = decrypt_url($id2);
        $this->load->model('user_model', 'model');
        $this->table = ('berita');
        $this->table2 = ('kategori_berita');
        $data['title'] = 'Edit Berita';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['ubah'] = $this->model->get_data($this->table, ['id_berita' => $id_berita])->row();
        $data['ubah_ctg'] = $this->model->get_data($this->table2, ['id_kategori' => $id_kategori])->row();




        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/edit_berita', $data);
        $this->load->view('templates/footer');
    }



    public function update()
    {

        $this->load->model('user_model', 'berita');

        $id =  $this->input->post('id_berita');
        $id_ctg =  $this->input->post('id_kategori');
        $judul_berita = $this->input->post('judul_berita');
        $isi_berita = $this->input->post('isi_berita');
        $nama_kategori = $this->input->post('nama_kategori');


        if ($id) {

            $input = [


                'judul_berita' => $judul_berita,
                'isi_berita'    => $isi_berita,


            ];

            $ctg = [
                'nama_kategori'    => $nama_kategori,
            ];

            $this->berita->update_data('berita', $input, ['id_berita' => $id]);
            $this->berita->update_data('kategori_berita', $ctg, ['id_kategori' => $id_ctg]);
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">
            Berita has been updated!
             </div>');
            redirect('user/berita');
        } else {
            $this->session->set_flashdata('message', '<div class="alert
            alert-danger" role="alert">
            Update failed!
             </div>');
            redirect('user/berita');
        }
    }



    public function list_pass()
    {
        $data['title'] = 'List Password';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['list'] = $this->db->get('list_password')->result_array();



        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/list-pass', $data);
        $this->load->view('templates/footer');
    }

    public function skd()
    {
        $data['title'] = 'Generate Password';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();



        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/enkripsi', $data);
        $this->load->view('templates/footer');
    }

    public function skd_2()
    {
        $data['title'] = 'Generate Password';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();



        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/dekripsi', $data);
        $this->load->view('templates/footer');
    }



    public function enkripsi()
    {
        $password = $this->input->post('password');
        $encrypted = base64_encode($this->input->post('password'));


        $data = [
            'password' => $password,
            'enkripsi' => $encrypted

        ];

        if ($encrypted) {

            $this->db->insert('list_password', $data);
            redirect('user/list_pass');
        }
    }

    public function dekripsi($id)
    {
        $data['title'] = 'List Password';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['list'] = $this->db->get('list_password')->result_array();
        $pass = $this->db->get_where('list_password', ['id' => $id])->row_array();
        $data['dekripsi'] = base64_decode($pass['enkripsi']);
        $data['data'] = $pass['password'];
        $data['enkripsi'] = $pass['enkripsi'];
        // var_dump($pass);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/list-pass2', $data);
        $this->load->view('templates/footer');
    }
}
