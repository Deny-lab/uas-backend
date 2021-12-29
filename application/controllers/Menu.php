<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Manajemen Menu';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">
            New menu added!
             </div>');
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['title'] = 'Manajemen Submenu';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model', 'menu');
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();


        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');


        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">
            New Submenu added!
             </div>');
            redirect('menu/submenu');
        }
    }

    public function deletemenu($id)
    {
        $this->load->model('menu_model');

        if ($this->menu_model->deleteMenu($id)) {
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">
            Menu has been deleted!
             </div>');
            redirect('menu');
        }
    }

    public function deletesubmenu($id)
    {
        $this->load->model('menu_model');

        if ($this->menu_model->deleteSubMenu($id)) {
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">
            Submenu has been deleted!
             </div>');
            redirect('menu/submenu');
        }
    }

    public function editsubmenu($id)
    {
        $this->load->model('menu_model', 'model');
        $this->table = ('user_sub_menu');

        $data['title'] = 'Edit Submenu';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['submenu'] = $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();
        $data['ubah'] = $this->model->get_data($this->table, ['id' => $id])->row();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/edit', $data);
        $this->load->view('templates/footer');
    }

    public function updateSubMenu()
    {

        $this->load->model('Menu_model', 'menu');

        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $active = $this->input->post('is_active');
        $menu = $this->input->post('menu_id');
    
        if (!$menu == 0) {
            
            $input = [
                
                'menu_id'   => $menu,
                'title' => $title,
                'url'    => $url,
                'icon'   => $icon,
                'is_active' => $active
            ];
    
            $this->menu->update_data('user_sub_menu', $input, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">
            Submenu has been updated!
             </div>');
            redirect('menu/submenu');
        } else {
            
        }
    }
}
