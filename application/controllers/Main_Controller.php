<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_Controller extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model("Main_Model","main_m");
        $this->load->library("session");
    }

	public function index()
	{
        $data['todo_list'] = $this->main_m->getTodo();
        $data['name'] = "Joshua";
		$this->load->view('main',$data);
	}
    public function submit(){
        $description = $this->input->post("description");
        $title = $this->input->post("title");
        $id = $this->input->post("chosen_id");
        $date_today = date("Y-m-d H:i:s");
        $message = "";
        if($id == 0){
            $temp['todo_title'] = $title;
            $temp['todo_description'] = $description;
            $temp['date_created'] = $date_today;
    
            $this->main_m->insertTodo($temp);
            $message = "Successfully Created a New Todo!";
        }
        else{
            $temp['todo_title'] = $title;
            $temp['todo_description'] = $description;
            $temp['date_modified'] = $date_today;
    
            $this->main_m->editTodo($temp,$id);   
            $message = "Successfully Updated a Todo!";
        }
        

        $this->session->set_flashdata("status","success");
        $this->session->set_flashdata("msg",$message);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        // echo "hello";
    }
    public function getTodoInfo(){
        $id = $this->input->post('id');

        $data = $this->main_m->getTodoInfo($id);

        echo json_encode($data);
    }
    public function delete($id = ""){

        $temp['valid'] = 0;
        $this->main_m->editTodo($temp,$id);

        $message = "Successfully Deleted a Todo!";
        $this->session->set_flashdata("status","success");
        $this->session->set_flashdata("msg",$message);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}