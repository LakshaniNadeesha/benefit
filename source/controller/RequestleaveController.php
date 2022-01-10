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
                print_r($_POST);
                $arr['employee_ID'] = Auth::user();
                $arr['leave_type'] = $_POST['leave_type'];
                $arr['starting_date'] = $_POST['start_date'];
                $arr['ending_date'] = $_POST['end_date'];
                $arr['leave_status'] = "Pending";
                
                // if(boolval($_POST['half_date']) || boolval($_POST['half_time'])){
                //     $arr['half_date'] = $_POST['half_date'];
                //     $arr['half_time'] = $_POST['half_time'];
                // }
                $arr['half_date'] = $_POST['half_date'];
                $arr['half_time'] = $_POST['half_time'];
                if($arr['starting_date'] == null && $arr['half_date'] != null){
                    $arr['starting_date'] = $_POST['half_date'];
                    $arr['ending_date'] = $_POST['half_date'];
                }
                $user->insert($arr);
            }
            $this->view('requestleave',['rows'=>$data]);
        }else{
            $this->view('requestleave',['rows'=>$data]);
        }      
    }
    
}