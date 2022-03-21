<?php

/**
 * 
 */
class DeleteemployeeController extends Controller
{
	
	function index()
	{

        if(!isset($_SESSION)){
            session_start();
        }

		$user = new UpdateemployeeModel();
        $data = $user->where('employee_ID',$_SESSION['id'] );
        $data1 = $user->findAll();
        $id = $_SESSION['id'];
		
   if(isset($_POST['delete'])){
            //$user=new Employeedetails();
            $arr['banned_employees']=1;
            $row=$user->update($id,$arr);
            //$set = $user->delete($id);
            $this->redirect('EmployeelistController');
        }

        if(isset($_POST['cancel'])){
            $this->redirect('EmployeelistController');
        }

		$this->view('deleteemployee',['rows'=>$data, 'rows2'=>$data1]);

	}
}
