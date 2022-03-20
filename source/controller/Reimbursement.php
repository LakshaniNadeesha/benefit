<?php

/**
 *
 */
class Reimbursement extends Controller
{
    function index()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        if (Auth::access('Employee') || Auth::access('Supervisor') || Auth::access('HR Officer') || Auth::access('HR Manager')) {
        $errors=array();
        $user=new ReimbursementrequestModel();
        $ar=Auth::user();
        $row=array();
        $row = $user->where('employee_ID',$ar);
        $file_error = array();


        if(count($_POST)>0)
        {
            $user=new ReimbursementrequestModel();
            if(isset($_POST['submit']))
            {
                $arr['employee_ID']=Auth::user();
                $arr['claim_date']=$_POST['claim_date'];
                $arr['claim_amount']=$_POST['claim_amount'];
                $arr['reimbursement_reason']=$_POST['subject'];
                $arr['reimbursement_status']="pending";
                $file = $_FILES['invoice_submission']['name'];
                // print_r($file);

                $target_dir = "public/reimbursement-documents/";
                $path = pathinfo($file);
                $filename = $path['filename'];
                $ext = $path['extension'];
                $temp_name = $_FILES['invoice_submission']['tmp_name'];
                $path_filename_ext = $target_dir.$filename.".".$ext;

                move_uploaded_file($temp_name, $path_filename_ext);


                $arr['invoice_submission'] = $path_filename_ext;
                $arr['invoice_hashing'] = hash_file('md5',$path_filename_ext);

                $hash_values = array();
                $all_rows = $user->findAll();
                $flag = true;
                for($i=0; $i<sizeof($all_rows);$i++){
                    $hash_values[$i] = $all_rows[$i]->invoice_hashing;
                    if($arr['invoice_hashing'] == $hash_values[$i]){
                        $flag = false;
                        break;
                    }
                }

                if($flag){
                    $user->insert($arr);
                    $this->redirect('Reimbursement');
                }
                else {
                    $errors="This invoice is already used please make sure your invoice";
                    // $file_error = "Sorry, file is already exists!";
                }

            } else {
                $errors = $user->errors;
            }

        }

        $this->view('reimbursementreq',
            ['errors'=>$errors,
                'row'=>$row]);

            } else {
                $this->view('404');
            }

    }



    function delete($id=null)
    {
        //echo "$id";

        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        $user=new ReimbursementrequestModel();
        // print_r($id);
        if(count($_POST)>0)
        {
            $user->deleteper('invoice_hashing',$id);
            $this->redirect('Reimbursement');
        }
        $this->view('reimbursementreq.delete');
    }


    function updating($id = null){
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        
        $errors=array();
        $new_arr=array();
        $user=new ReimbursementrequestModel();
        $ar=Auth::user();
        $arr = $user->where_condition('employee_ID', 'invoice_hashing', $ar, $id);
        $arr1 = $user->where('invoice_hashing',$id);
        $reim_id= $arr1[0]->reimbursement_ID;

        if (boolval($reim_id)) {
            $row = $user->where('employee_ID',$ar);
            $data= $user->where('invoice_submission',$ar);

            if(count($_POST)>0)
            {
                if(isset($_POST['submit']))
                {
                   
                    $new_arr['claim_amount']=$_POST['claim_amount'];
                    $new_arr['reimbursement_reason']=$_POST['subject'];
                    $file = $_FILES['invoice_submission']['name'];  

                    $target_dir = "public/reimbursement-documents/";
                    $path = pathinfo($file);
                    $filename = $path['filename'];
                    $ext = $path['extension'];
                    $temp_name = $_FILES['invoice_submission']['tmp_name'];
                    $path_filename_ext = $target_dir.$filename.".".$ext;
    
                    move_uploaded_file($temp_name, $path_filename_ext);
    
    
                    $new_arr['invoice_submission'] = $path_filename_ext;
                    $new_arr['invoice_hashing'] = hash_file('md5',$path_filename_ext);
    
                    $hash_values = array();
                    $all_rows = $user->findAll();
                    $flag = true;
                    for($i=0; $i<sizeof($all_rows);$i++){
                        $hash_values[$i] = $all_rows[$i]->invoice_hashing;
                        if($arr['invoice_hashing'] == $hash_values[$i]){
                            $flag = false;
                            break;
                        }
                    }
    
                    if ($flag) {
                        $user->update_status($reim_id,'reimbursement_ID',$new_arr);
                        // $user->update($ar,$arr);
                        $this->redirect('Reimbursement');
                    }
                    else {
                        $errors="This invoice is already used please make sure your invoice";
                    } 
            }
        }
        $this->view('reimbursement.update', ['errors'=>$errors,'arr'=>$arr]);

            } else {
                $this->view('404');
            }
}

}
