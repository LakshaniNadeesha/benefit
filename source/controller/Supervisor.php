<?php

/**
 * Supervisor Controller
 */
class Supervisor extends Controller
{
	
	function index()
	{

		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}
		if(Auth::access('Supervisor'))
		{
		
		$this->view('approvereimbursement');
		}
		else{
			$this->view('404');
		}
	}
	
	function Performance()
	{

		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}
		if(Auth::access('Supervisor'))
		{
		$user=new EmployeelistModel();
		$user_x = new PerformanceModel();
		$id=Auth::user();
		$row=$user->where('supervisor_ID',$id);
		$emp=array();
		$k=0;
		if(boolval($row)){
                for($i = 0;$i<sizeof($row);$i++){
                    $employee_details = $user->where_condition('employee_ID','banned_employees',$row[$i]->employee_ID,0);
                    if(boolval($employee_details)){
                    $performance_details = $user_x->where_condition('employee_ID', 'date', $row[$i]->employee_ID, 0);
                    if(boolval($performance_details)){
                  
                        for($j = 0;$j<sizeof($performance_details);$j++){
                        	$emp[$k]['employee_ID'] = $employee_details[0]->employee_ID;
                            $emp[$k]['first_name'] = $employee_details[0]->first_name;
                            $emp[$k]['last_name'] = $employee_details[0]->last_name;
                            $emp[$k]['profile_image'] = $employee_details[0]->profile_image;
                            $emp[$k]['details'] = $performance_details[$j];
                        }
               
                        $i = $i+sizeof($performance_details)-1;
                        $k++;
                    }
                }
                }
            }


            
            $handle = array();
            $handled = array();
            $all = $user_x->findAll();
            $j = 0;
            
            for($i=0;$i<sizeof($all);$i++){
                if( $all[$i]->date<date("U") &&$all[$i]->date>0  ){
                    $handle = $user->where('employee_ID',$all[$i]->employee_ID);
                    $emp[$k]['employee_ID']=$handle[0]->employee_ID;
                   
                    $emp[$k]['first_name'] = $handle[0]->first_name;
                    $emp[$k]['last_name'] = $handle[0]->last_name;
                    $emp[$k]['profile_image'] =$handle[0]->profile_image;
                    $emp[$k]['details'] = $all[$i];
                    //$handle[$k]['details'] = $all[$i];
                    $k++;
                }
                
            }

            $q=0;
            $handle1=array();
             for($i=0;$i<sizeof($all);$i++){
             	 if($all[$i]->date>date("U") ){
            	$handle1= $user->where('employee_ID',$all[$i]->employee_ID);
            		$handled[$q]['employee_ID']=$handle1[0]->employee_ID;
                    $handled[$q]['first_name'] = $handle1[0]->first_name;
                    $handled[$q]['last_name'] = $handle1[0]->last_name;
               
                    $handled[$q]['details'] = $all[$i];
                   // print_r($handled[$q]['details']);
                    $q++;

             }
         }

		$this->view('supervisorviewperformance',['emp'=>$emp,
													'handled'=>$handled]);
		}
		else{
			$this->view('404');
		}
	}

	function Update_Performance($id=null)
	{
		$errors=array();

		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}
		if(Auth::access('Supervisor'))
		{
				$user= new PerformanceModel();
				if(count($_POST)>0 && $user->validate($_POST)){
				if($_POST['communication']==1)
				{
					$data['communication']=$_POST['communication']=0;
				}
				else{
					$data['communication']=$_POST['communication'];
				}
				if ($_POST['quality_of_work']==1) {
					$data['quality_of_work']=$_POST['quality_of_work']=0;
				}
				else{
					$data['quality_of_work']=$_POST['quality_of_work'];
				}
				if ($_POST['organization']==1) {
					$data['organization']=$_POST['organization']=0;
				}
				else{
					$data['organization']=$_POST['organization'];
				}
				if ($_POST['team_skills']==1) {
					$data['team_skills']=$_POST['team_skills']=0;
				}
				else{
					$data['team_skills']=$_POST['team_skills'];
				}
				if ($_POST['multitasking_ability']==1) {
					$data['multitasking_ability']=$_POST['multitasking_ability']=0;
				}
				else{
					$data['multitasking_ability']=$_POST['multitasking_ability'];
				}
				date_default_timezone_set('Asia/Colombo');
				$data['last_modifydate'] = date('Y/d/m');
				$data['date']=date("U")+131400;
				$row=$user->update($id,$data);
				//$this->redirect('Supervisor');
				}
				else{
					$errors = $user->errors;
				}
		$this->view('addperformance',['errors'=>$errors]);
		}
		else{
			$this->view('404');
		}
	}

	function Insert_Performance($id=null)
	{
		$errors=array();

		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}
		if(Auth::access('Supervisor'))
		{
			
				$user= new PerformanceModel();

				if($row =$user->where('employee_ID',$id)){
				$errors['err']="This employee alredy has a recode you can only update";
				$this->view('addperformance',['errors'=>$errors]);
				
				exit();
				
				}
				
				if(count($_POST)>0 && $user->validate($_POST)){
				$data['employee_ID']=$id;
				if($_POST['communication']==1)
				{
					$data['communication']=$_POST['communication']=0;
				}
				else{
					$data['communication']=$_POST['communication'];
				}
				if ($_POST['quality_of_work']==1) {
					$data['quality_of_work']=$_POST['quality_of_work']=0;
				}
				else{
					$data['quality_of_work']=$_POST['quality_of_work'];
				}
				if ($_POST['organization']==1) {
					$data['organization']=$_POST['organization']=0;
				}
				else{
					$data['organization']=$_POST['organization'];
				}
				if ($_POST['team_skills']==1) {
					$data['team_skills']=$_POST['team_skills']=0;
				}
				else{
					$data['team_skills']=$_POST['team_skills'];
				}
				if ($_POST['multitasking_ability']==1) {
					$data['multitasking_ability']=$_POST['multitasking_ability']=0;
				}
				else{
					$data['multitasking_ability']=$_POST['multitasking_ability'];
				}
				date_default_timezone_set('Asia/Colombo');
				$data['last_modifydate'] = date('Y/d/m');
				$data['date']=date("U")+131400;
				$row=$user->insert($data);
				//$this->redirect('Supervisor');
				}
				else
 				{
 				//errors
 				$errors = $user->errors;
 				}
		$this->view('addperformance',['errors'=>$errors]);
		}
		else{
			$this->view('404');
		}
	}

	
	function Delete_Performance($id=null)
	{
			$errors=array();
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}
		if(Auth::access('Supervisor'))
		{
				
			if(count($_POST)>0)
			{
				$user= new PerformanceModel();
				$row=$user->where('employee_ID',$id);
				if(!empty($row)){
					$data['employee_ID']=$id;
					$data['quality_of_work']=null;
					$data['quality_of_work']=null;
					$data['organization']=null;
					$data['team_skills']=null;
					$data['multitasking_ability']=null;
				$this->redirect('Supervisor');
				}
				else{
					$errors="This employee dosen't have a recodes yet";
				}
			}
		$this->view('supervisorviewperformance.delete',['errors'=>$errors]);
		}
		else{
			$this->view('404');
		}
	}

	

}
