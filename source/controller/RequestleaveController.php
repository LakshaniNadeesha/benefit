<?php

function date_calc($from_date , $to_date)
{
    $day_count = 0;
    $day_arr = array();
    array_push($day_arr,$from_date);
    while(true)
    {
        $day_count++;

        $from_date = date('Y-m-d', strtotime($from_date. "+1 days"));

        array_push($day_arr,$from_date);

        if($from_date == $to_date)
        {
            break;
        }
    }

    return $day_arr;
}

class RequestleaveController extends Controller{

    function index(){
        // $user = new RequestleaveModel();

        $user1 = new AddemployeeModel();

        $data = $user1->where('employee_ID',Auth::user());

        if(count($_POST)>0)
        {
            $user = new RequestleaveModel();
            $user2 = new LeavedetailsModel();

            if(isset($_POST['submit']))
            {
                $date_list = array();

                if ( $_POST['half_date']==null) {          
                    
                    ///////////////////////   FILL WITHOUT HALF DAYS ////////////////////////

                    $arr['employee_ID'] = Auth::user();
                    $arr['leave_type'] = $_POST['leave_type'];
                    $arr['date'] = $_POST['start_date'];
                    $arr['leave_status'] = "Pending";
                    $from_date = $_POST['start_date'];
                    $to_date = $_POST['end_date'];
                
                    $date_list = date_calc($from_date, $to_date);

                    for($i = 0; $i<sizeof($date_list); $i++){
                        echo("size of date list ". sizeof($date_list));
                        echo "<br>";
                        echo $i;
                        $week_day = date_create($date_list[$i]);
                        echo "<br>";
                        echo "Week day ";
                        echo date_format($week_day,"l");


                        if(date_format($week_day,"l") == "Sunday"){
                            echo "<br>";
                            echo "inside if condition";
                            echo "<br>";
                            echo date_format($week_day,"l");
                            echo "<br>";
                            // continue;
                            echo($i);
                            
                            
                            echo "<br>";

                        }else{

                            echo "else part  ";
                            $arr['employee_ID'] = Auth::user();
                            $arr['leave_type'] = $_POST['leave_type'];
                            $arr['date'] = $date_list[$i];
                            $row = "date";
                            $date_exist = $this->validate($arr['date'],$user,$row);

                            if($date_exist){
                                break;
                                echo "Date already leave";
                            }
                            $arr['leave_status'] = "pending";

                            $user->insert($arr);
                            print_r($arr);
                            echo "<br>";
                            echo "<br>";
                        }

                        

                    }

                }

                if($_POST['half_date']!= null && !boolval($_POST['start_date'])){

                        //////////////////// FILL ONLY HALF DAYS LEAVE ////////////////////////

                    $arr['employee_ID'] = Auth::user();
                    $arr['leave_type'] = $_POST['leave_type'];
                    $arr['date'] = $_POST['half_date'];
                    $arr['leave_status'] = "Pending";
                    $arr['half_time'] = $_POST['half_time'];
                    $row = "date";
                    $week_day = date_create($arr['date']);

                    if(date_format($week_day,"l") == "Sunday"){
                        echo "<br>";
                        echo "inside if condition";
                        echo "<br>";
                        echo date_format($week_day,"l");
                        echo "<br>";
                        // continue;
                        echo($i);
                        /////////////////// Message eka print wenna ooni.. sunday leave daanna ooni nee kiyala
                        
                        echo "<br>";

                    }else{
                        $date_exist = $this->validate($arr['date'],$user,$row);

                        if($date_exist){
                            // break;
                            echo "Date already leave";
                        }else{
                            $user->insert($arr);
                        }
                    }
                    
                    
                   

                    /////// simply insert one day to data base
                }
                else {

                        /////////////////// FILL BOTH HALF AND FULL DAYS LEAVES ///////////////////////

                    $arr['employee_ID'] = Auth::user();
                    $arr['leave_type'] = $_POST['leave_type'];
                    $arr['date'] = $_POST['start_date'];
                    // $arr['ending_date'] = $_POST['end_date'];
                    $arr['leave_status'] = "Pending";
                    $arr['date'] = $_POST['half_date'];
                    $half_date = $_POST['half_date'];
                    $arr['half_time'] = $_POST['half_time'];

                    $from_date = $_POST['start_date'];
                    $to_date = $_POST['end_date'];
                    
                    $date_list = date_calc($from_date, $to_date);
                    array_push($date_list, $half_date);

                    print_r($date_list);

                    echo "Half Date is : ". $half_date;
                    $arr_end = sizeof($date_list)-1;

                    echo "<br>";
                    echo $arr_end;
                    echo "<br>";

                    for($i = 0; $i  < $arr_end ; $i++){
                        echo $i;
                        $arr['employee_ID'] = Auth::user();
                        $arr['leave_type'] = $_POST['leave_type'];
                        $arr['date'] = $date_list[$i];
                        $row = "date";
                        $arr['half_time'] = null;
                        $arr['leave_status'] = "Pending";

                        $week_day = date_create($date_list[$i]);
                        if(date_format($week_day,"l") == "Sunday"){
                            echo "<br>";
                            echo "inside if condition";
                            echo "<br>";
                            echo date_format($week_day,"l");
                            echo "<br>";
                            // continue;
                            echo($i);
                            
                            
                            echo "<br>";

                        }else{
                            $date_exist = $this->validate($arr['date'],$user,$row);

                            if($date_exist){
                                echo "Date already leave";
                                break;  
                            }
                            else{
                                $user->insert($arr);
                            }
                        }
                       
                       
                        
                        print_r($arr);
                        echo "<br>";
                        echo "<br>";

                    }

                    $arr['employee_ID'] = Auth::user();
                    $arr['leave_type'] = $_POST['leave_type'];
                    $arr['date'] = $date_list[$arr_end];
                    $arr['half_time'] = $_POST['half_time'];
                    $arr['leave_status'] = "Pending";

                    $row = "date";
                    $date_exist = $this->validate($arr['date'],$user,$row);

                    if($date_exist){
                        echo "Date already leave";
                        // break;  
                    }
                    else{
                        $user->insert($arr);

                    }


                    print_r($arr);
                    
                }
                
                echo "<br>";
                echo "<br>";
                print_r($date_list);
                
                
                echo "<br>";
                echo "<br>";
                print_r($_POST);

                // $user->insert($arr);
            }
            $this->view('requestleave',['rows'=>$data]);
        }else{
            $this->view('requestleave',['rows'=>$data]);
        }    
        
    }

    function validate($email , $user,$row)
    {
		$validate = $user->where($row,$email);
		return $validate;
	}

    
}
