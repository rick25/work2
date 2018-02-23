<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Book_model');
	}
	/*
	*	MUESTRA LOS LIBROS DE LA BBDD
	*/
	public function index()
	{
		$data['books'] = $this->Book_model->get_all_books();
		$data['categorias'] = $this->Book_model->get_all_categories();
		$this->load->view('book_view', $data);	
	}

	/*
	*	INSERTA UN NUEVO LIBRO EN LA BBDD
	*/
	public function book_add()
	{
		$data = array(
			'book_isbn'   => $this->input->post('book_isbn'),
			'book_title'  => $this->input->post('book_title'),
			'book_author' => $this->input->post('book_author'),
			'category_id' => $this->input->post('book_category')
		);
		$insert = $this->Book_model->book_add($data);
		echo json_encode( array( "status" => TRUE ) );
	}

	/*
	*	
	*/
	public function ajax_edit()
	{
		$data = $this->Book_model->get_by_id( $this->input->get('id') );
		echo json_encode( $data );
	}

	/*
	*	ACTUALIZA UN LIBRO VIENE POR POST
	*/
	public function book_update()
	{
		$data = array(
			'book_isbn'     => $this->input->post('book_isbn'),
			'book_title'    => $this->input->post('book_title'),
			'book_author'   => $this->input->post('book_author'),
			'category_id' => $this->input->post('book_category')
		);
		$this->Book_model->book_update( array( 'book_id' => $this->input->post('book_id') ), $data );
		echo json_encode( array( "status" => TRUE) );
	}

	/*
	*	ELIMINA UN LIBRO DE BBDD
	*/
	public  function book_delete()
	{
		$this->Book_model->delete_by_id( $this->input->post('id') );
		echo json_encode(array("status" => TRUE));
	}

}

/* End of file Books.php */
/* Location: ./application/controllers/Books.php */