<?php

class Approvebenefit extends Controller
{

    function index()
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        if(Auth::access('HR Manager')){
            $user_x = new BenefitrequestModel();
            $user = new Employeedetails();
            $ar = Auth::user();

            //show pending requests
            $arr = $user_x->where('benefit_status', 'pending');
            $requested = array();
            if(boolval($arr)){
                for($i = 0;$i<sizeof($arr);$i++){
                    $employee_details = $user->where('employee_ID',$arr[$i]->employee_ID);
                    $benefit_details = $user_x->where_condition('employee_ID', 'benefit_status', $arr[$i]->employee_ID, 'pending');
                    if(boolval($benefit_details)){
                        for($j = 0;$j<sizeof($benefit_details);$j++){
                            $requested[$i+$j]['first_name'] = $employee_details[0]->first_name;
                            $requested[$i+$j]['last_name'] = $employee_details[0]->last_name;
                            $requested[$i+$j]['profile_image'] = $employee_details[0]->profile_image;
                            $requested[$i+$j]['details'] = $benefit_details[$j];
                        }
                        $i = $i+sizeof($benefit_details)-1;
                    }
                }
            }


            //show handled requests
            $rejected = array();
            $accepted = array();
            $all = $user_x->findAll();
            $k = 0;
            $j = 0;
            if(boolval($all)) {
                for ($i = 0; $i < sizeof($all); $i++) {
                    if ($all[$i]->benefit_status == 'Accepted' || $all[$i]->benefit_status == 'Half-Accepted') {
                        $accepted[$j]['emp_details'] = $user->where('employee_ID', $all[$i]->employee_ID);
                        $accepted[$j]['benefit_details'] = $all[$i];
                        $j++;
                    }
                    if ($all[$i]->benefit_status == 'Rejected') {
                        $rejected[$k]['emp_details'] = $user->where('employee_ID', $all[$i]->employee_ID);
                        $rejected[$k]['benefit_details'] = $all[$i];
                        $k++;
                    }
                }
            }


            $this->view('approvebenefit', ['requested'=>$requested, 'accepted'=>$accepted, 'rejected'=>$rejected]);
        }
        else {
            $this->view('404');
        }
    }

    function accept ($id=null){
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        if(Auth::access('HR Manager')){
            $user = new BenefitrequestModel();
            $user_x = new BenefitapplicationModel();
            $benefits = new BenefitdetailsModel();

            $get_row = $user->where('report_hashing',$id);
            $relevant_benefits = $benefits->where('benefit_type',$get_row[0]->benefit_type);
            $remain = $user_x->where_condition('benefit_ID','employee_ID',$relevant_benefits[0]->benefit_ID,$get_row[0]->employee_ID);
            print_r($remain);


            $hashVal = $get_row[0]->report_hashing;
            if($remain[0]->remaining_amount >= $get_row[0]->claim_amount){
                $ar['benefit_status'] = "Accepted";
                $ar['handled_date'] = date("Y/m/d");
                $user->update_status($hashVal, 'report_hashing', $ar);
            }
            else if($remain[0]->remaining_amount == 0){
                $ar['benefit_status'] = "Rejected";
                $ar['accepted_amount'] = 0;
                $ar['handled_date'] = date("Y/m/d");
                $user->update_status($hashVal, 'report_hashing', $ar);
            }else {
                $ar['benefit_status'] = "Half-Accepted";
                $ar['accepted_amount'] = $remain[0]->remaining_amount;
                $ar['handled_date'] = date("Y/m/d");
                $user->update_status($hashVal, 'report_hashing', $ar);
            }

            $this->redirect('Approvebenefit');
        }
    }

    function reject($id=null){
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        if(Auth::access('HR Manager')){
            $user = new BenefitrequestModel();
            $get_row = $user->where('report_hashing',$id);
            $hashVal = $get_row[0]->report_hashing;
            $ar['benefit_status'] = "Rejected";
            $user->update_status($hashVal, 'report_hashing', $ar);

            $this->redirect('Approvebenefit');
        }
    }

}