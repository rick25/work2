<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book_model extends CI_Model
{
	var $table = 'books';
	public function get_all_books()
	{
		$this->db->select('book_id,book_isbn, book_title, book_author, name_category');
		$this->db->from( $this->table );
		$this->db->join( 'categories','books.category_id = categories.category_id');
		$query=$this->db->get();
		return $query->result();
	}
	public function get_all_categories()
	{
		$this->db->select('category_id, name_category');
		$this->db->from('categories');
		$query = $this->db->get();

		return $query->result_array();
	}
	public function book_add( $data )
	{
		$this->db->insert( $this->table , $data );
		return $this->db->insert_id();
	}
	
	public function get_by_id( $id )
	{
		$this->db->from( $this->table );
		$this->db->where('book_id', $id);
		$query = $this->db->get();

		return $query->row();		//devuelve una fila
	}

	public function book_update( $id, $data)
	{
		$this->db->update( $this->table, $data, $id );

		return $this->db->affected_rows();
	}

	public function delete_by_id( $id )
	{
		$this->db->where( 'book_id', $id );
		$this->db->delete( $this->table );
	}
}

/* End of file book_model.php */
/* Location: ./application/models/book_model.php */