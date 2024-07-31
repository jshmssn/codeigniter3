<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_Model extends CI_Model {
    function getTodo(){
        $this->db->where("valid",1);
        $result = $this->db->get("todo");
        return $result->result_array();
    }
    function insertTodo($data){
        $this->db->insert("todo",$data);
    }
    function editTodo($data,$id){
        $this->db->where("id",$id);
        $this->db->update("todo",$data);
    }
    function getTodoInfo($id){
        $this->db->where("id",$id);
        $result = $this->db->get("todo");
        return $result->row_array();
    }
}