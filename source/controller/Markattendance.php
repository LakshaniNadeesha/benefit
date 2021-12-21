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
            $user = new EmployeelistModel();
            $designations = new DesignationModel();
            $attendance = new AttendanceModel();

            $all_emp = $user->where('supervisor_ID', $id);
            //print_r($all_emp);

            $today = date("Y-m-d");
            //$today = "2021-12-21";

            $j=0; $k=0;
            $marked = array();
            $not_marked = array();
            for($i=0;$i<sizeof($all_emp);$i++){
                if($all_emp[$i]->designation_code == 1){
                    $all_emp[$i]->designation_code = 'CEO';
                }
                elseif ($all_emp[$i]->designation_code == 2){
                    $all_emp[$i]->designation_code = 'Director';
                }
                elseif ($all_emp[$i]->designation_code == 3){
                    $all_emp[$i]->designation_code = 'Manager';
                }
                elseif ($all_emp[$i]->designation_code == 4){
                    $all_emp[$i]->designation_code = 'HR Officer';
                }
                elseif ($all_emp[$i]->designation_code == 5){
                    $all_emp[$i]->designation_code = 'Employer';
                }

                if($all_emp[$i]->department_ID == 1){
                    $all_emp[$i]->department_ID = 'Operational Department';
                }
                elseif ($all_emp[$i]->department_ID == 2){
                    $all_emp[$i]->department_ID = 'HR Department';
                }
                elseif ($all_emp[$i]->department_ID == 3){
                    $all_emp[$i]->department_ID = 'Sells Department';
                }
                elseif ($all_emp[$i]->department_ID == 4){
                    $all_emp[$i]->department_ID = 'Account Department';
                }

                //Filter today's not marked employees
                $array1 = $attendance->where_condition('employee_ID','date',$all_emp[$i]->employee_ID,$today);

                if(boolval($array1)){
                    //$marked[$j] = $all_emp[$i];
                    //$j++;
                    continue;
                }
                else {
                    $not_marked[$k] = $all_emp[$i];
                    $k++;
                }
            }


            //Getting form data and send it to database

            if(count($_POST) > 0){
                if(isset($_POST['submit'])){
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
                elseif (isset($_POST['change'])){
                    $change_attendance = new AttendanceModel();
                    $date = $_POST['date'];
                    $id = $_POST['emp_name'];
                    $changed_ar['arrival_time'] = $_POST['arrival'];
                    $changed_ar['departure_time'] = $_POST['departure'];
                    $changed_ar['ot_hours'] = $_POST['ot_hours'];
                    print_r($changed_ar);
                    $set = $change_attendance->update_condition($id,'employee_ID',$date,'date',$changed_ar);
                    if(isset($set)){
                        $this->redirect('markattendance');
                    }
                }
            }

            //Show attendance history
            $history = $attendance->findAll();

            $this->view('markattendance', ['not_marked'=>$not_marked, 'history'=>$history]);
        } else {
            $this->view('404');
        }

    }


}
