<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Books extends REST_Controller{
    function __construct(){
        parent:: __construct();
        $this->load->model('BooksModel');
        
    }
    function index_get($id = NULL){
        
        // $id = $this->get('id');

        if($id === NULL){
            $books = $this->BooksModel->getBooks();
        }else{
            $books = $this->BooksModel->getBooks($id);
        }
        
        if($books){
            $this->response([
                'status' => true,
                'data' => $books
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Book Not Found!'
            ], REST_Controller::HTTP_NOT_FOUND);
        }

    }
    function index_post(){
        $data = [
            'Judul' => $this->post('judul'),
            'Penerbit' => $this->post('penerbit'),
            'Kategori' => $this->post('kategori'),
            'Harga' => $this->post('harga')
        ];
        
        if($this->BooksModel->addBooks($data) > 0){
            $this->response([
                'status' => true,
                'message' => 'New Books has been created!'
            ], REST_Controller::HTTP_CREATED);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Failed to created new Books!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

    }
    function index_put($id){
        $data = [
            'Judul' => $this->put('judul'),
            'Penerbit' => $this->put('penerbit'),
            'Kategori' => $this->put('kategori'),
            'Harga' => $this->put('harga')
        ];

        if($this->BooksModel->updateBooks($data, $id) > 0){
            $this->response([
                'status' => true,
                'message' => 'Books has been updated!'
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Failed to update Books!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function index_delete($id = NULL){
        if($id === NULL){
            $this->response([
                'status' => false,
                'message' => 'Provide an ID!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            if($this->BooksModel->deleteBooks($id) > 0){
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Books was deleted!'
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'message' => 'ID Not Found!'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
    
}