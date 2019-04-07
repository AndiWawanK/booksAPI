<?php

class BooksModel extends CI_Model{
    function getBooks($id = null){
        if($id === null){
            return $this->db->get('books')->result_array();
        }else{
            return $this->db->get_where('books',['ID_books' => $id])->result_array();
        }
    }
}