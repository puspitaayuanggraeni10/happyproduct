<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model', 'user');
  }

  public function login()
  {
    var_dump($this->session->userdata());

    if ($this->session->userdata('user_logged_in')) {
      redirect('products');
    }

    if ($this->input->post()) {
      $username = $this->input->post('username', true);
      $password = $this->input->post('password', true);

      $admin = $this->user->check_login($username, $password);

      if ($admin) {
        $this->session->set_userdata([
          'user_logged_in' => true,
          'user_id' => $admin->id,
          'user_username' => $admin->username
        ]);

        toast('info', 'Selamat datang, Semangat bekerja !');
        redirect('products');
      } else {
        toast('error', 'Username / Password salah!');
        redirect('auth/login');
      }
    }

    $this->load->view('auth/login');
  }

  public function logout()
  {
     $this->session->unset_userdata([
        'user_logged_in',
        'user_id',
        'user_username'
    ]);
    toast('info', 'Logout !');
    redirect('auth/login');
  }
}

