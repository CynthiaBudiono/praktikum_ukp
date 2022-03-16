<?php if (!defined('BASEPATH')) { exit('No direct script access allowed');}

class Auth extends CI_Controller
{
    public function index() {
       
        // $this->load->library('form_validation');
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

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
                $this->load->model('asisten_dosen_model');

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
                else{
                    $user = $this->mahasiswa_model->get($this->input->post('username'));
                    
                    if($user){
                        $data_login = array(
                            'logged_in' => true,
                            'from_table' => 'mahasiswa',
                            'user_type' => 'mahasiswa',
                            'user_id' => $user[0]['NRP'],
                            'logged_name' => $user[0]['nama']
                        );

                        $data_last_login = array(
                            'NRP' => $user[0]['NRP'],
                            'last_login' => date('Y-m-d H:i:s')
                        );
                        $this->mahasiswa_model->update($data_last_login);

                    }
                    else{
                        $user = $this->dosen_model->get($this->input->post('username'));

                        if($user){
                            $data_login = array(
                                'logged_in' => true,
                                'from_table' => 'dosen',
                                'user_type' => 'dosen',
                                'user_id' => $user[0]['NIP'],
                                'logged_name' => $user[0]['nama']
                            );

                            $data_last_login = array(
                                'NIP' => $user[0]['NIP'],
                                'last_login' => date('Y-m-d H:i:s')
                            );
                            $this->dosen_model->update($data_last_login);
                        }
                        else{
                            $user = $this->asisten_dosen_model->getbyNIP($this->input->post('username'));

                            if($user){
                                $get_mahasiswa = $this->mahasiswa_model->get($user[0]['NRP']);
                                $data_login = array(
                                    'logged_in' => true,
                                    'from_table' => 'asisten_dosen',
                                    'user_type' => 'asisten_dosen',
                                    'user_id' => $user[0]['id'],
                                    'logged_name' => $get_mahasiswa[0]['nama']
                                );

                                $data_last_login = array(
                                    'id' => $user[0]['id'],
                                    'last_login' => date('Y-m-d H:i:s')
                                );
                                $this->asisten_dosen_model->update($data_last_login);

                            }
                        }
                    }
                }

                // var_dump("USERRRR : ", $user);exit;

                // $pass = $this->input->post('password');

                if ($user && $user[0]['status']==1) {
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
