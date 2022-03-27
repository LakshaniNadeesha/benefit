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
        // $user = new RequestleaveModel();

        $arr2 = array();
        $user1 = new AddemployeeModel();

        $data = $user1->where('employee_ID', Auth::user());

        if (count($_POST) > 0) {
            $user = new RequestleaveModel();
            $user2 = new LeavedetailsModel();

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

                    if(boolval($date_list)){};
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
                            $arr['request_date'] = $today;
                            $arr['leave_status'] = "pending";
                            $row = "date";
                            $date_exist = $this->validate($arr['date'], $user, $row);

                            if (boolval($date_exist)) {

                                // echo "Date already leave";
                                // $arr2['date_validation'] = $arr['date'] . " Date is already Requested";
                                $arr2[0] = $arr['date'] . " Date is already Requested";
                                // print_r($arr2);

                                // break;

                            }else{
                                $user->insert($arr);
                            }
                                                      
                            // print_r($arr);
                            // echo "<br>";
                            // echo "<br>";
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
                        $date_exist = $this->validate($arr['date'], $user, $row);

                        if (boolval($date_exist)) {
                            $arr2[0] =  $arr['date'] . " Date is already Requested";

                            // break;
                            // echo "Date already leave";
                            // print_r($arr2);
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
                    $arr['leave_status'] = "Pending";
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
                            $date_exist = $this->validate($arr['date'], $user, $row);

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

                    $arr['employee_ID'] = Auth::user();
                    $arr['leave_type'] = $_POST['leave_type'];
                    $arr['date'] = $date_list[$arr_end];

                    if (boolval($_POST['half_time'])) {
                        $arr['half_time'] = $_POST['half_time'];
                    }
                    // $arr['half_time'] = $_POST['half_time'];
                    $arr['leave_status'] = "Pending";

                    $row = "date";
                    $date_exist = $this->validate($arr['date'], $user, $row);

                    if ($date_exist) {
                        $arr2['date_validation'] = $arr['date'] . " Date is already Requested";

                        // echo "Date already leave";
                        // break;  
                    } else {
                        $user->insert($arr);
                        $arr2['date_validation'] = $arr['date'] . " Date is already Requested";

                        if (boolval($user)) {
                            $this->redirect('LeavedetailsController', ['row' => $arr2]);
                        } else {
                            $this->redirect('RequestleaveController', ['row' => $arr2]);
                        }
                    }


                    // print_r($arr);

                }

                // git

                // $user->insert($arr);
            }
            $this->view('requestleave', ['rows' => $data,'row'=>$arr2]);
        } else {
            $this->view('requestleave', ['rows' => $data,'row'=>$arr2]);

        }
    }

    function validate($email, $user, $row)
    {
        $validate = $user->where($row, $email);
        return $validate;
    }
}
