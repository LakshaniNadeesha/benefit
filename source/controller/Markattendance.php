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
            $all_emp = $user->where('supervisor_ID', $id);
            //print_r($all_emp);

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
                //print_r($all_emp[$i]->designation_code);

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
                //print_r($all_emp[$i]->department_ID);
            }

            //Marking Attendance
            $attendance = new AttendanceModel();

            if(count($_POST) > 0){
                if(isset($_POST['submit'])){
                    $arr['employee_ID'] = $_POST['employee_ID'];
                    $arr['date'] = $_POST['date'];
                    $arr['arrival_time'] = $_POST['arrival'];
                    $arr['departure_time'] = $_POST['departure'];
                    $arr['ot_hours'] = $_POST['ot-hours'];
                    $attendance->insert($arr);
                    $this->redirect('markattendance');
                }
            }

            $this->view('markattendance', ['details'=> $all_emp]);
        } else {
            $this->view('404');
        }

    }

}
