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

            if (count($_POST)>0){
                if(isset($_POST['submit'])){
                    $handled['handling_reason'] = $_POST['reason'];
                    $handled['handled_date'] = date("Y-m-d");
                    $id = $_POST['application_number'];
                    $accepting_amount = $_POST['accepting_amount'];
                    $claim_amount = $_POST['claim_amount'];
                    if($claim_amount > $accepting_amount){
                        $handled['accepted_amount'] = $accepting_amount;
                        $handled['benefit_status'] = "Half-Accepted";
                    }
                    else if($claim_amount < $accepting_amount){
                        $handled['accepted_amount'] = $claim_amount;
                        $handled['benefit_status'] = "Accepted";
                    }
                    else {
                        $handled['accepted_amount'] = $claim_amount;
                        $handled['benefit_status'] = "Accepted";
                    }
                    $user_x->update_status($id,'application_number',$handled);
                    $this->redirect('Approvebenefit');
                }
                else if(isset($_POST['reject'])){
                    $handled['handling_reason'] = $_POST['reason'];
                    $handled['handled_date'] = date("Y-m-d");
                    $id = $_POST['application_number'];
                    $handled['accepted_amount'] = 0;
                    $handled['benefit_status'] = "Rejected";
                    $user_x->update_status($id,'application_number',$handled);
                    $this->redirect('Approvebenefit');

                }
            }


            $this->view('approvebenefit', ['requested'=>$requested, 'accepted'=>$accepted, 'rejected'=>$rejected]);
        }
        else {
            $this->view('404');
        }
    }

    function accept(){
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        if(Auth::access('HR Manager')){
            $benefit = new BenefitrequestModel();
            if (count($_POST)>0){
                if(isset($_POST['submit'])){
                    echo "ok";
                }
                else {
                    echo "no";
                }
            }
        }
    }

}