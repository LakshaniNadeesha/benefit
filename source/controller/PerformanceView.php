<?php

/**
 * Premotion and demotion
 */
class PerformanceView extends Controller
{

    function index()
    {
        // code...
        if(Auth::access('HR Manager')) {
            $user = new Employeedetails();
            $user_x = new PerformanceModel();
            $row = $user->where('banned_employees', 0);
            if (boolval($row)) {
                for ($i = 0; $i < sizeof($row); $i++) {
                    $employee_details[$i]['first_name'] = $row[$i]->first_name;
                    $employee_details[$i]['last_name'] = $row[$i]->last_name;
                    $employee_details[$i]['gender'] = $row[$i]->gender;
                    $employee_details[$i]['employee_NIC'] = $row[$i]->employee_NIC;

                    $row1 = $user_x->where('employee_ID', $row[$i]->employee_ID);
                    if(boolval($row1)){
                    $employee_details[$i]['communication'] = $row1[0]->communication;
                    $employee_details[$i]['quality_of_work'] = $row1[0]->quality_of_work;
                    $employee_details[$i]['organization'] = $row1[0]->organization;
                    $employee_details[$i]['team_skills'] = $row1[0]->team_skills;
                    $employee_details[$i]['multitasking_ability'] = $row1[0]->multitasking_ability;
                    $employee_details[$i]['communication_overall'] = $row1[0]->communication_overall;
                    $employee_details[$i]['quality_of_work_overall'] = $row1[0]->quality_of_work_overall;
                    $employee_details[$i]['organization_overall'] = $row1[0]->organization_overall;
                    $employee_details[$i]['team_skills_overall'] = $row1[0]->team_skills_overall;
                    $employee_details[$i]['multitasking_ability_overall'] = $row1[0]->multitasking_ability_overall;
                }
            }
            }

            $this->view('performanceview', ['employee_details' => $employee_details]);
        }
        else{
            $this->view('404');
        }

    }


//    function hro()
//    {
//
//        $this->view('performanceview');
//
//    }

}
