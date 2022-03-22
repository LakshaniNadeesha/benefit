<?php

class Outcomes extends Controller
{
	
	function index()
	{

		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}
		
		$user=new OutcomesModel();
		$row=$user->findAll();

		$this->view('outcomes',['row'=>$row]);
		
	}


	function addpost(){

		if(isset($_POST)){
			
			if(count($_POST)>0){

				$arr['title']=$_POST['title'];
				$arr['description']=$_POST['outcomes'];
				$arr['date']=$_POST['date'];
				$user=new OutcomesModel();
				$row=$user->insert($arr);
				$this->redirect('outcomes');
			}
		}

		$this->view('outcomes.addpost');
	}
	
	function updatepost($id){
		//print_r($id);
		$user=new OutcomesModel();
		$row=$user->where('post_id',$id); 
		// if(boolval($row)){
		// 	$errors="Wrong Post Edite Try agin later";
		// }
		//$row=$row[0];
		 if(isset($_POST)){
			
			if(count($_POST)>0){

				$arr['title']=$_POST['title'];
				$arr['description']=$_POST['outcomes'];
				$arr['date']=$_POST['date'];
				$user=new OutcomesModel();
				$row=$user->update_status($id,'post_id',$arr);
				$this->redirect('outcomes');
			}
		}

		$this->view('outcomesupdate',['row'=>$row]);
	}
}
