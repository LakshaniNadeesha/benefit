<?php

class Hierarchy extends Controller
{
	
	function index()
	{

		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}
		
//		$user = new Employeedetails();
//		$arr = $user->findAll();
//
//		$root = $user->where('supervisor_ID','0');
//		$select = array();
//		$select[0] = $root;
//		//print_r($select);
//		//print_r($select[0][0]->employee_ID);
//        //print_r(sizeof($arr));
//
//        $visited = array();
//        for($v=0;$v<sizeof($arr);$v++){
//            $visited[$v] = false;
//        }
//
//        $visited[0] = true;
//
//		for($i=0; $i<sizeof($arr);$i++){
//            for($j=0;$j<sizeof($arr);$j++){
//                $k = $i;
//                if($select[$i]->employee_ID == $arr[$j]->supervisor_ID){
//                    $k=$k+1;
//                    $select[$k] = $arr[$j];
//                }
//            }
//            //print_r($arr[$i]->supervisor_ID);
//        }

		$this->view('hierarchy');
		
	}
}
