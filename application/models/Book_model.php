<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book_model extends CI_Model
{
	var $table = 'books';
	public function get_all_books()
	{
		$this->db->from( $this->table );
		$query=$this->db->get();
		return $query->result();
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
		//$this->db->from( $this->table );
		//$this->db->where( 'book_id', $id);
		//$this->db->update( $data );
		//$query = $this->db->get();

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