<?php

class Reporting extends Controller
{
    function index(){
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        if(Auth::access('HR Manager')){
            $user1=new ReimbursementrequestModel();
            $user2=new BenefitrequestModel();
            $user3=new AttendanceModel();
            $reim_row1=array();
            $reim_row2=array();
            $reim_row3=array();
            $current_date=date("Y-m-d");
            $cur_year=date("Y");
            $cur_month = date("m");   
            $mon_1 = $cur_month-1;
            $mon_2 = $cur_month-2;
            $mon_3 = $cur_month-3;
            $new_date1 = date_create($cur_year."-".$mon_1."-"."01");
            $new1 = date_format($new_date1,"Y-m-d");
            $new_date2 = date_create($cur_year."-".$mon_2."-"."01");
            $new2 = date_format($new_date2,"Y-m-d");
            $new_date3 = date_create($cur_year."-".$mon_3."-"."01");
            $new3 = date_format($new_date3,"Y-m-d");
            $cur_status = "accepted";
            $ot_status = 0;
            $reim_row1=$user1->find_groupby('employee_ID','handled_date','claim_amount','reimbursement_reason','reimbursement_status',$new1,$current_date,$cur_status);
            $reim_row2=$user1->find_groupby('employee_ID','handled_date','claim_amount','reimbursement_reason','reimbursement_status',$new2,$current_date,$cur_status);
            $reim_row3=$user1->find_groupby('employee_ID','handled_date','claim_amount','reimbursement_reason','reimbursement_status',$new3,$current_date,$cur_status);
            $bene_row1=$user2->find_benefit_groupby('employee_ID','handled_date','benefit_type','claim_amount','benefit_description','benefit_status',$new1,$current_date,$cur_status);
            $bene_row2=$user2->find_benefit_groupby('employee_ID','handled_date','benefit_type','claim_amount','benefit_description','benefit_status',$new2,$current_date,$cur_status);
            $bene_row3=$user2->find_benefit_groupby('employee_ID','handled_date','benefit_type','claim_amount','benefit_description','benefit_status',$new3,$current_date,$cur_status);
            $leave_row1=$user3->find_timeoff_groupby('employee_ID','name','date','ot_hours',$new1,$current_date,$ot_status);
            $leave_row2=$user3->find_timeoff_groupby('employee_ID','name','date','ot_hours',$new2,$current_date,$ot_status);
            $leave_row3=$user3->find_timeoff_groupby('employee_ID','name','date','ot_hours',$new3,$current_date,$ot_status);
           

            $this->view('reporting',['reim_row1'=>$reim_row1,'reim_row2'=>$reim_row2, 'reim_row3'=>$reim_row3,
            'bene_row1'=>$bene_row1,'bene_row2'=>$bene_row2, 'bene_row3'=>$bene_row3,
            'leave_row1'=>$leave_row1,'leave_row2'=>$leave_row2, 'leave_row3'=>$leave_row3]);
        }
        else{
            $this->view('404');
        }
    }



    function reimbursementreport1(){
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        if(Auth::access('HR Manager')){
            $user1=new ReimbursementrequestModel();
            $reim_row1=array();
            $current_date=date("Y-m-d");
            $cur_year=date("Y");
            $cur_month = date("m");   
            $mon_1 = $cur_month-1;
            $new_date1 = date_create($cur_year."-".$mon_1."-"."01");
            $new1 = date_format($new_date1,"Y-m-d");
            $cur_status = "accepted";
            $reim_row1=$user1->find_groupby('employee_ID','handled_date','claim_amount','reimbursement_reason','reimbursement_status',$new1,$current_date,$cur_status);
            $this->view('reports/reimbursementreport1',['reim_row1'=>$reim_row1]);
        }
        else{
            $this->view('404');
        }
    }

    function reimbursementreport2(){
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        if(Auth::access('HR Manager')){
            $user1=new ReimbursementrequestModel();
            $reim_row2=array();
            $current_date=date("Y-m-d");
            $cur_year=date("Y");
            $cur_month = date("m");   
            $mon_2 = $cur_month-2;
            $new_date2 = date_create($cur_year."-".$mon_2."-"."01");
            $new2 = date_format($new_date2,"Y-m-d");
            $cur_status = "accepted";
            $reim_row2=$user1->find_groupby('employee_ID','handled_date','claim_amount','reimbursement_reason','reimbursement_status',$new2,$current_date,$cur_status);
            $this->view('reports/reimbursementreport2',['reim_row2'=>$reim_row2]);
        }
        else{
            $this->view('404');
        }
    }

    function reimbursementreport3(){
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        if(Auth::access('HR Manager')){
            $user1=new ReimbursementrequestModel();
            $reim_row3=array();
            $current_date=date("Y-m-d");
            $cur_year=date("Y");
            $cur_month = date("m");   
            $mon_3 = $cur_month-3;
            $new_date3 = date_create($cur_year."-".$mon_3."-"."01");
            $new3 = date_format($new_date3,"Y-m-d");
            $cur_status = "accepted";
            $reim_row3=$user1->find_groupby('employee_ID','handled_date','claim_amount','reimbursement_reason','reimbursement_status',$new3,$current_date,$cur_status);
            $this->view('reports/reimbursementreport3',['reim_row3'=>$reim_row3]);
        }
        else{
            $this->view('404');
        }
    }

    function benefitreport1(){
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        if(Auth::access('HR Manager')){
            $user2=new BenefitrequestModel();
            $bene_row1=array();
            $current_date=date("Y-m-d");
            $cur_year=date("Y");
            $cur_month = date("m");   
            $mon_1 = $cur_month-1;
            $new_date1 = date_create($cur_year."-".$mon_1."-"."01");
            $new1 = date_format($new_date1,"Y-m-d");
            $cur_status = "accepted";
            $bene_row1=$user2->find_benefit_groupby('employee_ID','handled_date','benefit_type','claim_amount','benefit_description','benefit_status',$new1,$current_date,$cur_status);
            $this->view('reports/benefitreport1',['bene_row1'=>$bene_row1]);
        }
        else{
            $this->view('404');
        }
    }

    function benefitreport2(){
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        if(Auth::access('HR Manager')){
            $user2=new BenefitrequestModel();
            $bene_row2=array();
            $current_date=date("Y-m-d");
            $cur_year=date("Y");
            $cur_month = date("m");   
            $mon_2 = $cur_month-2;
            $new_date2 = date_create($cur_year."-".$mon_2."-"."01");
            $new2 = date_format($new_date2,"Y-m-d");
            $cur_status = "accepted";
            $bene_row2=$user2->find_benefit_groupby('employee_ID','handled_date','benefit_type','claim_amount','benefit_description','benefit_status',$new2,$current_date,$cur_status);
            $this->view('reports/benefitreport2',['bene_row2'=>$bene_row2]);
        }
        else{
            $this->view('404');
        }
    }

    function benefitreport3(){
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        if(Auth::access('HR Manager')){
            $user2=new BenefitrequestModel();
            $bene_row3=array();
            $current_date=date("Y-m-d");
            $cur_year=date("Y");
            $cur_month = date("m");   
            $mon_3 = $cur_month-3;
            $new_date3 = date_create($cur_year."-".$mon_3."-"."01");
            $new3 = date_format($new_date3,"Y-m-d");
            $cur_status = "accepted";
            $bene_row3=$user2->find_benefit_groupby('employee_ID','handled_date','benefit_type','claim_amount','benefit_description','benefit_status',$new3,$current_date,$cur_status);
            $this->view('reports/benefitreport3',['bene_row3'=>$bene_row3]);
        }
        else{
            $this->view('404');
        }
    }

    function leavereport1(){
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        if(Auth::access('HR Manager')){
            $user3=new AttendanceModel();
            $leave_row1=array();
            $current_date=date("Y-m-d");
            $cur_year=date("Y");
            $cur_month = date("m");   
            $mon_1 = $cur_month-1;
            $new_date1 = date_create($cur_year."-".$mon_1."-"."01");
            $new1 = date_format($new_date1,"Y-m-d");
            $ot_status = 0;
            $leave_row1=$user3->find_timeoff_groupby('employee_ID','name','date','ot_hours',$new1,$current_date,$ot_status);
            $this->view('reports/leavereport1',['leave_row1'=>$leave_row1]);
        }
        else{
            $this->view('404');
        }
    }

    function leavereport2(){
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        if(Auth::access('HR Manager')){
            $user3=new AttendanceModel();
            $leave_row2=array();
            $current_date=date("Y-m-d");
            $cur_year=date("Y");
            $cur_month = date("m");   
            $mon_2 = $cur_month-2;
            $new_date2 = date_create($cur_year."-".$mon_2."-"."01");
            $new2 = date_format($new_date2,"Y-m-d");
            $ot_status = 0;
            $leave_row2=$user3->find_timeoff_groupby('employee_ID','name','date','ot_hours',$new2,$current_date,$ot_status);
            $this->view('reports/leavereport2',['leave_row2'=>$leave_row2]);
        }
        else{
            $this->view('404');
        }
    }

    function leavereport3(){
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        if(Auth::access('HR Manager')){
            $user3=new AttendanceModel();
            $leave_row3=array();
            $current_date=date("Y-m-d");
            $cur_year=date("Y");
            $cur_month = date("m");   
            $mon_3 = $cur_month-3;
            $new_date3 = date_create($cur_year."-".$mon_3."-"."01");
            $new3 = date_format($new_date3,"Y-m-d");
            $ot_status = 0;
            $leave_row3=$user3->find_timeoff_groupby('employee_ID','name','date','ot_hours',$new3,$current_date,$ot_status);
            $this->view('reports/leavereport3',['leave_row3'=>$leave_row3]);
        }
        else{
            $this->view('404');
        }
    }
}