<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

	public function get_produk()
		{
			$this->db->select('*');
			$this->db->from('produk');
			$this->db->order_by('id_produk', 'desc');
			$query = $this->db->get();
			return $query->result_array();
			// return $this->db->get('produk')->result_array();
		}

	public function get_id_produk($id_produk)
		{
			$this->db->select('*');
			$this->db->from('produk');
			$this->db->where('id_produk', $id_produk);
			$query = $this->db->get();
			return $query->row();
		}	

	public function delete_produk($id_produk)
	{
		$this->db->delete('produk',['id_produk' => $id_produk]);
		return $this->db->affected_rows();
	}

	public function post_produk($data)
	{
		$this->db->insert('produk', $data);
		return $this->db->affected_rows();
	}

	public function put_produk($data)
	{
		$this->db->where('id_produk', $data['id_produk']);
		$this->db->update('produk', $data);
		return $this->db->affected_rows();
	}

}

/* End of file Produk_model.php */
/* Location: ./application/models/Produk_model.php */