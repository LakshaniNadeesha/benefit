<?php

/**
 * PerformanceModel Controller
 */
class Performance extends Controller
{
	
	function index()
	{

		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}
		$user=new PerformanceModel();
		$ar=Auth::user();
		$row=array();
		
		$user_x=new Employeedetails();
		$rw=$user_x->where('banned_employees',0);
		$j=0;$k=0;$l=0;$m=0;$n=0;$q=0;$r=0;$s=0;$t=0;$u=0;
		$sum1=0;
		$sum2=0;
		$sum3=0;
		$sum4=0;
		$sum5=0;
		$sum6=0;
		$sum7=0;
		$sum8=0;
		$sum9=0;
		$sum10=0;
		for($i=0;$i<sizeof($rw);$i++)
		{
			$id=$rw[$i]->employee_ID;
			$rww[$i]=$user->where('employee_ID',$id);

			if (boolval($rww[$i])) {
                $sum1 = ($rww[$i][0]->communication) + $sum1;
                $sum2 = ($rww[$i][0]->quality_of_work) + $sum2;
                $sum3 = ($rww[$i][0]->organization) + $sum3;
                $sum4 = $rww[$i][0]->team_skills + $sum4;
                $sum5 = $rww[$i][0]->multitasking_ability + $sum5;
                if ($rww[$i][0]->communication == null) {
                    $j++;
                }
                if ($rww[$i][0]->quality_of_work == null) {
                    $k++;
                }
                if ($rww[$i][0]->organization == null) {
                    $l++;
                }
                if ($rww[$i][0]->team_skills == null) {
                    $m++;
                }
                if ($rww[$i][0]->multitasking_ability == null) {
                    $n++;
                }
                $sum6 = $rww[$i][0]->communication_overall + $sum6;
                if ($rww[$i][0]->communication_overall == null) {
                    $q++;
                }
                $sum7 = $rww[$i][0]->quality_of_work_overall + $sum7;
                if ($rww[$i][0]->quality_of_work_overall == null) {
                    $r++;
                }
                $sum8 = $rww[$i][0]->organization_overall + $sum8;
                if ($rww[$i][0]->organization_overall == null) {
                    $s++;
                }
                $sum9 = $rww[$i][0]->team_skills_overall + $sum9;
                if ($rww[$i][0]->team_skills_overall == null) {
                    $t++;
                }
                $sum10 = $rww[$i][0]->multitasking_ability_overall + $sum10;
                if ($rww[$i][0]->multitasking_ability_overall == null) {
                    $u++;
                }
            }
		}
		//print_r($sum1);
		$sum1=(int)($sum1/(sizeof($rww)-$j));
		//print_r($sum1);
		$sum2=(int)($sum2/(sizeof($rww)-$k));
		$sum3=(int)($sum3/(sizeof($rww)-$l));
		$sum4=(int)($sum4/(sizeof($rww)-$m));
		$sum5=(int)($sum5/(sizeof($rww)-$n));
		$sum6=(int)($sum6/(sizeof($rww)-$q));
		$sum7=(int)($sum7/(sizeof($rww)-$r));
		$sum8=(int)($sum8/(sizeof($rww)-$s));
		$sum9=(int)($sum9/(sizeof($rww)-$t));
		$sum10=(int)($sum10/(sizeof($rww)-$u));
		$sum['communication']=$sum1;
		$sum['quality_of_work']=$sum2;
		$sum['organization']=$sum3;
		$sum['team_skills']=$sum4;
		$sum['multitasking_ability']=$sum5;
		$summ['communication_overall']=$sum6;
		$summ['quality_of_work_overall']=$sum7;
		$summ['organization_overall']=$sum8;
		$summ['team_skills_overall']=$sum9;
		$summ['multitasking_ability_overall']=$sum10;
		//print_r($sum);
		$row = $user->where('employee_ID',$ar);
		//print_r($summ);
		$this->view('performance',['row'=>$row,'sum'=>$sum,'summ'=>$summ]);
		
	}
}

