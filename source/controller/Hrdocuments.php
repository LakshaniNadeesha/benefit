<?php

/**
 * PerformanceModel Controller
 */
class Hrdocuments extends Controller
{
	
	function index()
	{

		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}
		
			$errors=array();
			$user=new HrdocumentModel();
			$row=array();
			$row = $user->findAll();
			$file_error = array();
			$this->view('hrdocuments',
				['errors'=>$errors,
					'row'=>$row]);					
	}

	function documents(){
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}
		
		
		$this->view('hrdocumentsupdate');	
	}

function editdocuments($id = null){
		if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        
        // $errors=array();
		if (Auth::access('HR Officer') || Auth::access('HR Manager')) {
			$errors=array();
			$user=new HrdocumentModel();
        	$ar=Auth::user();
        	$arr = $user->where('document_name', $id);
			$doc_id = $arr[0]->document_ID;
			//print_r($doc_id);
			//print_r($arr);
			if(boolval($doc_id)){
				if(count($_POST)>0)
				{
					if(isset($_POST['submit']))
					{
						$new_arr['document_name']=$_POST['d_name'];
						$new_arr['updated_date']=$_POST['updated_date'];
						$file = $_FILES['document']['name'];
						//print_r($file);
		
						$target_dir = "public/documents/";
						$path = pathinfo($file);
						$filename = $path['filename'];
						$ext = $path['extension'];
						$temp_name = $_FILES['document']['tmp_name'];
						$path_filename_ext = $target_dir.$filename.".".$ext;
		
						move_uploaded_file($temp_name, $path_filename_ext);
		
		
						$arr['document_path'] = $path_filename_ext;
						$arr['document_hashing'] = hash_file('md5',$path_filename_ext);
		
						$hash_values = array();
						$all_rows = $user->findAll();
						$flag = true;
						for($i=0; $i<sizeof($all_rows);$i++){
							$hash_values[$i] = $all_rows[$i]->document_hashing;
							if($arr['document_hashing'] == $hash_values[$i]){
								$flag = false;
								break;
							}
					}
					if($flag){
						$user->update_status($doc_id,'document_ID',$new_arr);
						$this->redirect('HRdocuments/updatedocuments');
					}
					else{
						$errors="This document is already used please check document again!";
					}
				}
			}
			$this->view('hrdocumentsedit',['arr'=>$arr, 'errors'=>$errors]);
	
				} else {
					$this->view('404');
				}	
}
}


	function updatedocuments(){
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}
		
		if (Auth::access('HR Officer') || Auth::access('HR Manager')) {
			$errors=array();
			$user=new HrdocumentModel();
			// $ar=Auth::user();
			$row=array();
			$row = $user->findAll();
			$file_error = array();
	
	
			if(count($_POST)>0)
			{
				$user=new HrdocumentModel();
				if(isset($_POST['submit']))
				{
					$name = $_POST['d_name'];
					$check = $user->where('d_name',$name);
					$arr['document_name']=$_POST['d_name'];
					$arr['updated_date']=$_POST['updated_date'];
					$file = $_FILES['document']['name'];
					//print_r($file);
	
					$target_dir = "public/documents/";
					$path = pathinfo($file);
					$filename = $path['filename'];
					$ext = $path['extension'];
					$temp_name = $_FILES['document']['tmp_name'];
					$path_filename_ext = $target_dir.$filename.".".$ext;
	
					move_uploaded_file($temp_name, $path_filename_ext);
	
	
					$arr['document_path'] = $path_filename_ext;
					$arr['document_hashing'] = hash_file('md5',$path_filename_ext);
					$doc = $_POST['document_hashing'];
	
					$hash_values = array();
					$all_rows = $user->findAll();
					$flag = true;
					for($i=0; $i<sizeof($all_rows);$i++){
						$hash_values[$i] = $all_rows[$i]->document_hashing;
						if($arr['document_hashing'] == $hash_values[$i]){
							$flag = false;
							break;
						}
					}
	
					if($flag){
						$user->updatenew($name,$arr);
						$this->redirect('HRdocuments/updatedocuments');


					}
					else {
						$errors="This document is already used please check document again!";
					}
	
				} else {
					$errors = $user->errors;
				}
	
			}
	
			$this->view('hrdocumentsupdate',
				['errors'=>$errors,
					'row'=>$row]);
		
	
				} else {
					$this->view('404');
				}
	
		
		// $this->view('hrdocumentsupdate');
	}

	function delete($id=null)
    {

        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        $user=new HrdocumentModel();
        if(count($_POST)>0)
        {
            $user->deleteper('document_hashing',$id);
            $this->redirect('HRdocuments/updatedocuments');
        }
        $this->view('hrdocuments.delete');
    }

	function add(){
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}
		if (Auth::access('HR Officer') || Auth::access('HR Manager')) {
			$errors=array();
			$user=new HrdocumentModel();
			$row=array();
			$file_error = array();
	
	
			if(count($_POST)>0)
			{
				$user=new HrdocumentModel();
				if(isset($_POST['submit']))
				{
					$arr['document_name']=$_POST['d_name'];
					$arr['updated_date']=$_POST['updated_date'];
					$file = $_FILES['document']['name'];
					//print_r($file);
	
					$target_dir = "public/documents/";
					$path = pathinfo($file);
					$filename = $path['filename'];
					$ext = $path['extension'];
					$temp_name = $_FILES['document']['tmp_name'];
					$path_filename_ext = $target_dir.$filename.".".$ext;
	
					move_uploaded_file($temp_name, $path_filename_ext);
	
	
					$arr['document_path'] = $path_filename_ext;
					$arr['document_hashing'] = hash_file('md5',$path_filename_ext);
	
					$hash_values = array();
					$all_rows = $user->findAll();
					$flag = true;
					for($i=0; $i<sizeof($all_rows);$i++){
						$hash_values[$i] = $all_rows[$i]->document_hashing;
						if($arr['document_hashing'] == $hash_values[$i]){
							$flag = false;
							break;
						}
					}
	
					if($flag){
						$user->insert($arr);
						$this->redirect('HRdocuments/updatedocuments');

					}
					else {
						$errors="This document is already used please check document again!";
					}
	
				} else {
					$errors = $user->errors;
				}
	
			}
	
			$this->view('hrdocumentsadd',
				['errors'=>$errors,
					'row'=>$row]);
	
				} else {
					$this->view('404');
				}
	
	}

}