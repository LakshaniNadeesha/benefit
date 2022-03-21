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
                    //$performance_details = $user_x->where_condition('employee_ID', 'date', $row[$i]->employee_ID, 0);

                    $performance_details = $user_x->where('employee_ID', $row[$i]->employee_ID);
                    if($performance_details[0]->date==0 || $performance_details[0]->date <=date("U")){ 
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
            }


            
            $handle = array();
            $handled = array();
            // $all = $user_x->findAll();
            $j = 0;

		$user_n=new EmployeelistModel();
		$user_s = new PerformanceModel();
		$id=Auth::user();
		$row=$user->where('supervisor_ID',$id);
		$l=0;
            if(boolval($row)){
            	for($q = 0;$q<sizeof($row);$q++){
                    $employee_details = $user_n->where_condition('employee_ID','banned_employees',$row[$q]->employee_ID,0);
                    if(boolval($employee_details)){
                    	$performance_details = $user_s->where('employee_ID', $row[$q]->employee_ID);
                   			 if( $performance_details[0]->date >date("U")){ 
                   					 if(boolval($performance_details)){
                   					 	for ($k=0; $k <sizeof($performance_details) ; $k++) { 
              							 $handle1= $user_n->where('employee_ID',$row[$q]->employee_ID);
             							 $handled[$l]['employee_ID']=$handle1[0]->employee_ID;
                   					     $handled[$l]['first_name'] = $handle1[0]->first_name;
                     					 $handled[$l]['last_name'] = $handle1[0]->last_name;
                  					     $handled[$l]['details'] = $performance_details[$k];
                  					 }
                  					 $l++;
                   					
					
              }
          }
      }
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
				$row=$user->where('employee_ID',$id);
				$count=$row[0]->count;
				if($count==0){

					if(count($_POST)>0 && $user->validate($_POST))
					{
						$data['communication']=$_POST['communication'];
						$data['quality_of_work']=$_POST['quality_of_work'];
						$data['organization']=$_POST['organization'];
						$data['team_skills']=$_POST['team_skills'];
						$data['multitasking_ability']=$_POST['multitasking_ability'];
						$data['communication_overall']=$_POST['communication'];
						$data['quality_of_work_overall']=$_POST['quality_of_work'];
						$data['organization_overall']=$_POST['organization'];
						$data['team_skills_overall']=$_POST['team_skills'];
						$data['multitasking_ability_overall']=$_POST['multitasking_ability'];
						date_default_timezone_set('Asia/Colombo');
						$data['last_modifydate'] = date("Y/m/d");
						$data['date']=date("U")+7890000;
						$data['count']=1;
						$row=$user->update($id,$data);
						$this->redirect('Supervisor');
					}
					else
					{
						$errors = $user->errors;
					}
				}
				if($count>=1)
				{
					$row=$row[0];
					if(count($_POST)>0 && $user->validate($_POST))
					{
						$new_count=$count+1;
						//print_r($new_count);
						$data['communication']=$_POST['communication'];
						$data['quality_of_work']=$_POST['quality_of_work'];
						$data['organization']=$_POST['organization'];
						$data['team_skills']=$_POST['team_skills'];
						$data['multitasking_ability']=$_POST['multitasking_ability'];
						$data['communication_overall']=($_POST['communication']+($count*$row->communication_overall))/$new_count;
						$data['quality_of_work_overall']=($_POST['quality_of_work']+($count*$row->quality_of_work_overall))/$new_count;
						$data['organization_overall']=($_POST['organization']+($count*$row->organization_overall))/$new_count;
						$data['team_skills_overall']=($_POST['team_skills']+($count*$row->team_skills_overall))/$new_count;
						$data['multitasking_ability_overall']=($_POST['multitasking_ability']+($count*$row->multitasking_ability_overall))/$new_count;

						$data['date']=date("U")+7890000;
						date_default_timezone_set('Asia/Colombo');
						$data['last_modifydate'] = date("Y/m/d");
						$data['count']=$new_count;
						//$data['count']=1;
						$row=$user->update($id,$data);
						$this->redirect('Supervisor');
						

					}
					else
					{
						$errors = $user->errors;
					}
				}
		$this->view('addperformance',['errors'=>$errors]);
		}
		else{
			$this->view('404');
		}
	}


//Insert Funtion should be remove.Because  lack  of use,(using a triger can insert a new employee)


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

				if($row =$user->where('employee_ID',$id))
				{
					$errors['err']="This employee alredy has a recode you can only update";
					$this->view('addperformance',['errors'=>$errors]);
					exit();
				
				}


				
				if(count($_POST)>0 && $user->validate($_POST)){
									$data['employee_ID']=$id;
					$data['communication']=null;
					$data['quality_of_work']=null;
					$data['organization']=null;
					$data['team_skills']=null;
					$data['multitasking_ability']=null;
					$data['date']=date("U")+7890000;
					date_default_timezone_set('Asia/Colombo');
					$data['last_modifydate'] = date("Y/m/d");
				
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
//
	
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
					$data['communication']=null;
					$data['quality_of_work']=null;
					$data['organization']=null;
					$data['team_skills']=null;
					$data['multitasking_ability']=null;
					$data['date']=date("U")+7890000;
					date_default_timezone_set('Asia/Colombo');
					$data['last_modifydate'] = date('Y/m/d');
					$row=$user->update($id,$data);
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

