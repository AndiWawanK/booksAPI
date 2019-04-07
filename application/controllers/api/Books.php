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

        if($id === null){
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
}