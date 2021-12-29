<?php

class Hehe extends CI_Controller
{
    public function index()
    {

        // ['user'] = $this->db->get_where('user', ['email' =>
        // $this->session->userdata('email')])->row_array();

        

        $this->load->view('test');
       

        $folderPath = "upload/";



        $image_parts = explode(";base64,", $_POST['signed']);




        $image_type_aux = explode("image/", $image_parts[0]);



        $image_type = $image_type_aux[1];



        $image_base64 = base64_decode($image_parts[1]);


        // var_dump($file);
        // die;

        $file = $folderPath . uniqid() . '.' . $image_type;



        file_put_contents($file, $image_base64);

        echo "Signature Uploaded Successfully.";
    }
}
