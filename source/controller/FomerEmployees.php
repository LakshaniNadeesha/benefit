<?php

/**
 * former employees controller
 */
class FomerEmployees extends Controller
{

    function index(){
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        $row =array();
        $user=new Employeedetails();
        $user_x=new PerformanceModel();
        $row1=$user->where('banned_employees',1);
      //  print_r($row1);
       if(boolval($row1))
       {
         for($i=0;$i<sizeof($row1);$i++)
        {
            $rows = $user_x->where('employee_ID',$row1[$i]->employee_ID);
            $row[$i]['employee_ID'] = $row1[$i]->employee_ID;
            $row[$i]['employee_NIC'] = $row1[$i]->employee_NIC;
            $row[$i]['first_name'] = $row1[$i]->first_name;
            $row[$i]['last_name'] = $row1[$i]->last_name;
            $row[$i]['gender'] = $row1[$i]->gender;
            $row[$i]['profile_image'] = $row1[$i]->profile_image;
            $row[$i]['details']=$rows[0];
        
       }
   }

       // print_r($row);
        $this->view('fomeremployees',['row'=>$row]);

    }

 
}
