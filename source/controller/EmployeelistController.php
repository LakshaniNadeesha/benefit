<?php

class EmployeelistController extends Controller{

    function index(){

        // $user = new EmployeelistModel();
        $user = new AddemployeeModel();

        //////////////////////////////////////// department_ID come from home view/////////////////////////////////////////////

        // if(count($_POST)>0){

            if(isset($_POST['edit'])){
                // $arr['employee_ID'] = $_POST['id'];

                
                session_start(); 
                   

                $_SESSION['id'] = $_POST['id'];
                // echo $_POST['id'];

                $this->redirect('UpdateemployeeController');
            }

            if(isset($_POST['delete'])){
                // $arr['employee_ID'] = $_POST['id'];
                session_start(); 
                

                $_SESSION['id'] = $_POST['id'];

                $this->redirect('DeleteemployeeController');
            }

        // }
        
        // if(isset($_POST)>0)
        // {
        //     if(isset($_POST['submit'])){
        //         $dep = $_POST['department'];
        //         $data = $user->where('department_ID', $dep);
        //     }
        // }else{
        //     $data = $user->where('department_ID',2);
        // }
        $oper= $user->where('department_ID',1);
        $hr = $user->where('department_ID',2);
        $seles = $user->where('department_ID',3);
        $acc = $user->where('department_ID',4);
        $arr = array($oper,$hr,$seles,$acc);
        
        $this->view('employeelist',['rows'=>$arr]);
    }
}
