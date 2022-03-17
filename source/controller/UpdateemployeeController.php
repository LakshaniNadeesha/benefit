<?php

class UpdateemployeeController extends Controller{
    function index(){

        if(!isset($_SESSION)) { 
            session_start(); 
        } 

        
        $user = new UpdateemployeeModel();
        $data = $user->where('employee_ID',$_SESSION['id'] );
        // echo $data;
        // echo "khbkcbiik";
        $id = $_SESSION['id'];

        // unset($_SESSION['id']);
        if(count($_POST)>0){

            if(isset($_POST['submit'])){

                $arr['street'] = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING);
                $arr['city'] = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
				$arr['province'] = filter_input(INPUT_POST, 'province', FILTER_SANITIZE_STRING);
                $arr['marital_status'] = $_POST['marital'];
                $arr['contact_number'] = $_POST['contact'];
                $email =  filter_input(INPUT_POST, 'email_new', FILTER_SANITIZE_EMAIL);

                $validate = $this->email_validate($email,$user);

                if($validate){
                    $arr['email'] = filter_input(INPUT_POST, 'email_current', FILTER_SANITIZE_EMAIL);
                }else{
                    $arr['email'] = filter_input(INPUT_POST, 'email_new', FILTER_SANITIZE_EMAIL);
                }
                
                $set = $user->update($id,$arr);

                if((isset($set))){
                    $this->redirect('EmployeelistController');
                }
            }
           
        }
        if(isset($_POST['cancel'])){
            // $this->view('employeelist',['rows'=>$data]);
            $this->redirect('EmployeelistController');

    }
      
        $this->view('updateemployee',['rows'=>$data]);
        // $this->view('updateemployee');
     
    }

   

    function email_validate($email , $user){
		// $select = new AddemployeeModel();
		$validate = $user->where('email',$email);
		
		return $validate;
	}
function addfomeremp($id){

        $user=new Employeedetails();
        $data=$user->where('employee_ID',$id);
        if(count($_POST)>0){

            if(isset($_POST['submit'])){

                $arr['street'] = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING);
                $arr['city'] = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
                $arr['province'] = filter_input(INPUT_POST, 'province', FILTER_SANITIZE_STRING);
                $arr['marital_status'] = $_POST['marital'];
                $arr['contact_number'] = $_POST['contact'];
                $email =  filter_input(INPUT_POST, 'email_new', FILTER_SANITIZE_EMAIL);

                $validate = $this->email_validate($email,$user);

                if($validate){
                    $arr['email'] = filter_input(INPUT_POST, 'email_current', FILTER_SANITIZE_EMAIL);
                }else{
                    $arr['email'] = filter_input(INPUT_POST, 'email_new', FILTER_SANITIZE_EMAIL);
                }
                $arr['banned_employees']=0;
                $set = $user->update($id,$arr);

                if((isset($set))){
                    $this->redirect('EmployeelistController');
                }
            }
        }
        if(isset($_POST['cancel'])){
            // $this->view('employeelist',['rows'=>$data]);
            $this->redirect('EmployeelistController');
        }
        $this->view('updateemployee',['rows'=>$data]);
    
    }
    
}
