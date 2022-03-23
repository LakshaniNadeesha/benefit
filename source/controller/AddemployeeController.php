<?php

/**
 *
 */
class AddemployeeController extends Controller
{

    function index()
    {
        $select = new AddemployeeModel();
        $oper = $select->where('department_ID', 1);
        $hr = $select->where('department_ID', 2);
        $sells = $select->where('department_ID', 3);
        $acc = $select->where('department_ID', 4);
        $null = $select->where('department_ID', 5);
        $arr1 = array($oper, $hr, $sells, $acc, $null);
        for ($x = 4; $x < 16; $x++) {
            $arr1[$x] = null;
        }
        // $this->view('addemployee',['rows'=>$arr1]);


        if (count($_POST) > 0) {
            $user = new AddemployeeModel();
            // $user = new AddemployeeModel();
            // $data = "define";
            //($user->validate($_POST)
            if (isset($_POST['submit'])) // if(!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST')
            {

                $arr['first_name'] = ucwords(strtolower(filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING)));
                $arr['last_name'] = ucwords(strtolower(filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING)));
                $arr['dob'] = $_POST['dob'];

                // $today = date("Y-m-d");
                // $diff = date_diff(date_create($arr['dob']), date_create($today));

                $arr['street'] = ucwords(strtolower(filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING)));
                $arr['city'] = ucwords(strtolower(filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING)));
                $arr['province'] = filter_input(INPUT_POST, 'province', FILTER_SANITIZE_STRING);
                $arr['employee_NIC'] = strtoupper(filter_input(INPUT_POST, 'nic', FILTER_SANITIZE_STRING));

                $row = "employee_NIC";
                $nic_validate = $this->validate($arr['employee_NIC'], $user, $row);

                // print_r( $nic_validate);

                $arr['marital_status'] = $_POST['marital'];
                $arr['gender'] = $_POST['gender'];
                $arr['contact_number'] = $_POST['contact'];
                $arr['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

                $row = "email";
                $email_validate = $this->validate($arr['email'], $user, $row);


                $pass = $_POST['pwd'];
                $arr['password'] = password_hash($pass, PASSWORD_DEFAULT);
                $confirm = $_POST['confirm'];
                $arr['hired'] = $_POST['hired'];
                $arr['user_role'] = filter_input(INPUT_POST, 'user_role', FILTER_SANITIZE_STRING);
                $arr['supervisor_ID'] = $_POST['supervisor'];

                $str['user_role'] = "Supervisor";

                $fhide = $_POST['fhide'];
                $lhide = $_POST['lhide'];
                $phide = $_POST['phide'];
                $nichide = $_POST['nichide'];
                $sup = 0;
                $id = $user->getcol('employee_ID');
                // print_r($id);
                // echo $arr['supervisor_ID']."<br>";

                if ($_POST['supervisor']) {
                    // echo "inside supervisor <br>";
                    foreach ($id as $i) {
                        if ($arr['supervisor_ID'] == $i->employee_ID) {
                            $sup = 1;
                        }
                    }
                    // if(in_array($arr['supervisor_ID'], $id, True)){
                    // else{
                    // 	echo "Not Found <br>";
                    // }
                    // foreach($id as $i){
                    // 	echo $i->employee_ID . "<br>";
                    // }
                } else {
                    $sup = 1;
                }

                if ($sup == 0) {
                    $arr1[14] = "Employee's Supervisor Not in the Company!";
                }


                $jsvalidate = 1;
                // echo "set value ". $jsvalidate."<br>";

                if ($fhide == "notvalied" || $lhide == "notvaied") {
                    $arr1[11] = "Name is not valied type";
                    $jsvalidate = 0;
                    // echo "inside name validation ";
                    // echo $jsvalidate." ".$fhide;
                    // echo $fhide."<br>";
                    // echo "set value ". $jsvalidate."<br>";
                }

                if ($phide == "notvalied") {
                    $jsvalidate = 0;
                    $arr1[12] = "Include a Strong Password!";
                    // echo "inside pass validation ";
                    // echo $phide."<br>";
                    // echo "set value ". $jsvalidate."<br>";

                    // echo $jsvalidate." ".$phide;
                }
                if ($nichide == "notvalied") {
                    $jsvalidate = 0;
                    $arr1[13] = "NIC is Invalied!";
                    // echo "inside nic validation ";
                    // echo $nichide."<br>";
                    // echo "set value ". $jsvalidate."<br>";

                    // echo $jsvalidate." ".$nichide;
                }


                $file = $_FILES['image'];

                $file_name = $_FILES['image']['name'];
                $file_type = $_FILES['image']['type'];
                $file_size = $_FILES['image']['size'];
                $file_error = $_FILES['image']['error'];
                $file_temp_name = $_FILES['image']['tmp_name'];

                $file_ext = explode('.', $file_name);
                $file_actual_ext = strtolower(end($file_ext));

                $allowed = array('jpg', 'jpeg', 'png', 'jfif'); //limit file types

                // echo "inside image upload";

                if (in_array($file_actual_ext, $allowed)) {
                    if ($file_error === 0) {
                        // if ($file_size < 5000000){ //set max size of image 5000 KB

                        $file_name_new = $arr['first_name'] . "." . $file_actual_ext; //Rename profile picture with employee id
                        $file_designation = 'public/img/profile/' . $file_name_new;
                        $complete = move_uploaded_file($file_temp_name, $file_designation);

                        $arr['profile_image'] = $file_designation;


                        // }else {
                        // 	$complete = false;
                        // 	$arr1[4] = "Uploaded image too big (try image size < 500kb)";

                        // }
                    } else {

                        $complete = false;
                        $arr1[5] = "Image cannot upload try again!";
                    }
                } else {
                    $complete = false;
                    $arr1[6] = "You cannot upload files of this type";

                }

                $arr['designation_code'] = $_POST['designation'];
                $arr['department_ID'] = $_POST['department'];

                if ($email_validate) {
                    $arr1[8] = "email is already used!";
                    unlink($file_designation);
                }
                if ($nic_validate) {
                    $arr1[15] = "NIC is already used!";
                    unlink($file_designation);
                }
                // elseif($diff->format('%y') <= 18 && $diff->format('%y') > 60){
                // 	$arr1[10] = "Employee Age must be greater than 18!";
                // 	unlink($file_designation);
                // }
                elseif ($complete && $confirm == $pass && $jsvalidate == 1 && $sup == 1) {


                    $user->insert($arr);
                    print_r($arr);
                    $user->update($_POST['supervisor'], $str);
                    // echo "inside inseart ";
                    // echo $jsvalidate;
                    // $arr1[9] = "ff";
                    if ($jsvalidate) {
                        $this->redirect('Currentdata/' . $arr['employee_NIC'] . '/' . $arr['hired'] . '/' . $arr['first_name'] . '/' . $arr['last_name']);
                    }
                } else {
                    $arr1[9] = "Upload Not Completed!";
                    unlink($file_designation);
                }

            }

        }


        $this->view('addemployee', ['rows' => $arr1]);


    }

    function validate($email, $user, $row)
    {
        // $select = new AddemployeeModel();
        $validate = $user->where($row, $email);

        return $validate;
    }

}
