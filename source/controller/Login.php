<?php

/**
 * login controller
 */
class Login extends Controller
{
	
	function index()
	{
		$this->check_if_banned();
		$errors = array();
		
		if(count($_POST) > 0 )
 		{
 			$user = new Employeedetails();
 			if($row = $user->where('email',$_POST['email']))
 			{
 				$row = $row[0];
 				if(password_verify($_POST['password'], $row->password) )
 				{

 					if($row->banned_employees!=1)
 					{


 					$this->check_if_banned(true,true);
 					Auth::authenticate($row);
 					$this->redirect('/home');
 					}
 					else
 					{
 					require ("./source/views/404.view.php");
					die;
 					}
 				}
 				else{
 					$this->check_if_banned(true,false);
 					
 				}
 			}
  			$errors['email'] = "Wrong email or password";
  			

 		}
 	
		$this->view('login',[
			'errors'=>$errors,
		]);
	}

	function forgotpassword()
	{
		if(isset($_POST['reset-req']))
		{
			$selector=bin2hex(random_bytes(8));
			$token=random_bytes(32);
			$hashedToken=password_hash($token, PASSWORD_DEFAULT);
			/*$url="<?=PATH?>login/forgotpassword2?selector=".$selector."&validator=".bin2hex($token);*/
			$url="localhost/benefit/Login/forgotpassword2?selector=".$selector."&validator=".bin2hex($token);
			$expires=date("U") +1800;
			$userEmail =$_POST["email"];
			$user =new PwdResetModel();
			$row=$user->deletepsw($userEmail);
			$arr['pwdResetEmail']=$userEmail;
			$arr['pwdResetSelector']=$selector;
			$arr['pwdResetToken']=$hashedToken;
			$arr['pwdResetExpires']=$expires;
			$row=$user->insert($arr);
			
			$to=$userEmail;
			$subject='Reset your password for mmtuts';
			$massage= '<p>We recieved a password reset req.The link to reset your password </p>';
			$massage.='<p>Here is your password reset link:</br>';

			$massage.='<a href="'.$url.'">'.$url.'</a></p>';

			$headers="From:mmtuts <oraclefreightsolutionspvt@gmail.com>\r\n";
			$headers="Reply-To: oraclefreightsolutionspvt@gmail.com\r\n";
			$headers="Content-type:text/html\r\n";
			mail($to, $subject,$massage,$headers);
			header("Location:forgotpassword?reset=success");

		}
		$this->view('forgotpassword');
	}

	function forgotpassword2()
	{
		//print_r($_POST);
		if(isset($_POST["reset-password"]))
		{
			$selector=$_POST['selector'];
			$validator=$_POST['validator'];
			$password=$_POST['password'];
			$passwordRepeat=$_POST['pwd-password'];



			if(empty($password)||empty($passwordRepeat))
			{
				$errors['arr']="Passwords not be empty";
				foreach ($errors as $key ) {
       				$alert = "<script> alert ('$key')</script>";
         			 print_r($alert); 
       			 }
       			 $this->view('createnewpsw');
       			 exit();
			}

			elseif ($password!=$passwordRepeat) {
				$errors['arr']="Passwords are not match";
				foreach ($errors as $key ) {
       				$alert = "<script> alert ('$key')</script>";
         			 print_r($alert); 
       			 }
       			 $this->view('createnewpsw');
       			 exit();
			}

			$uppercase = preg_match('@[A-Z]@', $password);
			$lowercase = preg_match('@[a-z]@', $password);
			$number    = preg_match('@[0-9]@', $password);
			$specialChars = preg_match('@[^\w]@', $password);

			if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
   			 
   			$errors['arr']="Password size should be at least Medium";
				foreach ($errors as $key ) {
       				$alert = "<script> alert ('$key')</script>";
         			 print_r($alert); 
       			 }
       			 $this->view('createnewpsw');
       			 exit();
			}

			// elseif ($password!=$passwordRepeat) {
			// 	$this->view('createnewpsw');
			// 	exit();
			// }
			$currentDate=date("U");
			$user= new PwdResetModel();
			$row=$user->where('pwdResetSelector',$selector);

			if(!isset($row))
			{
				$errors['arr']="You need to re-submit your reset req";
				foreach ($errors as $key ) {
       				$alert = "<script> alert ('$key')</script>";
         			 print_r($alert); 

       			 }
       			 $this->view('createnewpsw');
       			 exit();
			}
			else
			{

				if(empty($row))
				{
				$errors['arr']="You need to re-submit your reset req";
				foreach ($errors as $key ) {
       				$alert = "<script> alert ('$key')</script>";
         			 print_r($alert);   
       			 }
       			 $this->view('createnewpsw');
				exit();
				}
				$row=$row[0];
				if($currentDate>$row->pwdResetExpires)
				{
				$errors['arr']="You need to re-submit your reset req";
				foreach ($errors as $key ) {
       				$alert = "<script> alert ('$key')</script>";
         			 print_r($alert);   
       			 }
       			 $this->view('createnewpsw');
				exit();
				}
				$userEmail=$row->pwdResetEmail;
				$tokenBin=hex2bin($validator);
				$tokenCheck=password_verify($tokenBin, $row->pwdResetToken);

				if ($tokenCheck===false) 
				{
					$errors['arr']="You need to re-submit your reset req";
				foreach ($errors as $key ) {
       				$alert = "<script> alert ('$key')</script>";
         			 print_r($alert);   
       			 }
       			 $this->view('createnewpsw');
					exit();
				}
				elseif ($tokenCheck===true) {
					$tokenEmail=$row->pwdResetEmail;

					$user= new Employeedetails();

					$newpassword=password_hash($password, PASSWORD_DEFAULT);
					$arr['password']=$newpassword;
					$row=$user->where('email',$userEmail);
					$row=$row[0];
					$row=$user->update($row->employee_ID,$arr);
					$user=new PwdResetModel();
					$row=$user->deletepsw($tokenEmail);
					$this->redirect('login');
				}
			}
		}
		/*else
		{
			$this->redirect('login');
		}*/

	$this->view('createnewpsw');
	}



	function check_if_banned($login_attempt = false,$login_success = false)
	{

	$limit = 3;
	$ip =$this->get_ip();
	
	$user=new BannedModel();
	$row=$user->wherebanned($ip);

			if(is_array($row) && count($row) > 0){
				$row = $row[0];
				 $id=$row->id;
				$time = time();
				if($row->banned > $time){
					//if banned
					//$this->redirect('Dined');
					require ("./source/views/404.view.php");
					die;
				}else{

					if($login_attempt){
					
						if($row->login_count>= $limit){
							
							$expire = ($time + (60 * 60));
							$row=$user->updatebanned($id,$expire);
							
							return;
						}else

						if($login_success){

							//reset login count on success
							$row=$user->updatebannedlogin_count($id);
						}else{

							//add to login count on failure
							$row=$user->updatebannedbanned_table($id);
					}
				}

				return;

			}
		}
	

	$login_count = 0;
	$banned = 0;
	$row=$user->updatebannedfinal($ip,$banned,$login_count);
	}

	function get_ip()
	{
		$ip = "";

	if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){

		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}

	if(isset($_SERVER['REMOTE_ADDR'])){

		return $_SERVER['REMOTE_ADDR'];
	}
		return $ip;
	}

}
