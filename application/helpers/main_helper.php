<?php
function load_view($obj, $view, $data = array(), $session_not_null = FALSE)  {
  $obj->load->view('layouts/header', $data);
  $obj->load->view('layouts/sidebar', $data);
  $obj->load->view($view, $data);
  $obj->load->view('layouts/footer');
}

