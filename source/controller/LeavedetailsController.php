<?php

class LeavedetailsController extends Controller
{

    function index()
    {
        $user2 = new LeavedetailsModel();
        $user_x = new RequestleaveModel();

        
        $id = Auth::user();
        $user = new RequestleaveModel();
        $leave_list = $user->where('employee_ID', $id);
        $remain_list = $user2->where('employee_ID', $id);

        $leave_list = $user_x->where('employee_ID', $id);
        $remain_list = $user2->where('employee_ID', $id);

        // echo "<pre>";
        // print_r($leave_list);
        // echo "</pre>";
        $arr1 = array();
        $arr2 = array();
        $arr3 = array();
        $sick = 0;
        $casual = 0;
        $annual = 0;

        if (boolval($leave_list)) {
            for ($i = 0; $i < sizeof($leave_list); $i++) {

                $today = date("Y-m-d");
                $new_date = $leave_list[$i]->date;
                if ($leave_list[$i]->leave_status == 'pending') {

                    $request_date = $leave_list[$i]->request_date;
                    $r_date = date_create($request_date);
                    // echo "<br> request date : ";
                    // echo $request_date;
                    // echo "<br> today :  ";
                    // echo $today;
                    $date1 = date_create($today);
                    $date2 = date_create($new_date);
                    $date_difference = date_diff( $date1,$date2);
                    $date_difference1 = date_diff($r_date,$date2);

                    // echo $date_difference . "<br>";
                    // echo "diference". $date_difference->format("%R%a days");
                    // echo "diference1". $date_difference1->format("%R%a days");

                    if ($date_difference->format("%R%a") >= 0 && $date_difference->format("%R%a") < 3 && $date_difference1->format("%R%a") > 2 ) {
                        // echo "inside if";
                        $date = $leave_list[$i]->date;
                        // echo $date;
                        // echo "<br> ";
                        // echo $id;
                        $val = $_POST['l_status'];
                        $val = "approve";

                        // echo($_POST['l_status']);

                        $user_x->updateLeave($id, $date, $val);
                    }
                }


                if ($today <= $new_date) {
                    array_push($arr1, $leave_list[$i]);
                }

                if ($leave_list[$i]->leave_status === "reject" || $leave_list[$i]->leave_status === "approve") {
                    array_push($arr2, $leave_list[$i]);
                    if ($leave_list[$i]->leave_status === "approve" && $leave_list[$i]->leave_type == "sick") {
                        $sick = $sick + 1;
                    } elseif ($leave_list[$i]->leave_status === "approve" && $leave_list[$i]->leave_type == "casual") {
                        $casual = $casual + 1;
                    } elseif ($leave_list[$i]->leave_status === "approve" && $leave_list[$i]->leave_type == "annual") {
                        $annual = $annual + 1;
                    }

                    $arr3['casual'] = $casual;
                    $arr3['annual'] = $annual;
                    $arr3['sick'] = $sick;
                }

                // echo "<pre>";
                // print_r($arr3);
                // echo "</pre>";
            }
        }

        if (sizeof($_POST) > 0) {

            if (isset($_POST['submit'])) {
                $data2 = $_POST['d_date'];
                $data1 = $id;
                $column1 = "employee_ID";
                $column2 = "date";

                // print_r($_POST);
                $query = $user_x->delete_two_and($column1, $data1, $column2, $data2);
                // print_r($query);

                if (boolval($query)) {
                    $this->redirect('LeavedetailsController');
                }
            }
        }

        if (boolval($leave_list)) {

            $sick = 0;
            $casual = 0;
            $annual = 0;
            $sick1 = 0;
            $casual1 = 0;
            $annual1 = 0;
            for ($i = 0; $i < sizeof($leave_list); $i++) {

                if ($leave_list[$i]->leave_status === "pending" || $leave_list[$i]->leave_status === "approve") {
                    array_push($arr1, $leave_list[$i]);
                }

                if($leave_list[$i]->leave_type == "sick"){
                    if($leave_list[$i]->leave_status === "approve" || $leave_list[$i]->leave_status === "pending"){
                        if($leave_list[$i]->half_time === "morning" || $leave_list[$i]->half_time === "evening"){
                            $sick = $sick + 0.5;
                        }else{
                            $sick = $sick + 1;
                        }
                    }else{
                        if($leave_list[$i]->half_time === "morning" || $leave_list[$i]->half_time === "evening"){
                            $sick1 = $sick1 - 0.5;
                        }else{
                            $sick1 = $sick1 - 1;
                        }
                    }
                }

                if($leave_list[$i]->leave_type == "annual"){
                    if($leave_list[$i]->leave_status === "approve" || $leave_list[$i]->leave_status === "pending"){
                        if($leave_list[$i]->half_time === "morning" || $leave_list[$i]->half_time === "evening"){
                            $annual = $annual + 0.5;
                        }else{
                            $annual = $annual + 1;
                        }
                    }else{
                        if($leave_list[$i]->half_time === "morning" || $leave_list[$i]->half_time === "evening"){
                            $annual1 = $annual1 - 0.5;
                        }else{
                            $annual1 = $annual1 - 1;
                        }
                    }
                }
                if($leave_list[$i]->leave_type == "casual"){
                    if($leave_list[$i]->leave_status === "approve" || $leave_list[$i]->leave_status === "pending"){
                        if($leave_list[$i]->half_time === "morning" || $leave_list[$i]->half_time === "evening"){
                            $casual = $casual + 0.5;
                        }else{
                            $casual = $casual + 1;
                        }
                    }else{
                        if($leave_list[$i]->half_time === "morning" || $leave_list[$i]->half_time === "evening"){
                            $casual1 = $casual1 - 0.5;
                        }else{
                            $casual1 = $casual1 - 1;
                        }
                    }
                }

            //     if ($leave_list[$i]->leave_status === "approve" || $leave_list[$i]->leave_status === "pending" && $leave_list[$i]->leave_type == "sick") {
            //         $sick = $sick + 1;
            //     if ($leave_list[$i]->leave_status === "approve" || $leave_list[$i]->leave_status === "pending"  && $leave_list[$i]->leave_type == "sick" && $leave_list[$i]->half_time === "morning" || $leave_list[$i]->half_time === "evening") {
            //         $sick = $sick + 0.5;
            //     }
            //  } elseif ($leave_list[$i]->leave_status === "approve" || $leave_list[$i]->leave_status === "pending"  && $leave_list[$i]->leave_type == "casual") {
            //         $casual = $casual + 1;
            //     } elseif ($leave_list[$i]->leave_status === "approve" || $leave_list[$i]->leave_status === "pending"  && $leave_list[$i]->leave_type == "casual" && $leave_list[$i]->half_time === "morning" || $leave_list[$i]->half_time === "evening") {
            //         $casual = $casual + 0.5;
            //     } elseif ($leave_list[$i]->leave_status === "approve" || $leave_list[$i]->leave_status === "pending" && $leave_list[$i]->leave_type == "annual" && $leave_list[$i]->half_time === "morning" || $leave_list[$i]->half_time === "evening") {
            //         $annual = $annual + 0.5;
            //     } elseif ($leave_list[$i]->leave_status === "approve" || $leave_list[$i]->leave_status === "pending" && $leave_list[$i]->leave_type == "annual") {
            //         $annual = $annual + 1;
            //     } elseif ($leave_list[$i]->leave_status === "reject" && $leave_list[$i]->leave_type == "casual") {
            //         $casual = $casual - 1;
            //     } elseif ($leave_list[$i]->leave_status === "reject" && $leave_list[$i]->leave_type == "casual" && $leave_list[$i]->half_time === "morning" || $leave_list[$i]->half_time === "evening") {
            //         $casual = $casual - 0.5;
            //     } elseif ($leave_list[$i]->leave_status === "reject" && $leave_list[$i]->leave_type == "annual") {
            //         $annual = $annual - 1;
            //     } elseif ($leave_list[$i]->leave_status === "reject" && $leave_list[$i]->leave_type == "annual" && $leave_list[$i]->half_time === "morning" || $leave_list[$i]->half_time === "evening") {
            //         $annual = $annual - 0.5;
            //     }

                // $arr3['casual'] = $casual;
                // $arr3['annual'] = $annual;
                // $arr3['sick'] = $sick;
                // echo "casual1" . $casual1 . "<br>";
                // echo "annual1" . $annual1 . "<br>";
                // echo "sick1" . $sick1 . "<br>";



                // print_r($arr1);
                // echo "casual" . $casual . "<br>";
                // echo "annual" . $annual . "<br>";
                // echo "sick" . $sick . "<br>";

            }
            for ($j = 0; $j < 3; $j++) {
                if ($remain_list[$j]->leave_type == 'casual') {
                    $casual_count = $remain_list[$j]->max_leave_count - $casual;
                }
                elseif ($remain_list[$j]->leave_type == 'annual') {
                    $annual_count = $remain_list[$j]->max_leave_count - $annual;
                }
                elseif ($remain_list[$j]->leave_type == 'sick') {
                    $sick_count = $remain_list[$j]->max_leave_count - $sick;
                }
            }

            $ar_casual['remain_leave_count'] = $casual_count;
            $ar_annual['remain_leave_count'] = $annual_count;
            $ar_sick['remain_leave_count'] = $sick_count;

            // echo "casual" . $casual_count . "<br>";
            // echo "annual" . $annual_count . "<br>";
            // echo "sick" . $sick_count . "<br>";


            $user2->update_condition($id, 'employee_ID', 'casual', 'leave_type', $ar_casual);
            $user2->update_condition($id, 'employee_ID', 'annual', 'leave_type', $ar_annual);
            $user2->update_condition($id, 'employee_ID', 'sick', 'leave_type', $ar_sick);
        }



        $this->view('leavedetails', ['arr1' => $arr1, 'arr2' => $arr2, 'arr3' => $arr3, 'remain' => $remain_list]);
        // private\models\LeavedetailsController.php
        // C:\xampp\htdocs\benefit\private\views\leavedetails.view.php
        // C:\xampp\htdocs\benefit\private\models\LeavedetailsModel.php
    }
}
