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
            $user = new Employeedetails();
            $user_x = new RequestleaveModel();
            $id = Auth::user();
            $row = $user->where('supervisor_ID', $id);  //Select All Employee Under this employee
            $row1 = $user->where_condition('employee_ID', 'supervisor_ID', $id, 0);
            // $row3 = $user->three_where_condition('employee_ID','supervisor_ID','banned_employees',$id,)

            // print_r($row1);
            // echo "<br> ////////////////// <br><pre>";
            //             print_r($row);
            //         echo "</pre>";
            // Employees under supervisor



            $emp = array();
            $emps = array();

            if (boolval($row)) {
                for ($i = 0; $i <= sizeof($row); $i++) {
                    $employee_details = $user->where_condition('employee_ID', 'banned_employees', $row[$i]->employee_ID, 0);
                    //Get unbanned employees where same supervisor
                    // echo "<pre>";
                    //     print_r($employee_details);
                    //     echo "<pre>";
                    if (boolval($employee_details)) {
                        // print_r($employee_details->employee_ID);
                        // echo "<pre>";
                        // print_r($employee_details);
                        // echo "<pre>";
                        $leave_details = $user_x->where_condition('employee_ID', 'leave_status', $employee_details[0]->employee_ID, 'pending');

                        //Get Pending leaves where employee's supervisor id same
                        // echo "leave Details ////////////////// <pre>";
                        // print_r($leave_details);
                        //  echo "</pre>";
                        if (boolval($leave_details)) {
                            // echo "<br> $i <br>";
                            //print_r($leave_details);
                            $emp[$i]['employee_ID'] = $employee_details[0]->employee_ID;
                            $emp[$i]['first_name'] = $employee_details[0]->first_name;
                            $emp[$i]['last_name'] = $employee_details[0]->last_name;
                            $emp[$i]['profile_image'] = $employee_details[0]->profile_image;
                            $empss[$i] = sizeof($leave_details);
                            //print_r($empss);
                            for ($j = 0; $j < sizeof($leave_details); $j++) {

                                $emp[$i]['details'][$j] = $leave_details[$j];
                                //print_r($emp)[$k]['details'][$j];
                            }

                            // $i = $i+sizeof($leave_details)-1;

                        }
                    }
                }

                // echo "<br> Emp ////////////////// <pre>";
                //         print_r($emp);
                //     echo "</pre> <br>";

                // $l = 0;
                for ($i = 0; $i < sizeof($row); $i++) {
                    $employee_detailss = $user->where_condition('employee_ID', 'banned_employees', $row[$i]->employee_ID, 0);

                    // echo "<br> Employee Detailss ////////////////// <pre>";
                    //     print_r($employee_detailss);
                    // echo "</pre> <br>";

                    if (boolval($employee_detailss)) {
                        // print_r("<br>inside if condition <br>");

                        // print_r("employee_detailss[" . $i."]->employee_ID -> ".  $employee_detailss[$i]->employee_ID. "<br>");
                        // echo $employee_detailss[0]->employee_ID;
                        // $leave_detailss = $user_x->where_or_double('employee_ID', 'leave_status', $employee_detailss[0]->employee_ID, 'approve', 'reject');
                        $leave_detailss = $user_x->where_not('employee_ID','leave_status',$employee_detailss[0]->employee_ID,'pending');
                        //print_r($leave_detailss);
                        // echo "<br> Leave Detailss ////////////////// <pre>";
                        //     print_r($leave_detailss);
                        // echo "</pre> <br>";

                        // echo sizeof($leave_detailss);

                        if (($employee_detailss[0]->employee_ID) != null) {

                            // }
                            if (boolval($leave_detailss)) {

                                $emps[$i]['employee_ID'] = $employee_detailss[0]->employee_ID;
                                $emps[$i]['first_name'] = $employee_detailss[0]->first_name;
                                $emps[$i]['last_name'] = $employee_detailss[0]->last_name;
                                $emps[$i]['profile_image'] = $employee_detailss[0]->profile_image;


                                $empsss[$i] = sizeof($leave_detailss);

                                // print_r("Size of Employee Leave array -> ".sizeof($leave_detailss));
                                for ($j = 0; $j < sizeof($leave_detailss); $j++) {

                                    $emps[$i]['details'][$j] = $leave_detailss[$j];
                                
                                }

                                
                            }
                        }
                    }
                }
                // echo "<br> Leave Detailsss ////////////////// <br><pre>";
                //         print_r($leave_detailss);
                //     echo "</pre>";
                // echo "<br> Emps ////////////////// <pre>";
                //         print_r($emps);
                //     echo "</pre> <br>";


            }

            function date_compare($element1, $element2)
            {
                $datetime1 = strtotime($element1['date']);
                $datetime2 = strtotime($element2['date']);
                return $datetime1 - $datetime2;
            }

            // Sort the array 
            usort($emps, 'date_compare');

            // Print the array
            // echo "<pre>";
            // print_r($emps);
            // echo "<pre/>";


            $this->view('leaveapprove', ['emp' => $emp, 'emps' => $emps]);
            


            if (isset($_POST['submit1'])) {
                print_r($_POST);

                $date = $_POST['date'];
                $id = $_POST['id'];
                
                $val = "reject";
                $reason = $_POST['reason'];
                // // $reason = "mnvjbfhj";

                // $this->redirect('AddemployeeRedirectController');

                $user_x->rejectLeave($id, $date, $val, $reason);
                $this->redirect('LeaveapproveRedirect');
                // header("Refresh:1");

                // echo "after user_x";
            }

            if (isset($_POST['submit'])) {
                print_r($_POST);

                $date = $_POST['date'];
                $id = $_POST['id'];
                // $val = $_POST['l_status'];
                $val = "approve";

                // echo($_POST['l_status']);
                // $this->redirect('AddemployeeRedirectController');

                $user_x->updateLeave($id, $date, $val);
                $this->redirect('LeaveapproveController');
                header("Refresh:1");
            }

            if(isset($_POST['table_submit'])){
                print_r($_POST);
                $date = $_POST['table_date'];
                $id = $_POST['table_id'];
                
                $val = "reject";
                $reason = $_POST['table_reason'];
                // // $reason = "mnvjbfhj";

                // $this->redirect('AddemployeeRedirectController');

                $user_x->rejectLeave($id, $date, $val, $reason);
                $this->redirect('LeaveapproveController');

            }
            // }

        } else {
            $this->view('404');
        }
    }
}
