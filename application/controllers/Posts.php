<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

	

	public function index()
	{

		$data['title'] = 'Leatest Post';
		$data['posts'] = $this->Post_Model->get_posts();
		$this->load->view('templates/header');
		$this->load->view('posts/index', $data);
		$this->load->view('templates/footer');
		
	}

	public function view($slug = NULL)
	{
		$data['post'] = $this->Post_Model->get_posts($slug);

		if(empty($data['post'])){
			show_404();
		}
		$data['title'] = $data['post']['title'];
		$this->load->view('templates/header');
		$this->load->view('posts/view', $data);
		$this->load->view('templates/footer');
	}

	public function create()
	{			
		$data['title'] = 'Create Post';

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('body', 'Body', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header');
			$this->load->view('posts/create', $data);
			$this->load->view('templates/footer');
		} else {
			$this->Post_Model->create_post();
			redirect('posts','refresh');
		}
		
	}

}
