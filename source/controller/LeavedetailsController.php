<?php

class LeavedetailsController extends Controller
{

    function index()
    {
        $user2 = new LeavedetailsModel();
        $user_x = new RequestleaveModel();

        $id = Auth::user();

        $leave_list = $user_x->where('employee_ID', $id);
        $remain_list = $user2->where('employee_ID', $id);

        // echo "<pre>";
        // print_r($remain_list);
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
                $request_date = $leave_list[$i]->request_date;
                $r_date = date_create($request_date);
                // echo "<br> request date : ";
                // echo $request_date;
                // echo "<br> ";
                $date1 = date_create($today);
                $date2 = date_create($new_date);
                $date_difference = date_diff($date2, $date1);
                $date_difference1 = date_diff($r_date,$date2);

                // echo $date_difference;
                // echo $date_difference1->format("%R%a days");
                if ($date_difference->format("%R%a") >= 0 && $date_difference->format("%R%a") < 3 && $date_difference1->format("%R%a") >2 &&  $leave_list[$i]->leave_status == "pending") {
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





        $this->view('leavedetails', ['arr1' => $arr1, 'arr2' => $arr2, 'arr3' => $arr3, 'remain'=> $remain_list ]);
        // private\models\LeavedetailsController.php
        // C:\xampp\htdocs\benefit\private\views\leavedetails.view.php
        // C:\xampp\htdocs\benefit\private\models\LeavedetailsModel.php
    }
}
