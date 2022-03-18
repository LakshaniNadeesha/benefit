<?php

class Currentdata extends Controller
{
    function index($nic='',$hired='',$fname='',$lname='')
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        if (Auth::access('HR Officer') || Auth::access('HR Manager')) {
            $benefit = new BenefitdetailsModel();
            $leave = new LeavedetailsModel();
            $application = new BenefitapplicationModel();
            $user = new AddemployeeModel();

            $benefit_details = $benefit->findAll();
            $leave_details = $leave->findAll();

            if (count($_POST) > 0) {
                if (isset($_POST['submit'])) {
                    $arr_nic = $_POST['employee_ID'];
                    $year = date('Y') . '-12-31';
                    $renew_date = date('Y-m-d', strtotime($year . ' + 1 days'));
                    $arr['renew_date'] = $renew_date;
                    $id = $user->where('employee_NIC',$arr_nic);
                    $arr['employee_ID'] = $id[0]->employee_ID;
                    foreach ($_POST['benefit_type'] as $key => $value1) {
                        $arr['benefit_ID'] = $_POST['benefit_ID'][$key];
                        $arr['benefit_type'] = $_POST['benefit_type'][$key];
                        $arr['max_amount'] = $_POST['max_amount'][$key];
                        $arr['remaining_amount'] = $_POST['remaining_amount'][$key];
                        $application->insert($arr);
                    }
                    $this->redirect('AddemployeeRedirectController');
                }
            }

        }

        $this->view('currentdata', ['benefit' => $benefit_details, 'leave' => $leave_details, 'nic' => $nic, 'hired' => $hired, 'fname' => $fname, 'lname' => $lname]);
    }
}

