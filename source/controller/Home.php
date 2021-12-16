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

		

		$select = new AddemployeeModel();
		$oper = $select->where('department_ID',1);
		$hr = $select->where('department_ID',2);
		$sells = $select->where('department_ID',3);
		$acc = $select->where('department_ID',4);
		$arr1 = array($oper,$hr,$sells,$acc);

		$this->view('Home',['rows'=>$arr1]);


	}
}
