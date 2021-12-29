<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }


    public function index()
    {
        $data['title'] = 'Manajemen User';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Admin_model', 'admin');
        $data['acc'] = $this->admin->getRole();
        $data['role'] = $this->db->get('user_role')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }


    public function roleaccess($role_id)
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])
            ->row_array();

        $this->db->where('id !=', 1);

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }


    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert
        alert-success" role="alert">
        Access Changed!
        </div>');
    }

    public function delete($id)
    {
        $this->load->model('admin_model');

        if ($this->admin_model->deleteUser($id)) {
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">
            User has been deleted!
             </div>');
            redirect('admin');
        }
    }

    public function editUser($id)
    {
        $this->table = ('user');
        $data['title'] = 'Edit User';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Admin_model', 'admin');
        $data['dapat'] = $this->db->get('user_role')->result_array();
        $data['ambil'] = $this->admin->get_data($this->table, ['id' => $id])->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/edituser', $data);
        $this->load->view('templates/footer');
    }


    public function updateuser()
    {

        $this->load->model('admin_model', 'role');

        $roleid = $this->input->post('role_id');
        $isactive = $this->input->post('is_active');
        $id = $this->input->post('id');


        if ($roleid) {

            $input = [
                'role_id' => $roleid,
                'is_active' => $isactive
            ];


            $this->role->update_data('user', $input, ['id' => $id]);

            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">
            User has been updated!
            </div>');
            redirect('admin');
        } else {
        }
    }

    public function berita()
    {
        $data['title'] = 'Berita User';

        $this->load->model('User_model', 'user');

        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $iduser = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        if ($iduser['role_id'] == 1) {
            $data['berita'] = $this->user->getKategoriAdmin();

          

            $this->form_validation->set_rules('judul_berita', 'Judul Berita', 'required');
            $this->form_validation->set_rules('isi_berita', 'Isi Berita', 'required');

            //pagination
            $total_row = $this->user->total_row();
            $config['base_url'] = base_url() . 'user/berita/';
            $config['total_rows'] = $total_row;
            $config['per_page'] = 5;
            $awal = $this->uri->segment(3);

            $this->pagination->initialize($config);
            $data_page = $this->user->berita_page_admin($config['per_page'], $awal);

            $data_berita_page = array(
                'berita' => $data_page,
            );


            if ($this->form_validation->run() == false) {

                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('admin/berita', $data_berita_page);
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
                    'id_kategori' => $ambilid['id_kategori']

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
}
