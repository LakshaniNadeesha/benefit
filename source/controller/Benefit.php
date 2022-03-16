<?php

/**
 *
 */
class Benefit extends Controller
{

    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $user = new BenefitrequestModel();
        $benefits = new BenefitdetailsModel();
        $info = new BenefitapplicationModel();

        $pending = array();
        $ar = auth::user();
        $pending = $user->where_condition('employee_ID', 'benefit_status', $ar, 'pending');
        $all_requests = $user->where('employee_ID', $ar);
        $j=0;
        $handled = array();
        if(boolval($all_requests)) {
            for ($i = 0; $i < sizeof($all_requests); $i++) {
                if ($all_requests[$i]->benefit_status != 'pending') {
                    $handled[$j] = $all_requests[$i];
                }
            }
        }

        $remaining = $info->where('employee_ID', $ar);
        $show = array();
        $k=0;
        for($i=0;$i<sizeof($remaining);$i++){
            $check = $benefits->where('benefit_ID', $remaining[$i]->benefit_ID);
            //print_r($check[0]->visibility);
            if($check[0]->visibility == 'Yes'){
                $show[$k] = $remaining[$i];
                //print_r($show[$k]);
                $k++;
            }
        }

        $all_details = $benefits->where('visibility', 'Yes');

        $this->view('benefit', ['pending' => $pending, 'all_details' => $all_details, 'handled' => $handled, 'show' => $show]);

    }

    function update()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        if(Auth::access('HR Manager') || Auth::access('HR Officer')){
            $benefits = new BenefitdetailsModel();
            $all_details = $benefits->findAll();
            if (count($_POST) > 0) {
                if (isset($_POST['submit'])) {
                    $code = &$_POST['benefit_code'];
                    $check = $benefits->where('benefit_code', $code);
                    print_r($check);
                    if(boolval($check)){
                        $change_benefits = new BenefitdetailsModel();

                        //$changed_arr['benefit_type'] = $_POST['benefit_type'];
                        $changed_arr['max_amount'] = $_POST['max_amount'];
                        $changed_arr['valid_months'] = $_POST['valid_months'];
                        $changed_arr['valid_years'] = $_POST['valid_years'];
                        $changed_arr['visibility'] = $_POST['visibility'];
                        $set = $change_benefits->update_status($code, 'benefit_code',$changed_arr);
                        print_r($check);
                        if(isset($set)){
                            $this->redirect('Benefit/update');
                        }
                    }
                    else{
                        $arr['benefit_type'] = $_POST['benefit_type'];
                        $arr['benefit_code'] = $_POST['benefit_code'];
                        $arr['max_amount'] = $_POST['max_amount'];
                        $arr['valid_months'] = $_POST['valid_months'];
                        $arr['valid_years'] = $_POST['valid_years'];
                        $arr['visibility'] = $_POST['visibility'];
                        $benefits->insert($arr);
                        $this->redirect('Benefit/update');
                    }

                }
            }
            $this->view('updatebenefit', ['details'=> $all_details]);
        }
        else{
            $this->view('404');
        }
    }


    function delete($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        } else if(Auth::access('HR Manager')) {
            $user = new BenefitdetailsModel();
            $user->deleteper('benefit_ID', $id);
            $this->redirect('Benefit/update');
        }
    }

    function cancel($id=null)
    {
        //echo "$id";

        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        $user=new BenefitrequestModel();
        //print_r($id);
        if(count($_POST)>0)
        {
            $user->deleteper('report_hashing',$id);
            $this->redirect('Benefit');
        }
        $this->view('benefit.delete');
    }

}
