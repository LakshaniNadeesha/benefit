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
            $row = $user->where('supervisor_ID', $id);
            $row1 = $user->where_condition('employee_ID', 'supervisor_ID', $id, 0);

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

                $l = 0;
                for ($i = 0; $i < sizeof($row); $i++) {
                    $employee_detailss = $user->where_condition('employee_ID', 'banned_employees', $row[$i]->employee_ID, 0);


                    // print_r("<br> <br>".$i . " iteration <br>");
                    // print_r("Row[" . $i . "]-> employee_ID ".$row[$i]->employee_ID . "<br>");
                    // echo "<br> Employee Details ////////////////// <pre>";
                    //     print_r($employee_details);
                    // echo "</pre> <br>";

                    if (boolval($employee_detailss[$i])) {
                        // print_r("<br>inside if condition <br>");

                        // print_r("employee_detailss[" . $i."]->employee_ID -> ".  $employee_detailss[$i]->employee_ID. "<br>");
                        $leave_detailss = $user_x->where_or_double('employee_ID', 'leave_status', $employee_detailss[$i]->employee_ID, 'approve', 'reject');
                        //print_r($leave_detailss);
                        // echo "<br> Leave Detailss ////////////////// <pre>";
                        //     print_r($leave_detailss);
                        // echo "</pre> <br>";

                        // print_r("<br> after where or double condition <br>");

                        if (($employee_detailss[$i]->employee_ID) != null) {

                            // }
                            if (boolval($leave_detailss)) {

                                $emps[$i]['employee_ID'] = $employee_detailss[$i]->employee_ID;
                                $emps[$i]['first_name'] = $employee_detailss[$i]->first_name;
                                $emps[$i]['last_name'] = $employee_detailss[$i]->last_name;
                                $emps[$i]['profile_image'] = $employee_detailss[$i]->profile_image;


                                $empsss[$i] = sizeof($leave_detailss);

                                // print_r("Size of Employee Leave array -> ".sizeof($leave_detailss));
                                for ($j = 0; $j < sizeof($leave_detailss); $j++) {

                                    // print_r("<br>Inside 2nd for Loop <br>");

                                    $emps[$i]['details'][$j] = $leave_detailss[$j];

                                    // print_r("emps[" . $i. "]['details'][".$j."] -> "); 
                                    // print_r($leave_detailss[$j]);
                                    // echo("<br><br>");
                                }

                                // $i = $i+sizeof($leave_detailss)-1;
                                $l++;
                            }
                        }
                    }
                }
                // echo "<br> Leave Detailsss ////////////////// <br><pre>";
                //         print_r($leave_detailss);
                //     echo "</pre>";

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


            if (isset($_POST['delete'])) {
                // print_r($_POST);

                $date = $_POST['date'];
                $id = $_POST['id'];
                // $val = $_POST['l_status'];
                $val = "reject";
                $reason = $_POST['reason'];
                // $reason = "mnvjbfhj";

                // echo($_POST['l_status']);

                $user_x->rejectLeave($id, $date, $val, $reason);
                // $this->redirect('Approvereimbursement');
                header("Refresh:1");

                // echo "after user_x";
            }

            if (isset($_POST['submit'])) {
                // print_r($_POST);

                $date = $_POST['date'];
                $id = $_POST['id'];
                // $val = $_POST['l_status'];
                $val = "approve";

                // echo($_POST['l_status']);

                $user_x->updateLeave($id, $date, $val);
                // $this->redirect('Approvereimbursement');
                header("Refresh:1");
            }
            // }

        } else {
            $this->view('404');
        }
    }
}
