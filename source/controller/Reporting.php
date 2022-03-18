<?php

class Reporting extends Controller
{
    function index(){
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        if(Auth::access('HR Manager')){
            $user=new ReimbursementrequestModel();
            $row1=array();
			$row1 = $user->findAll();
            // if(count($_POST)>0){
            //     $user=new ReimbursementrequestModel();
            //     if(isset($_POST['radio'])){
            //         echo "You have selected :".$_POST['radio'];
            //     }
            //     else{
            //         echo "Invaild Selection";
            //     }
            // }
            // else{
            //     echo "Error";
            // }

            $this->view('reporting',['row1'=>$row1]);
        }
        else{
            $this->view('404');
        }
    }


    function reimbursement_report(){
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        if(Auth::access('HR Manager')){
            $user=new ReimbursementrequestModel();
            $row1=array();
			$row1 = $user->findAll();
            if(count($_POST)>0){
                $user=new ReimbursementrequestModel();
                if(isset($_POST['submit'])){
                    echo "You have selected :".$_POST['radio'];
                }
                else{
                    echo "Invaild Selection";
                }
            }
            else{
                echo "Error";
            }

            $this->view('reporting',['row1'=>$row1]);
        }
        else{
            $this->view('404');
        }

    }


    function generatereport(){
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        if(Auth::access('HR Manager')){
            $this->view('generatereport');
        }
        else{
            $this->view('404');
        }
    }
}