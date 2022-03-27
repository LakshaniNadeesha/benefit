<?php

class Currentdataformer extends Controller
{
    // function index($nic='',$hired='',$fname='',$lname='')
    // // function index($stringa)
    // {
    //    // print_r($stringa);
    //     if (!Auth::logged_in()) {
    //         $this->redirect('login');
    //     }

    //     if (Auth::access('HR Officer') || Auth::access('HR Manager')) {
    //         $benefit = new BenefitdetailsModel();
    //         $leave = new LeavedetailsModel();
    //         $application = new BenefitapplicationModel();
    //         $user = new AddemployeeModel();

    //         $benefit_details = $benefit->findAll();
    //         $leave_details = $leave->findAll();

    //         if (count($_POST) > 0) {
    //             if (isset($_POST['submit'])) {
    //                 $arr_nic = $_POST['employee_ID']; 
    //                 $year = date('Y') . '-12-31';
    //                 $renew_date = date('Y-m-d', strtotime($year . ' + 1 days'));
    //                 $arr['renew_date'] = $renew_date;
    //                 $id = $user->where('employee_NIC',$arr_nic);
    //                 $arr['employee_ID'] = $id[0]->employee_ID;
    //                 foreach ($_POST['benefit_type'] as $key => $value1) {
    //                     $arr['benefit_ID'] = $_POST['benefit_ID'][$key];
    //                     $arr['benefit_type'] = $_POST['benefit_type'][$key];
    //                     $arr['max_amount'] = $_POST['max_amount'][$key];
    //                     $arr['remaining_amount'] = $_POST['remaining_amount'][$key];
    //                     $application->insert($arr);
    //                 }

    //                 $sick_array['employee_ID'] = $id[0]->employee_ID;
    //                 $sick_array['leave_ID'] = $_POST['sick_ID'];
    //                 $sick_array['leave_type'] = $_POST['sick'];
    //                 $sick_array['max_leave_count'] = $_POST['sick_max'];
    //                 $sick_array['remain_leave_count'] = $_POST['sick_remaining'];
    //                 $leave->insert($sick_array);

    //                 $casual_array['employee_ID'] = $id[0]->employee_ID;
    //                 $casual_array['leave_ID'] = $_POST['casual_ID'];
    //                 $casual_array['leave_type'] = $_POST['casual'];
    //                 $casual_array['max_leave_count'] = $_POST['casual_max'];
    //                 $casual_array['remain_leave_count'] = $_POST['casual_remaining'];
    //                 $leave->insert($casual_array);

    //                 $annual_array['employee_ID'] = $id[0]->employee_ID;
    //                 $annual_array['leave_ID'] = $_POST['annual_ID'];
    //                 $annual_array['leave_type'] = $_POST['annual'];
    //                 $annual_array['max_leave_count'] = $_POST['annual_max'];
    //                 $annual_array['remain_leave_count'] = $_POST['annual_remaining'];
    //                 $leave->insert($annual_array);

    //                 $this->redirect('AddemployeeRedirectController');
    //             }
    //         }

    //     }

    //     $this->view('currentdataformer', ['benefit' => $benefit_details, 'leave' => $leave_details, 'nic' => $nic, 'hired' => $hired, 'fname' => $fname, 'lname' => $lname]);

    // }
    function index($nic='',$hired='',$fname='',$lname='')
    // function index($stringa)
    {
       // print_r($stringa);
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
                    $id = $user->where('employee_NIC',$arr_nic);
                    $arr['employee_ID'] = $id[0]->employee_ID;
                    $employee_id=$id[0]->employee_ID;
                    $year = date('Y') . '-12-31';
                    $renew_date = date('Y-m-d', strtotime($year . ' + 1 days'));
                    $arr['renew_date'] = $renew_date;
                    foreach ($_POST['benefit_type'] as $key => $value1) {
                        // $arr['employee_ID']=$employee_id;
                        $arr['benefit_ID'] = $_POST['benefit_ID'][$key];
                        $arr['benefit_type'] = $_POST['benefit_type'][$key];
                        $arr['max_amount'] = $_POST['max_amount'][$key];
                        // $arr['renew_date']=$renew_date;
                        $arr['remaining_amount'] = $_POST['remaining_amount'][$key];
                        // print_r($arr);
                        $application->insert($arr);
                    }

                    $sick_array['employee_ID'] = $id[0]->employee_ID;
                    $sick_array['leave_type'] = $_POST['sick'];
                    $sick_array['max_leave_count'] = $_POST['sick_max'];
                    $sick_array['remain_leave_count'] = $_POST['sick_remaining'];
                    $leave->insert($sick_array);

                    $casual_array['employee_ID'] = $id[0]->employee_ID;
                    $casual_array['leave_type'] = $_POST['casual'];
                    $casual_array['max_leave_count'] = $_POST['casual_max'];
                    $casual_array['remain_leave_count'] = $_POST['casual_remaining'];
                    $leave->insert($casual_array);

                    $annual_array['employee_ID'] = $id[0]->employee_ID;
                    $annual_array['leave_type'] = $_POST['annual'];
                    $annual_array['max_leave_count'] = $_POST['annual_max'];
                    $annual_array['remain_leave_count'] = $_POST['annual_remaining'];
                    //$leave->insert($annual_array);
                    //print_r($arr);
//                    print_r($sick_array);
//                    print_r($casual_array);
//                    print_r($annual_array);


                   $this->redirect('FomerEmployees');
                }
            }

        }

        $this->view('currentdataformer', ['benefit' => $benefit_details, 'leave' => $leave_details, 'nic' => $nic, 'hired' => $hired, 'fname' => $fname, 'lname' => $lname]);

    }

}
