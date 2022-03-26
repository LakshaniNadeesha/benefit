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

if(count($_POST)>0){
    if(isset($_POST['delete'])){
        //$user=new Employeedetails();

        $arr1['supervisor_ID'] = $_POST['supervisor_f'];

        // print_r($arr1);

        $rows = $user->update_del($id,$arr1);
        if($rows){
            echo "done /////////////////////////////////////////////////////////////";
        }
        $arr['banned_employees']=1;
        $row=$user->update($id,$arr);

        //$set = $user->delete($id);
        $this->redirect('EmployeelistController');
    }
}
    if(isset($_POST['cancel'])){

        $this->redirect('EmployeelistController');
    }

    $this->view('deleteemployee',['rows'=>$data, 'rows2'=>$data1]);


}
   
}
