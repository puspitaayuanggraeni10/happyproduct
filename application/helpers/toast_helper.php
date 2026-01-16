<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	function toast($type = 'info', $message = '')
	{
		$CI =& get_instance();

		$allowed = ['success', 'error', 'warning', 'info', 'question'];
		if (!in_array($type, $allowed)) {
			$type = 'info';
		}

		$CI->session->set_flashdata('toast', [
			'type' => $type,
			'message' => $message
		]);
	}
