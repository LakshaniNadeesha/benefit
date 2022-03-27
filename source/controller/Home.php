<?php

/**
 * home controller
 */
class Home extends Controller
{
	
	function index()
	{
		// code...
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}
		$id = Auth::user();
		$select = new AddemployeeModel();
		$user=new Employeedetails();
		$row1 = $user->where_condition('employee_ID','supervisor_ID',$id,0);
		
		// echo "<pre>";
		// print_r($row1);
		// echo "</pre>";
		if(boolval($row1)){
			if($row1[0]->supervisor_ID == 0 ){
				$arr['supervisor_ID'] = $id;
				$select->update_status($id,"employee_ID",$arr);
			}
		}
		

		$oper = $select->where('department_ID',1);
		$hr = $select->where('department_ID',2);
		$sells = $select->where('department_ID',3);
		$acc = $select->where('department_ID',4);
		$arr1 = array($oper,$hr,$sells,$acc);

		$this->view('Home',['rows'=>$arr1]);


	}
}
