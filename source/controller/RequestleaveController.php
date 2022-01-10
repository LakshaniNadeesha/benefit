<?php

class RequestleaveController extends Controller{
    function index(){
        // $user = new RequestleaveModel();

        $user1 = new LeavedetailsModel();

        $data = $user1->where('employee_ID',Auth::user());

        if(count($_POST)>0)
        {
            $user = new RequestleaveModel();

            if(isset($_POST['submit']))
            {

                if ( $_POST['half_date']==null) {                
                    $arr['employee_ID'] = Auth::user();
                    $arr['leave_type'] = $_POST['leave_type'];
                    $arr['starting_date'] = $_POST['start_date'];
                    $arr['ending_date'] = $_POST['end_date'];
                    $arr['leave_status'] = "Pending";
                
                }
                if($_POST['half_date']!= null && !boolval($_POST['start_date'])){
                    $arr['employee_ID'] = Auth::user();
                    $arr['leave_type'] = $_POST['leave_type'];
                    $arr['starting_date'] = $_POST['half_date'];
                    $arr['ending_date'] = $_POST['half_date'];
                    $arr['leave_status'] = "Pending";
                    $arr['half_date'] = $_POST['half_date'];
                    $arr['half_time'] = $_POST['half_time'];
                }
                else {
                    $arr['employee_ID'] = Auth::user();
                    $arr['leave_type'] = $_POST['leave_type'];
                    $arr['starting_date'] = $_POST['start_date'];
                    $arr['ending_date'] = $_POST['end_date'];
                    $arr['leave_status'] = "Pending";
                    $arr['half_date'] = $_POST['half_date'];
                    $arr['half_time'] = $_POST['half_time'];
                }
                
                print_r($_POST);

                $user->insert($arr);
            }
            $this->view('requestleave',['rows'=>$data]);
        }else{
            $this->view('requestleave',['rows'=>$data]);
        }      
    }
    
}
