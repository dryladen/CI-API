<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Categories extends RestController
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Categories_model', 'categories');
  }

  public function index_get()
  {
    $id = $this->get('id');
    if ($id === null) {
      $categories = $this->categories->getData();
    } else {
      $categories = $this->categories->getData($id);
    }
    if ($categories) {
      $this->response([
        'status' => true,
        'message' => "Data Tersedia",
        'categories' => $categories
      ], RestController::HTTP_OK);
    } else {
      $this->response([
        'status' => true,
        'message' => "Data Tidak Ditemukan",
      ], RestController::HTTP_NOT_FOUND);
    }
  }

  public function index_post()
  {
    $data = [
      'name' => $this->post('name')
    ];
    if ($this->categories->createData($data) > 0) {
      $this->response([
        'status' => true,
        'message' => 'Data berhasil ditambahkan'
      ], RestController::HTTP_CREATED);
    } else {
      $this->response([
        'status' => true,
        'message' => 'Data gagal ditambahkan'
      ], RestController::HTTP_BAD_REQUEST);
    }
  }

  public function index_delete()
  {
    $id = $this->delete('id');
    if ($id === null) {
      $this->response([
        'status' => true,
        'message' => "Membutuhkan id",
      ], RestController::HTTP_BAD_REQUEST);
    } else {
      $categories = $this->categories->deleteData($id);
      if ($categories) {
        $this->response([
          'status' => true,
          'message' => "Data Berhasil Dihapus",
        ], RestController::HTTP_OK);
      } else {
        $this->response([
          'status' => true,
          'message' => "Data Tidak Ditemukan",
        ], RestController::HTTP_NOT_FOUND);
      }
    }
  }

  public function index_put(){
    $id = $this->put('id');
    $data = [
      'name'=>$this->put('name')
    ];
    if ($this->categories->updateData($id,$data) > 0) {
      $this->response([
        'status' => true,
        'message' => 'Data berhasil diubah'
      ], RestController::HTTP_OK);
    } else {
      $this->response([
        'status' => true,
        'message' => 'Data gagal diubah'
      ], RestController::HTTP_BAD_REQUEST);
    }
  }
}
