<?php

/**
 * PerformanceModel Controller
 */
class Approvereimbursement extends Controller
{
	
	function index()
	{

		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}
		if(Auth::access('Supervisor'))
		{
			$user_x = new ReimbursementrequestModel();

			$user = new Employeedetails();
	
			$ar = Auth::user();
	
			$requested = array();
			$request_pending = array();
			$request_approve = array();
					
			$employee_details = $user->where('supervisor_ID',$ar);
			$m = 0;
			$index = 0;
			$index_approve = 0;
				if(boolval($employee_details)){
				for($k=0;$k<sizeof($employee_details);$k++){
					// print_r($employee_details[$k]);
		
			
				$reimbursement_details = $user_x->where('employee_ID',$employee_details[$k]->employee_ID);

				//print_r($reimbursement_details);
				// print_r(sizeof($reimbursement_details));

				//  $m = 0;
				if(boolval($reimbursement_details)){
					for($j = 0;$j<sizeof($reimbursement_details);$j++){
						$requested[$m+$j]['first_name'] = $employee_details[$k]->first_name;
						$requested[$m+$j]['last_name'] = $employee_details[$k]->last_name;
						$requested[$m+$j]['profile_image'] = $employee_details[$k]->profile_image;
						$requested[$m+$j]['details'] = $reimbursement_details[$j];
						// print_r($requested[$m+$j]);

						if($requested[$m+$j]['details']->reimbursement_status == 'pending'){
							$request_pending[$index] = $requested[$m+$j];
							$index = $index + 1;
							// print_r($request_pending);

						}
						else{
							$request_approve[$index_approve] = $requested[$m+$j];
							$index_approve++;
							// print_r($request_approve);
						}
					}
					$m = $m+sizeof($reimbursement_details);
				}


			}
		}
				// print_r(sizeof($requested));
				$this->view('approvereimbursement', ['requested'=>$request_pending,'requested_approve'=>$request_approve]);
		}
			else{
				$this->view('404');
			}
	} 


	function accept ($id=null){
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        if(Auth::access('Supervisor')){
            $user = new ReimbursementrequestModel();
            $get_row = $user->where('invoice_hashing',$id);
            $hashVal = $get_row[0]->invoice_hashing;
            $ar['reimbursement_status'] = "accepted";
			$ar['handled_date']=date("Y-m-d");
            $user->update_status($hashVal, 'invoice_hashing', $ar);

            $this->redirect('Approvereimbursement');
        }
    }

    function reject($id=null){
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        if(Auth::access('Supervisor')){
            $user = new ReimbursementrequestModel();
            $get_row = $user->where('invoice_hashing',$id);
            $hashVal = $get_row[0]->invoice_hashing;
            $ar['reimbursement_status'] = "rejected";
			$ar['handled_date']=date("Y-m-d");
            $user->update_status($hashVal, 'invoice_hashing', $ar);

            $this->redirect('Approvereimbursement');
        }
    }
	
}	

		


