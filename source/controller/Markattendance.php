<?php

/**
 * PerformanceModel Controller
 */
class Markattendance extends Controller
{

    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        if (Auth::access('Supervisor')) {
            $id = auth::user();
            $user = new Employeedetails();
            $designations = new DesignationModel();
            $attendance = new AttendanceModel();
            $previous = new AttendDate();
            $leave = new LeaveapplicationModel();

            $all_emp = $user->where('supervisor_ID', $id);
            //print_r($all_emp);

            date_default_timezone_set("Asia/Colombo");
            $today = date("Y-m-d");
            //$today = "2021-12-21";

            $j=0; $k=0;
            $marked = array();
            $not_marked = array();
            $not_marked_prev = array();
            if (boolval($all_emp)) {
                for ($i = 0; $i < sizeof($all_emp); $i++) {
                    if ($all_emp[$i]->designation_code == 1) {
                        $all_emp[$i]->designation_code = 'CEO';
                    } elseif ($all_emp[$i]->designation_code == 2) {
                        $all_emp[$i]->designation_code = 'Director';
                    } elseif ($all_emp[$i]->designation_code == 3) {
                        $all_emp[$i]->designation_code = 'Manager';
                    } elseif ($all_emp[$i]->designation_code == 4) {
                        $all_emp[$i]->designation_code = 'HR Officer';
                    } elseif ($all_emp[$i]->designation_code == 5) {
                        $all_emp[$i]->designation_code = 'Employer';
                    }

                    if ($all_emp[$i]->department_ID == 1) {
                        $all_emp[$i]->department_ID = 'Operational Department';
                    } elseif ($all_emp[$i]->department_ID == 2) {
                        $all_emp[$i]->department_ID = 'HR Department';
                    } elseif ($all_emp[$i]->department_ID == 3) {
                        $all_emp[$i]->department_ID = 'Sells Department';
                    } elseif ($all_emp[$i]->department_ID == 4) {
                        $all_emp[$i]->department_ID = 'Account Department';
                    }

                    //Filter today's not marked employees
                    $array1 = $previous->where_condition('employee_ID', 'date', $all_emp[$i]->employee_ID, $today);

                    if (boolval($array1)) {
                        $not_marked[$k] = $all_emp[$i];
                        $k++;
                    }

                    $array2 = $previous->where_not('employee_ID','date',$all_emp[$i]->employee_ID,$today);
                    if(boolval($array2)){
                        for($n=0;$n<sizeof($array2);$n++){
                            $not_marked_prev[$j] = $array2[$n];
                            $not_marked_prev[$j]->profile_image = $all_emp[$i]->profile_image;
                            $not_marked_prev[$j]->designation_code = $all_emp[$i]->designation_code;
                            $j++;
                        }
                    }
                }
            }


            //Getting form data and send it to database

            if(count($_POST) > 0){
                if(isset($_POST['mark'])){
                    $checkbox = $_POST['person'];
                    $date = $_POST['date'];
                    $arrival_time = $_POST['arrival'];
                    $departure_time = $_POST['departure'];
                    $ot_hour = $_POST['ot-hours'];
                    $t1 = strtotime($arrival_time);
                    $t2 = strtotime($departure_time);
                    $hours = ($t2 - $t1)/3600;

                    foreach ($checkbox as $chk) {
                        $arr['employee_ID'] = $chk;
                        $name = $user->where('employee_ID',$chk);
                        $arr['name'] = $name[0]->first_name;
                        $arr['name'] .= " ";
                        $arr['name'] .= $name[0]->last_name;
                        $arr['date'] = $date;
                        $arr['arrival_time'] = $arrival_time;
                        $arr['departure_time'] = $departure_time;
                        $arr['ot_hours'] = $ot_hour;

                        if($hours >= '8:30'){
                            $arr['status'] = 'Yes';
                        }
                        elseif($hours == '4:00'){
                            $arr['status'] = 'Half-Day';
                        }
                        else {
                            $arr['status'] = 'No';
                        }

                        $attendance->insert($arr);
                    }
                    $this->redirect('markattendance');
                }
                elseif (isset($_POST['submit'])){
                    $id = $_POST['id'];
                    $arrival_time = $_POST['arrival'];
                    $departure_time = $_POST['departure'];
                    $t1 = strtotime($arrival_time);
                    $t2 = strtotime($departure_time);
                    $hours = ($t2 - $t1)/3600;

                    $change_attendance = new AttendanceModel();
                    $date = $_POST['date'];
                    $changed_ar['arrival_time'] = $_POST['arrival'];
                    $changed_ar['departure_time'] = $_POST['departure'];
                    $changed_ar['ot_hours'] = $_POST['ot_hours'];

                    if($hours >= '8:30'){
                        $changed_ar['status'] = 'Yes';
                    }
                    elseif($hours == '4:00'){
                        $changed_ar['status'] = 'Half-Day';
                    }
                    else {
                        $changed_ar['status'] = 'No';
                    }
                    $set = $change_attendance->update_condition($id,'employee_ID',$date,'date',$changed_ar);
                    if(isset($set)){
                        $this->redirect('markattendance');
                    }
                }
            }

            //Show attendance history
            $history = array();
            if(boolval($all_emp)) {
                for ($i = 0; $i < sizeof($all_emp); $i++) {
                    $history[$i] = $attendance->where('employee_ID',$all_emp[$i]->employee_ID);
                }
            }

            //Find today and tomorrow leaving people
            $tomorrow = date('Y-m-d', strtotime($today. ' + 1 days'));
            $today_leave = $leave->where('date', $today);
            $tomorrow_leave = $leave->where('date',$tomorrow);

            $today_info = array();
            if (boolval($today_leave)) {
                for ($i = 0; $i < sizeof($today_leave); $i++) {
                    $emp_info = $user->where('employee_ID', $today_leave[$i]->employee_ID);
                    if($emp_info[0]->supervisor_ID == auth::user()){
                        $today_info[$j] = $emp_info[0];
                        $j++;
                    }
                }
            }

            $tomorrow_info = array();
            $j=0;
            if (boolval($tomorrow_leave)) {
                for ($i = 0; $i < sizeof($tomorrow_leave); $i++) {
                    $emp_info = $user->where('employee_ID', $tomorrow_leave[$i]->employee_ID);
                    if($emp_info[0]->supervisor_ID == auth::user()){
                        $tomorrow_info[$j] = $emp_info[0];
                        $j++;
                    }
                }
            }


            $this->view('markattendance', ['not_marked'=>$not_marked, 'history'=>$history, 'previous'=>$not_marked_prev, 'today'=>$today_info, 'tomorrow'=>$tomorrow_info]);
        } else {
            $this->view('404');
        }

    }

    function absent($id=null,$date=null){
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        if (Auth::access('Supervisor')) {
            $attendance = new AttendanceModel();
            $user = new Employeedetails();
            print_r($id);
            print_r($date);
            $arr2['employee_ID'] = $id;
            $name = $user->where('employee_ID',$id);
            $arr2['name'] = $name[0]->first_name;
            $arr2['name'] .= " ";
            $arr2['name'] .= $name[0]->last_name;
            $arr2['date'] = $date;
            $arr2['arrival_time'] = '00:00:00';
            $arr2['departure_time'] = '00:00:00';
            $arr2['ot_hours'] = '0';
            $arr2['status'] = 'No';
            $attendance->insert($arr2);
            $this->redirect('markattendance');
        }
        else{
            $this->view('404');
        }
        $this->view('markattendance');
    }


}
