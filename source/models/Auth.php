<?php

/**
 * Authentication class
 */
class Auth
{
	
	public static function authenticate($row)
	{
		// code...
		$_SESSION['USER'] = $row;
	}


	public static function logout()
	{
		// code...
		if(isset($_SESSION['USER']))
		{
			unset($_SESSION['USER']);
		}
	}

	public static function logged_in()
	{
		// code...
		if(isset($_SESSION['USER']))
		{
			return true;
		}

		return false;
	}



	public static function user()
	{
		if(isset($_SESSION['USER']))
		{
			return $_SESSION['USER']->employee_ID;
		}

		return false;
	}
	
	public static function sup()
	{

		if(isset($_SESSION['USER']))
		{
			$id= $_SESSION['USER']->supervisor_ID;
			$ro=array();
			$super=new Employeedetails();
			$ro=$super->where('supervisor_ID',$id);
			$ro=$ro[0];

				$ro=$ro->first_name;
				return $ro;
		}
		return false;

	}

	public static function notification(){
	    if(isset($_SESSION['USER'])){
	        $id = $_SESSION['USER']->employee_ID;
	        $notification = new NotificationModel();
	        $rows = $notification->findAll();
	        return $rows;
        }
    }
	

	public static function __callStatic($method,$params)
	{
		$prop = strtolower(str_replace("get","",$method));

		if(isset($_SESSION['USER']->$prop))
		{
			return $_SESSION['USER']->$prop;
		}

		return 'Unknown';
	}

	public static function access($rank = 'Employee')
	{
		// code...
		if(!isset($_SESSION['USER']))
		{
			return false;
		}

		$logged_in_rank = $_SESSION['USER']->user_role;

		//$RANK['CEO'] 	    = ['CEO','HR Manager','Supervisor','HR Officer'];
		$RANK['HR Manager'] = ['HR Manager'];
		$RANK['HR Officer'] = ['HR Officer','Employee'];
		$RANK['Supervisor'] = ['Employee','Supervisor'];
		$RANK['Employee'] 	= ['Employee'];

		if(!isset($RANK[$logged_in_rank]))
		{
			return false;
		}

		if(in_array($rank,$RANK[$logged_in_rank]))
		{
			return true;
		}

		return false;
	}



	
}
