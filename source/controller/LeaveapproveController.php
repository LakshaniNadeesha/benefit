<?php
error_reporting(E_ERROR | E_PARSE);

class LeaveapproveController extends Controller
{

    function index()
    {

             if (!Auth::logged_in()) { 
            $this->redirect('login');
        }
        if (Auth::access('Supervisor') || Auth::access('HR Manager')) {
            $user=new Employeedetails();
            $user_x = new RequestleaveModel();
            $id=Auth::user();
            $row=$user->where('supervisor_ID',$id);
             $emp=array();
             $emps=array();

                if(boolval($row)){
                for($i = 0;$i<sizeof($row);$i++){
                    $employee_details = $user->where_condition('employee_ID','banned_employees',$row[$i]->employee_ID,0);
                    if(boolval($employee_details)){
                    $leave_details = $user_x->where_condition('employee_ID', 'leave_status', $row[$i]->employee_ID, 'Pending');
                
                    if(boolval($leave_details)){
                            //print_r($leave_details);
                            $emp[$i]['employee_ID'] = $employee_details[0]->employee_ID;
                            $emp[$i]['first_name'] = $employee_details[0]->first_name;
                            $emp[$i]['last_name'] = $employee_details[0]->last_name;
                            $emp[$i]['profile_image'] = $employee_details[0]->profile_image;
                            $empss[$i]=sizeof($leave_details);
                            //print_r($empss);
                        for($j = 0;$j<sizeof($leave_details);$j++){

                            $emp[$i]['details'][$j] = $leave_details[$j];
                              //print_r($emp)[$k]['details'][$j];
                        }
                        
                        // $i = $i+sizeof($leave_details)-1;
                       
                    }
                }
                }
                               $l=0;
                  for($i= 0;$i<sizeof($row);$i++){
                    $employee_detailss = $user->where_condition('employee_ID','banned_employees',$row[$i]->employee_ID,0);
                    if(boolval($employee_detailss)){
                        //print_r($employee_detailss);
                    $leave_detailss = $user_x->where_or_double('employee_ID', 'leave_status', $row[$i]->employee_ID, 'approve','reject');
                    //print_r($leave_detailss);
                    if(boolval($leave_detailss)){
                  
                            $emps[$l]['employee_ID'] = $employee_detailss[0]->employee_ID;
                            $emps[$l]['first_name'] = $employee_detailss[0]->first_name;
                            $emps[$l]['last_name'] = $employee_detailss[0]->last_name;
                            $emps[$l]['profile_image'] = $employee_detailss[0]->profile_image;
                            $empsss[$l]=sizeof($leave_detailss);
                        for($j = 0;$j<sizeof($leave_detailss);$j++){
                            
                            $emps[$l]['details'][$j] = $leave_detailss[$j];
                        }
               
                        // $i = $i+sizeof($leave_detailss)-1;
                        $l++;
                    }
                }
                }

            }

            
              $this->view('leaveapprove',['emp'=>$emp,'emps'=>$emps]);
        // if(count($_POST)> 0){
            // echo "jfnbnenbnoeno";
            // if(isset($_POST['button'])){

            //     echo "jfnbnenbnoeno";
            //     $date = $_POST['date'];
            //     $id = $_POST['id'];
            //     // $id1 = 'employee_ID';
            //     // $id2 = 'date';
            //     $val = 'reject';
            //     $user_x->updateLeave($id,$date,$val);

            //     echo "after user_x";
            // }
            // echo "Check post ";

            
            if(isset($_POST['submit1'])){
                // print_r($_POST);
                $date = $_POST['date'];
                $id = $_POST['id'];
                // $val = $_POST['l_status'];
                $val = "reject";

                // echo($_POST['l_status']);

                $user_x->updateLeave($id,$date,$val);

                // echo "after user_x";
            }

            if(isset($_POST['submit'])){
                // print_r($_POST);
                $date = $_POST['date'];
                $id = $_POST['id'];
                // $val = $_POST['l_status'];
                $val = "approve";

                // echo($_POST['l_status']);

                $user_x->updateLeave($id,$date,$val);
            }
        // }

        } else {
            $this->view('404');
        }
    }



}

