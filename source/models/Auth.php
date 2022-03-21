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
			$ro=$super->where('employee_ID',$id,);
			$ro['fname']=$ro[0]->first_name;
			$ro['lname'] = $ro[0]->last_name;

			echo $ro['fname']." ".$ro['lname'];

				//return $ro;
				//return $ro;
		}
		return false;

	}

	public static function notification(){

	    if(isset($_SESSION['USER'])){
	        $id = $_SESSION['USER']->employee_ID;
	        $notification = new NotificationModel();
	        $rows = $notification->where('show_to',$id);
	        return $rows;
        }
    }

    public function calendar(){
        $connect = new PDO('mysql:host=localhost;dbname=hrm', 'root', '');
//        if (isset($_POST["title"])) {
//            $query = "INSERT INTO events (title, start_event, end_event) VALUES (:title, :start_event, :end_event) ";
//            $statement = $connect->prepare($query);
//            $statement->execute(
//                array(
//                    ':title' => $_POST['title'],
//                    ':start_event' => $_POST['start'],
//                    ':end_event' => $_POST['end'],
//                    ':shows' => auth::user()
//                )
//            );
//        }

        $user = new Employeedetails();
        $all_users = $user->findAll();

        $data = array();
        $query = "SELECT * FROM events ORDER BY id";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $id = $_SESSION['USER']->employee_ID;
        foreach($result as $row)
        {
            if($row["shows"] == $id) {
                $data[] = array(
                    'id' => $row["id"],
                    'title' => $row["title"],
                    'start' => $row["start_event"],
                    'end' => $row["end_event"]
                );
            }
        }
        return json_encode($data);
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
