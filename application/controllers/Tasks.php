<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Tasks extends RestController
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('tasks_model', 'tasks');
  }

  public function index_get()
  {
    $id = $this->get('id');
    if ($id === null) {
      $tasks = $this->tasks->getData();
    } else {
      $tasks = $this->tasks->getData($id);
    }
    if ($tasks) {
      $this->response([
        'status' => true,
        'message' => "Data Tersedia",
        'tasks' => $tasks
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
      'category_id' => $this->post('category_id'),
      'title' => $this->post('title'),
      'description' => $this->post('description'),
      'start_date' => $this->post('start_date'),
      'finish_date' => $this->post('finish_date'),
      'status' => $this->post('status'),
      'doc_url' => $this->post('doc_url')
    ];
    if ($this->tasks->createData($data) > 0) {
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
      $tasks = $this->tasks->deleteData($id);
      if ($tasks) {
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
      'category_id' => $this->put('category_id'),
      'title' => $this->put('title'),
      'description' => $this->put('description'),
      'start_date' => $this->put('start_date'),
      'finish_date' => $this->put('finish_date'),
      'status' => $this->put('status'),
      'doc_url' => $this->put('doc_url')
    ];
    if ($this->tasks->updateData($id,$data) > 0) {
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
