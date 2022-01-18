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
            $k=0;
                if(boolval($row)){
                for($i = 0;$i<sizeof($row);$i++){
                    // $employee_details = $user->where_condition('employee_ID','banned_employees',$row[$i]->employee_ID,0);

                    $employee_details = $user->where('employee_ID', $row[$i]->employee_ID );
                    if(boolval($employee_details)){
                    $leave_details = $user_x->where_condition('employee_ID', 'leave_status', $row[$i]->employee_ID, 'Pending');
                    if(boolval($leave_details)){
                  
                        for($j = 0;$j<sizeof($leave_details);$j++){
                            $emp[$k]['employee_ID'] = $employee_details[0]->employee_ID;
                            $emp[$k]['first_name'] = $employee_details[0]->first_name;
                            $emp[$k]['last_name'] = $employee_details[0]->last_name;
                            $emp[$k]['profile_image'] = $employee_details[0]->profile_image;
                            $emp[$k]['details'] = $leave_details[$j];
                        }
               
                        $i = $i+sizeof($leave_details)-1;
                        $k++;
                    }
                }
                }
                $l=0;
                  for($i= 0;$i<sizeof($row);$i++){
                    // $employee_detailss = $user->where_condition('employee_ID','banned_employees',$row[$i]->employee_ID,0);
                    $employee_detailss = $user->where('employee_ID', $row[$i]->employee_ID );

                    if(boolval($employee_detailss)){
                    $leave_detailss = $user_x->where_condition('employee_ID', 'leave_status', $row[$i]->employee_ID, 'Success');
                    if(boolval($leave_detailss)){
                  
                        for($j = 0;$j<sizeof($leave_detailss);$j++){
                            $emps[$l]['employee_ID'] = $employee_details[0]->employee_ID;
                            $emps[$l]['first_name'] = $employee_details[0]->first_name;
                            $emps[$l]['last_name'] = $employee_details[0]->last_name;
                            $emps[$l]['profile_image'] = $employee_details[0]->profile_image;
                            $emps[$l]['details'] = $leave_detailss[$l];
                        }
               
                        $i = $i+sizeof($leave_detailss)-1;
                        $l++;
                    }
                }
                }

            }
        $this->view('leaveapprove',['emp'=>$emp,'emps'=>$emps]);
        } else {
            $this->view('404');
        }
    }



}

