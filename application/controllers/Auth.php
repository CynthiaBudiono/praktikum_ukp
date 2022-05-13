<?php if (!defined('BASEPATH')) { exit('No direct script access allowed');}

class Auth extends CI_Controller
{
    public function index() {
       
        // $this->load->library('form_validation');
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        // $this->form_validation->set_rules('selecttipeuser', 'Tipe', 'min_length[3]|required');

        $this->form_validation->set_rules('username', 'Username', 'min_length[4]|required');

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');

        if ($this->form_validation->run() == false) {

            $data['error_msg'] = validation_errors();            
        } 
        else {
            if ($this->form_validation->run() !== false) {

                $this->load->model('user_model');
                $this->load->model('user_group_model');
                $this->load->model('mahasiswa_model');
                $this->load->model('dosen_model');
                $this->load->model('asisten_model');

                if($this->input->post('selecttipeuser') != null){
                    // var_dump($this->input->post('selecttipeuser')); exit;
                    if($this->input->post('selecttipeuser') == "admin"){
                        $user = $this->user_model->getbyusername($this->input->post('username'));

                        if($user){
                            $getusergroup = $this->user_group_model->get($user[0]['id_user_group']);
                            $data_login = array(
                                'logged_in' => true,
                                'from_table' => 'user',
                                'user_type' => $getusergroup[0]['nama'],
                                'user_id' => $user[0]['id'],
                                'logged_name' => $user[0]['username']
                            );

                            $data_last_login = array(
                                'id' => $user[0]['id'],
                                'last_login' => date('Y-m-d H:i:s')
                            );
                            $this->user_model->update($data_last_login);

                        }
                    }
                    else if($this->input->post('selecttipeuser') == "john"){

                        $user = $this->asisten_model->getbyNRP($this->input->post('username'));

                        // var_dump($user[0]); exit;
                        if($user){
                            $data_login = array(
                                'logged_in' => true,
                                'from_table' => 'asisten',
                                'user_type' => 'asisten_'.$user[0]['tipe'],
                                'user_id' => $user[0]['id'],
                                'logged_name' => $user[0]['nama'],
                                'role' => 'Mahasiswa',
                            );

                            $data_last_login = array(
                                'NRP' => $user[0]['NRP'],
                                'last_login' => date('Y-m-d H:i:s')
                            );
                            $this->mahasiswa_model->update($data_last_login);

                        }
                        else{
                            $user = $this->mahasiswa_model->get($this->input->post('username'));
                        
                            if($user){
                                $data_login = array(
                                    'logged_in' => true,
                                    'from_table' => 'mahasiswa',
                                    'user_type' => 'mahasiswa',
                                    'user_id' => $user[0]['NRP'],
                                    'logged_name' => $user[0]['nama'],
                                    'role' => 'Mahasiswa',
                                );

                                $data_last_login = array(
                                    'NRP' => $user[0]['NRP'],
                                    'last_login' => date('Y-m-d H:i:s')
                                );
                                $this->mahasiswa_model->update($data_last_login);

                            }
                        }
                    }
                    else if($this->input->post('selecttipeuser') == "peter"){
                        //jek blom ganti line 98 hrusnya user_model
                        $user = $this->dosen_model->get($this->input->post('username'));

                        //KEPALA LABORATORIUM
                        if($user){
                            $data_login = array(
                                'logged_in' => true,
                                'from_table' => 'user',
                                'user_type' => 'kepala_lab',
                                'user_id' => $user[0]['NIP'],
                                'logged_name' => $user[0]['nama'],
                                'role' => 'Dosen',
                            );

                            $data_last_login = array(
                                'NIP' => $user[0]['NIP'],
                                'last_login' => date('Y-m-d H:i:s')
                            );
                            $this->user_model->update($data_last_login);
                        }
                        else{
                            $user = $this->dosen_model->get($this->input->post('username'));

                            $data_login = array(
                                'logged_in' => true,
                                'from_table' => 'dosen',
                                'user_type' => 'dosen',
                                'user_id' => $user[0]['NIP'],
                                'logged_name' => $user[0]['nama'],
                                'role' => 'Dosen',
                            );

                            $data_last_login = array(
                                'NIP' => $user[0]['NIP'],
                                'last_login' => date('Y-m-d H:i:s')
                            );
                            $this->dosen_model->update($data_last_login);
                        }
                    }

                }
               
               
                // var_dump("USERRRR : ", $user);exit;

                // $pass = $this->input->post('password');

                if ($user && $user[0]['status']==1) { //cek active user
                    // var_dump("masuk ifffffff ");exit;
                    if ($this->input->post('password') == $user[0]['password']) {

                        $this->session->set_userdata($data_login);
                        
                        redirect('dashboard');
                    } 
                    else {
                        $data['error_msg'] = "Invalid username and password!";
                    }
                } 
                else {
                    $data['error_msg'] = "User not found";
                }
            }
        }

        $this->load->view('general/header');
        $this->load->view('general/login', $data);
    }

    public function logout(){

        $this->session->sess_destroy();

        redirect('login');
    }
}
