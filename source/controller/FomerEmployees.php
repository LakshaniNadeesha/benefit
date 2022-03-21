<?php

/**
 * former employees controller
 */
class FomerEmployees extends Controller {

function index(){
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        $row =array();

        $user=new Employeedetails();
        $row=$user->where('banned_employees',1);
        //print_r($row);
        $this->view('fomeremployees',['row'=>$row]);

    }

}
