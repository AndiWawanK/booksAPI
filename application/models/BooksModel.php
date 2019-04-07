<?php

class BooksModel extends CI_Model{
    function getBooks($id = null){
        if($id === null){
            return $this->db->get('books')->result_array();
        }else{
            return $this->db->get_where('books',['ID_books' => $id])->result_array();
        }
    }
    function addBooks($data){
        $this->db->insert('books', $data);
        return $this->db->affected_rows();
    }
    function updateBooks($data, $id){
        // $this->db->where('ID_books', $id);
        $this->db->update('books', $data, ['ID_books' => $id]);
        return $this->db->affected_rows();
    }
    function deleteBooks($id){
        $this->db->delete('books',['ID_books' => $id]);
        return $this->db->affected_rows();
    }
}