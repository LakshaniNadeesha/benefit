<?php

/**
 * 
 */
error_reporting(E_ERROR | E_PARSE);

class DeleteemployeeController extends Controller
{
    

    function index()
    {

        if (!isset($_SESSION)) {
            session_start();
        }

        $user = new Employeedetails();
        $data = $user->where('employee_ID', $_SESSION['id']);
        $data1 = $user->findAll();
        $id = $_SESSION['id'];

        if (count($_POST) > 0 && Auth::access('HR Manager')) {
            if (isset($_POST['delete'])) {

                $arr1['supervisor_ID'] = $_POST['supervisor_f'];

                // print_r($arr1);

                $rows = $user->update_del($id, $arr1);
                if ($rows) {
                    // echo "done /////////////////////////////////////////////////////////////";
                }

                $arr['banned_employees'] = 1;
                $row = $user->update($id, $arr);
                $user_x = new BenefitrequestModel();
                // $roww=$user_x->where_condition('employee_ID','benefit_status',$id,'pending');
                $ar['employee_ID'] = $id;
                $ar['benefit_status'] = 'Accepted';
                $rowww = $user_x->update_condition($id, 'employee_ID', 'pending', 'benefit_status', $ar);
                $user_x2 = new BenefitapplicationModel();
                $row = $user_x2->deleteper('employee_ID', $id);
                $user_x1 = new ReimbursementrequestModel();


                $this->redirect('EmployeelistController');
            }
        }
        if (isset($_POST['cancel'])) {
            $this->redirect('EmployeelistController');
        }
        if (!Auth::access('HR Manager')) {
            $this->redirect('AccesDined');
        }

        $this->view('deleteemployee', ['rows' => $data, 'rows2' => $data1]);


    }
}