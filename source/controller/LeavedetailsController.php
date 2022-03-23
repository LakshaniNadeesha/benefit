<?php 

class LeavedetailsController extends Controller {
    
    function index(){
        $user = new LeavedetailsModel();
        $user_x = new RequestleaveModel();

        $id = Auth::user();

        $leave_list = $user_x->where('employee_ID',$id);

   
        $arr1 = array();
        $arr2 = array();
        $arr3 = array();
        $sick = 0;
        $casual = 0;
        $annual = 0;

        if(boolval($leave_list)){
            for($i=0; $i<sizeof($leave_list); $i++){
                $today = date("Y-m-d");
                $new_date = $leave_list[$i]->date;
    
                if($today <= $new_date){
                    array_push($arr1,$leave_list[$i]);
                }

                if($leave_list[$i]->leave_status === "reject" || $leave_list[$i]->leave_status === "approve"){
                    array_push($arr2,$leave_list[$i]);
                    if($leave_list[$i]->leave_status === "approve" && $leave_list[$i]->leave_type == "sick"){
                        $sick = $sick+1;
                    }elseif($leave_list[$i]->leave_status === "approve" && $leave_list[$i]->leave_type == "casual"){
                        $casual = $casual +1;
                    }elseif($leave_list[$i]->leave_status === "approve" && $leave_list[$i]->leave_type == "annual"){
                        $annual = $annual + 1;
                    }

                    $arr3['casual'] = $casual;
                    $arr3['annual']= $annual;
                    $arr3['sick'] = $sick;
                }
            }


        }
        

        


        $this->view('leavedetails',['arr1'=>$arr1 , 'arr2'=>$arr2, 'arr3'=>$arr3]);
        // private\models\LeavedetailsController.php
        // C:\xampp\htdocs\benefit\private\views\leavedetails.view.php
        // C:\xampp\htdocs\benefit\private\models\LeavedetailsModel.php
    }
    
}