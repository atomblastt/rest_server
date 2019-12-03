<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Produk extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('produk_model');

		$this->methods['index_get']['limit'] = 200;
	}

	public function index_get()
	{
		$id_produk = $this->get('id_produk');

		if ($id_produk === null) {
			$produk = $this->produk_model->get_produk();
		}else{
			$produk = $this->produk_model->get_id_produk($id_produk);
		}

		if ($produk) {
			$this->response([
                    'status'	=> TRUE,
                    'data'		=> $produk	
                ], REST_Controller::HTTP_OK);
		}else{
			$this->response([
                    'status'	=> FALSE,
                    'message'	=> 'Id Produk Tidak di Temukan'	
                ], REST_Controller::HTTP_NOT_FOUND);
		}

	}

	public function index_delete()
	{
		$id_produk = $this->delete('id_produk');

		if ($id_produk === null) {
			$this->response([
                    'status'	=> FALSE,
                    'message'	=> 'Provide an id produk!'	
                ], REST_Controller::HTTP_BAD_REQUEST);
		}else{
			if ($this->produk_model->delete_produk($id_produk) > 0 ) {
				// ok
				$this->response([
                    'status'	=> TRUE,
                    'id'		=> $id_produk,
                    'message'	=> 'Data Terhapus'	
                ], REST_Controller::HTTP_NO_CONTENT);
			}else{
				// tidak ditemukan
				$this->response([
                    'status'	=> FALSE,
                    'message'	=> 'Produk Tidak di Temukan!'	
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
	}

	public function index_post()
	{
		$data = [
			'nama_produk' 	=> $this->post('nama_produk'),
			'harga' 		=> $this->post('harga'),
			'stok' 			=> $this->post('stok')
		];

		if ($this->produk_model->post_produk($data) > 0 ) {
			$this->response([
                    'status'	=> TRUE,
                    'message'	=> 'Produk Baru di Tambahakan'	
                ], REST_Controller::HTTP_CREATED);
		}else{
				$this->response([
                    'status'	=> FALSE,
                    'message'	=> 'Gagal Menambahkan data baru!'	
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function index_put()
	{
		$id_produk = $this->put('id_produk');

		$data = [
			'id_produk'		=> $id_produk,
			'nama_produk' 	=> $this->put('nama_produk'),
			'harga' 		=> $this->put('harga'),
			'stok' 			=> $this->put('stok')
		];

		if ($this->produk_model->put_produk($data)) {
			$this->response([
                    'status'	=> TRUE,
                    'message'	=> 'Produk di Edit'	
                ], REST_Controller::HTTP_NO_CONTENT);
		}else{
				$this->response([
                    'status'	=> FALSE,
                    'message'	=> 'Gagal edit data!'	
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
	}


}

/* End of file Produk.php */
/* Location: ./application/controllers/api/Produk.php */