<?php

function date_calc($from_date, $to_date)
{
    $day_count = 0;
    $day_arr = array();
    array_push($day_arr, $from_date);
    while (true) {

        if ($from_date == $to_date) {
            break;
        }
        $day_count++;

        $from_date = date('Y-m-d', strtotime($from_date . "+1 days"));

        array_push($day_arr, $from_date);
    }

    return $day_arr;
}

class RequestleaveController extends Controller
{

    function index()
    {

        error_reporting(E_ERROR | E_PARSE);
        $user = new RequestleaveModel();

        $arr2 = array();
        $user1 = new AddemployeeModel();
        $user2 = new LeavedetailsModel();
        $id = Auth::user();
        $user = new RequestleaveModel();
        $leave_list = $user->where('employee_ID', $id);
        $remain_list = $user2->where('employee_ID', $id);
        $data = $user1->where('employee_ID', Auth::user());

        $arr3 = array();
        $arr1 = array();


        // echo "leavelist<pre>";
        // print_r($leave_list);
        // echo "</pre>";

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

            echo "casual" . $casual_count . "<br>";
            echo "annual" . $annual_count . "<br>";
            echo "sick" . $sick_count . "<br>";


            $user2->update_condition($id, 'employee_ID', 'casual', 'leave_type', $ar_casual);
            $user2->update_condition($id, 'employee_ID', 'annual', 'leave_type', $ar_annual);
            $user2->update_condition($id, 'employee_ID', 'sick', 'leave_type', $ar_sick);
        }

        // echo "remain list<pre>";
        // print_r($remain_list);
        // echo "</pre>";
        // $sick = 0;
        // $casual = 0;
        // $annual = 0;


        print_r($_POST);

        if (count($_POST) > 0) {



            if (isset($_POST['submit'])) {
                $date_list = array();
                $today = date("Y-m-d");

                if ($_POST['half_date'] == null) {

                    ///////////////////////   FILL WITHOUT HALF DAYS ////////////////////////
                    // print_r($_POST);
                    $arr['employee_ID'] = Auth::user();
                    $arr['leave_type'] = $_POST['leave_type'];
                    $arr['date'] = $_POST['start_date'];
                    $arr['leave_status'] = "pending";
                    $from_date = $_POST['start_date'];
                    $to_date = $_POST['end_date'];
                    $arr['request_date'] = $today;

                    // if ($from_date === $to_date) {
                    //     $date_list = $_POST['start_date'];
                    //     echo "if eka ethule";
                    // } else {
                    $date_list = date_calc($from_date, $to_date);
                    // }


                    // echo(sizeof($date_list));
                    print_r($date_list);

                    if (boolval($date_list)) {

                        for ($i = 0; $i < sizeof($date_list); $i++) {
                            // echo("size of date list ". sizeof($date_list));
                            // echo "<br>";
                            // echo $i;
                            $week_day = date_create($date_list[$i]);
                            // echo "<br>";
                            // echo "Week day ";
                            // echo date_format($week_day,"l");


                            if (date_format($week_day, "l") == "Sunday") {
                                // echo "<br>";
                                // echo "inside if condition";
                                // echo "<br>";
                                // echo date_format($week_day,"l");
                                // echo "<br>";
                                // continue;
                                // echo($i);
                                $arr2[1] = 1;


                                // echo "<br>";

                            } else {

                                // echo "else part  ";
                                // $arr2['sunday'] = 0;
                                $arr['employee_ID'] = Auth::user();
                                $arr['leave_type'] = $_POST['leave_type'];
                                $arr['date'] = $date_list[$i];

                                print_r($date_list[$i]);
                                $arr['request_date'] = $today;
                                $arr['leave_status'] = "pending";
                                $row = "date";


                                $date_exist = $this->validate('employee_ID', 'date', $arr['employee_ID'], $arr['date'], $user);

                                if (boolval($date_exist)) {
                                    $arr2['date_validation'] = $arr['date'] . " Date is already Requested";
                                    // break;  
                                } else {
                                    $user->insert($arr);
                                }

                                // print_r($arr);
                                // echo "<br>";
                                // echo "<br>";
                            }
                        }
                    }
                }

                if ($_POST['half_date'] != null && !boolval($_POST['start_date'])) {

                    //////////////////// FILL ONLY HALF DAYS LEAVE ////////////////////////

                    $arr['employee_ID'] = Auth::user();
                    $arr['leave_type'] = $_POST['leave_type'];
                    $arr['date'] = $_POST['half_date'];
                    $arr['leave_status'] = "pending";
                    $arr['request_date'] = $today;
                    if (boolval($_POST['half_time'])) {
                        $arr['half_time'] = $_POST['half_time'];
                    }
                    // $arr['half_time'] = $_POST['half_time'];
                    $row = "date";
                    $week_day = date_create($arr['date']);

                    if (date_format($week_day, "l") == "Sunday") {
                        // echo "<br>";
                        // echo "inside if condition";
                        // echo "<br>";
                        // echo date_format($week_day,"l");
                        // echo "<br>";
                        // continue;
                        $arr2[1] = 1;
                        // echo($i);
                        /////////////////// Message eka print wenna ooni.. sunday leave daanna ooni nee kiyala

                        // echo "<br>";

                    } else {
                        $date_exist = $this->validate('employee_ID', 'date', $arr['employee_ID'], $arr['date'], $user);

                        if (boolval($date_exist)) {
                            $arr2['date_validation'] = $arr['date'] . " Date is already Requested";
                            // break;  
                        } else {
                            $user->insert($arr);
                        }
                    }




                    /////// simply insert one day to data base
                } else {

                    /////////////////// FILL BOTH HALF AND FULL DAYS LEAVES ///////////////////////

                    $arr['employee_ID'] = Auth::user();
                    $arr['leave_type'] = $_POST['leave_type'];
                    $arr['date'] = $_POST['start_date'];
                    // $arr['ending_date'] = $_POST['end_date'];
                    $arr['leave_status'] = "pending";
                    $arr['date'] = $_POST['half_date'];
                    $arr['request_date'] = $today;
                    $half_date = $_POST['half_date'];
                    if (boolval($_POST['half_time'])) {
                        $arr['half_time'] = $_POST['half_time'];
                    }

                    $from_date = $_POST['start_date'];
                    $to_date = $_POST['end_date'];

                    $date_list = date_calc($from_date, $to_date);
                    array_push($date_list, $half_date);

                    // print_r($date_list);

                    // echo "Half Date is : ". $half_date;
                    $arr_end = sizeof($date_list) - 1;

                    // echo "<br>";
                    // echo $arr_end;
                    // echo "<br>";

                    for ($i = 0; $i  < $arr_end; $i++) {
                        // echo $i;
                        $arr['employee_ID'] = Auth::user();
                        $arr['leave_type'] = $_POST['leave_type'];
                        $arr['date'] = $date_list[$i];
                        $row = "date";
                        $arr['half_time'] = null;
                        $arr['leave_status'] = "pending";
                        $arr['request_date'] = $today;

                        $week_day = date_create($date_list[$i]);
                        if (date_format($week_day, "l") == "Sunday") {
                            // echo "<br>";
                            // echo "inside if condition";
                            // echo "<br>";
                            // echo date_format($week_day,"l");
                            // echo "<br>";
                            // continue;
                            // echo($i);
                            $arr2[1] = 1;


                            // echo "<br>";

                        } else {
                            $date_exist = $this->validate('employee_ID', 'date', $arr['employee_ID'], $arr['date'], $user);

                            if (boolval($date_exist)) {
                                $arr2['date_validation'] = $arr['date'] . " Date is already Requested";
                                // break;  
                            } else {
                                $user->insert($arr);
                            }
                        }



                        // print_r($arr);
                        // echo "<br>";
                        // echo "<br>";

                    }

                    // $arr['employee_ID'] = Auth::user();
                    // $arr['leave_type'] = $_POST['leave_type'];
                    // $arr['date'] = $date_list[$arr_end];

                    // if (boolval($_POST['half_time'])) {
                    //     $arr['half_time'] = $_POST['half_time'];
                    // }
                    // // $arr['half_time'] = $_POST['half_time'];
                    // $arr['leave_status'] = "pending";

                    // $row = "date";
                    // $date_exist = $this->validate($arr['date'], $user, $row);

                    // if ($date_exist) {
                    //     $arr2['date_validation'] = $arr['date'] . " Date is already Requested";

                    //     // echo "Date already leave";
                    //     // break;  
                    // } else {
                    //     $user->insert($arr);
                    //     $arr2['date_validation'] = $arr['date'] . " Date is already Requested";

                    //     if (boolval($user)) {
                    //         $this->redirect('LeavedetailsController', ['row' => $arr2]);
                    //     } else {
                    //         $this->redirect('RequestleaveController', ['row' => $arr2]);
                    //     }
                    // }


                    // print_r($arr);

                }

                // git

                // $user->insert($arr);
            }
            $this->view('requestleave', ['rows' => $data, 'row' => $arr2]);
        } else {
            $this->view('requestleave', ['rows' => $data, 'row' => $arr2]);
        }
    }

    function validate($colum1, $colum2, $data1, $data2, $user)
    {
        $validate = $user->where_condition($colum1, $colum2, $data1, $data2);
        return $validate;
    }
}
