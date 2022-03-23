<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\css\color.css">
    <!-- <link rel="stylesheet" href="<?= CSS_PATH ?>addemployee.css"> -->
    <link rel="stylesheet" href="public\css\addemployee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
          integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- <script deffer src="../../public/js/add_employee.js"></script>  -->
    <!-- use deffer for run js file after loading html-->
    <title>Add Employee</title>
</head>

<body>
<div>
    <?php
    $this->view('includes/header1')
    ?>
</div>

<div class="page_content">
     <?php if (Auth::access('HR Officer')): ?>
        <div>
            <?php
//            $this->view('includes/hrofficernav');
            $this->view('includes/hrofficernavbar');
            ?>
        </div>
    <?php endif; ?>
    <?php if (Auth::access('HR Manager')): ?>
        <div>
            <?php
            //            $this->view('includes/hrofficernav');
            $this->view('includes/hrmanagernavbar');
            ?>
        </div>
    <?php endif; ?>


    <?php

    for ($i = 4; $i < 16; $i++) {
        if ($rows[$i]) {
            $alert = "<script> alert ('$rows[$i]') </script>";
            echo $alert;
        }
    }
    ?>
    <div class="main_container">
        <div class="add_employee_main_container">

            <div class="supervisor_list">
                <div class="main_dp">
                    <div class="title">
                        <p>Operational Department</p>
                    </div>
                    <div class="data">
                        <table>
                            <tr>
                                <th class="id">Employee ID</th>
                                <th>Name</th>
                            </tr>
                            <?php
                            if ($rows[0]) {
                                foreach ($rows[0] as $entry) { ?>
                                    <tr>
                                        <td> <?php echo $entry->employee_ID ?> </td>
                                        <td> <?php echo $entry->first_name ?><?php echo " " ?><?php echo $entry->last_name ?> </td>
                                    </tr>

                                    <?php
                                }
                            } ?>

                        </table>
                    </div>
                </div>
                <div class="hr_dp">
                    <div class="title">
                        <p>HR Department</p>
                    </div>
                    <div class="data">
                        <table>
                            <tr>
                                <th class="id">Employee ID</th>
                                <th>Name</th>
                            </tr>
                            <?php
                            if ($rows[1]) {
                                foreach ($rows[1] as $entry) { ?>
                                    <tr>
                                        <td> <?php echo $entry->employee_ID ?> </td>
                                        <td> <?php echo $entry->first_name ?><?php echo " " ?><?php echo $entry->last_name ?> </td>
                                    </tr>

                                    <?php
                                }
                            }
                            ?>


                        </table>
                    </div>

                </div>

                <div class="sells_dp">
                    <div class="title">
                        <p>Sales Department</p>
                    </div>
                    <div class="data">
                        <table>
                            <tr>
                                <th class="id">Employee ID</th>
                                <th>Name</th>
                            </tr>
                            <?php
                            if ($rows[2]) {
                                foreach ($rows[2] as $entry) { ?>
                                    <tr>
                                        <td> <?php echo $entry->employee_ID ?> </td>
                                        <td> <?php echo $entry->first_name ?><?php echo " " ?><?php echo $entry->last_name ?> </td>
                                    </tr>

                                    <?php
                                }
                            } ?>

                        </table>
                    </div>
                </div>
                <div class="acc_dp">
                    <div class="title">
                        <p>Financial Department</p>
                    </div>
                    <div class="data">
                        <table>
                            <tr>
                                <th class="id">Employee ID</th>
                                <th>Name</th>
                            </tr>
                            <?php
                            if ($rows[3]) {
                                foreach ($rows[3] as $entry) { ?>
                                    <tr>
                                        <td> <?php echo $entry->employee_ID ?> </td>
                                        <td> <?php echo $entry->first_name ?><?php echo " " ?><?php echo $entry->last_name ?> </td>
                                    </tr>

                                    <?php
                                }
                            } ?>

                        </table>
                    </div>
                </div>

            </div>

            <div class="form">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 10 1440 200"><path fill="#0f9eb8" fill-opacity="1" d="M0,128L40,149.3C80,
            171,160,213,240,208C320,203,400,149,480,138.7C560,128,640,160,720,144C800,128,880,64,960,74.7C1040,85,1120,171,1200,197.3C1280,
            224,1360,192,1400,176L1440,160L1440,0L1400,0C1360,0,1280,0,1200,0C1120,0,1040,0,960,0C880,0,800,0,720,0C640,0,560,0,480,0C400,
            0,320,0,240,0C160,0,80,0,40,0L0,0Z"></path></svg>
                <div class="title">
                    <p>Add New Employee</p>
                </div>
                <div class="input_feild">
                    <form method="post" enctype="multipart/form-data">

                        <table style="max-width: 100%;">
                            <tr>
                                <th id="c1"></th>
                                <th id="c2"></th>
                                <th id="c3"></th>
                                <th id="c4"></th>
                                <th id="c5"></th>
                                <th id="c6"></th>
                                <th id="c7"></th>
                                <th id="c8"></th>
                            </tr>
                            <tr>
                                <!-- <td id="c1" ></td> -->
                                <td id="c2" colspan="2"><label for="fname">First Name</label></td>
                                <!-- <td id="c3">  </td> -->
                                <td id="c4" colspan="6"><input type="text" id="fname" name="fname"  required><p id="fval">Name Not Valied</p>
                            <input type="hidden" name="fhide" id="fhide" value=""></td>
                                
                            </tr>
                            <tr>
                                <!-- <td id="c1"></td> -->
                                <td id="c2" colspan="2"><label for="lname">Last Name</label></td>
                                <!-- <td id="c3"></td> -->
                                <td id="c4" colspan="6"><input type="text" id="lname" name="lname" ><p id="lval">Name Not Valied</p>
                            <input type="hidden" name="lhide" id="lhide" value=""></td>
                               
                            </tr>

                            <tr>
                                <!-- <td id="c1"></td> -->
                                <td id="c2" colspan="2"><label for="nic">NIC</label></td>
                                <!-- <td id="c3"></td> -->
                                <td id="c4" colspan="6"><input type="text" id="nic" name="nic"  required maxlength="12"><p id="nicval"></p>
                            <input type="hidden" name="nichide" id="nichide" value=""></td>
                                
                            </tr>

                            <tr>
                                <!-- <td id="c1"></td> -->
                                <td id="c2" colspan="2"><label for="dob">Date Of Birth</label></td>
                                <!-- <td id="c3"></td> -->
                                <td id="c4" colspan="6"><input type="date" id="dob" name="dob" required min="" max="" onload = "public/js/addemployee.js/dob_validate()" value=""></td>
                                
                            </tr>
                            
                            <!-- <tr>
                                <td id="c1" colspan="2"></td>
                                <td id="c2"></td>
                                <td id="c3"></td>
                                <td id="c4"></td>
                                <td id="c5"></td>
                                <td id="c6"></td>
                                <td id="c7"></td>
                                <td id="c8"></td>
                            </tr> -->
                            <tr>
                              
                                <td id="c2" colspan="2">Address</td>
                            
                            </tr>
                            <tr>
                                <td id="c2" colspan="2"><label for="street" id="address">Street</label> </td>
                                <!-- <td id="c3"></td> -->
                                <td id="c4" colspan="6"><input type="text" id="street" name="street"></td>
                              
                            </tr>
                            <tr>
                                <td id="c2" colspan="2"><label for="city" id="address">City</label></td>
                                <!-- <td id="c3"></td> -->
                                <td id="c4" colspan="6"><input type="text" id="city" name="city" required></td>
                                
                            </tr>
                            <tr>
                                <!-- <td id="c1"></td> -->
                                <td id="c2" colspan="2"><label for="Province" id="address">Province</label></td>
                                <!-- <td id="c3"></td> -->
                                <td id="c4" colspan="6"><select id="province" name="province">
                                    <option value="Western">Western Province</option>
                                    <option value="Central">Central Province</option>
                                    <option value="Southern">Southern Province</option>
                                    <option value="Uva">Uva Province</option>
                                    <option value="Sabaragamuwa">Sabaragamuwa Province</option>
                                    <option value="North_western">North Western Province</option>
                                    <option value="North_central">North Central Province</option>
                                    <option value="Nothern">Nothern Province</option>
                                    <option value="Eastern">Eastern Province</option>

                                </select></td>
                                
                            </tr>

                            <tr>
                                <!-- <td id="c1"></td> -->
                                <td id="c2" colspan="2"><label for="marital" name="marital">Marital Status</label></td>
                                <!-- <td id="c3"></td> -->
                                <td id="c4"><label for="yes">Yes</label></td>
                                <td id="c5"><input type="radio" id="yes" name="marital" value="Yes" required></td>
                        
                                <td id="c6"></td>
                                <td id="c7"><label for="no">No</label></td>
                                <td id="c8"><input type="radio" id="no" name="marital" value="No"></td>                            
                            </tr>
                            <tr>
                                
                                <td id="c2" colspan="2"><label for="gender" name="gender">Gender</label></td>
                                
                                <td id="c4"><label for="gender">Male</label></td>
                                <td id="c5"><input type="radio" id="male" name="gender" value="Male" required></td>
                        
                                <td id="c6"></td>
                                <td id="c7"><label for="gender">Female</label></td>
                                <td id="c8"><input type="radio" id="female" name="gender" value="Female"></td>                           
                            </tr>

                            <tr>
                                <td id="c2" colspan="2"><label for="contact">Contact Number</label></td>
                                
                                <td id="c4" colspan="6"><input type="tel" id="contact" name="contact" placeholder="###-#######"
                                   pattern="[0-9]{3}-[0-9]{7}"
                                    required maxlength="11"></td>
                       
                            </tr>
                            <tr>
                            
                                <td id="c2" colspan="2"><label for="email">E Mail</label></td>
                                <td id="c4" colspan="6">    <input type="email" id="email" name="email" required></td>
            
                            </tr>

                            <tr>
                                <!-- <td id="c1"></td> -->
                                <td id="c2" colspan="2"><label for="password">Password</label></td>
                                <!-- <td id="c3"></td> -->
                                <td id="c4" colspan="6"><input type="password" id="pwd" name="pwd" required> <i class="far fa-eye" id="eye1" ></i>
                                <input type="hidden" name="phide" id="phide" value="">
                                <p id="message"> Password is <span id="strenght"></span></p>
                                </td>
                                
                            </tr>

                            <tr>
                                <!-- <td id="c1"></td> -->
                                <td id="c2" colspan="2"><label for="confirm">Confirm Password</label></td>
                                <!-- <td id="c3"></td> -->
                                <td id="c4" colspan="6"><input type="password" id="confirm" name="confirm" required><i class="far fa-eye"id="eye2"></i>
                                    <input type="hidden" name="phide" id="phide" value="">
                                    <p id="message">  <span id="strenght"></span></p>   
                                </td>
                               
                            </tr>
                            
                             <tr>
                            
                                <td id="c2" colspan="2"><label for="hired_date">Hired Date</label></td>
                                 <td id="c4" colspan="6"><input type="date" id="hired" name="hired"  max="2022-03-24" required ></td>
            
                            </tr>

                            <tr>
                                <!-- <td id="c1"></td> -->
                                <td id="c2" colspan="2"><label for="user_role">User Role</label> </td>
                                <!-- <td id="c3"></td> -->
                                <td id="c4" colspan="6"><select id="user_role" name="user_role">
                                    <option value="Employee">Employee</option>
                                    <option value="HR Manager">HR Manager</option>
                                    <option value="HR Officer">HR Officer</option>
                                    </select>
                                </td>
                               
                            </tr>

                            <tr>
                                <!-- <td id="c1"></td> -->
                                <td id="c2" colspan="2"><label for="department">Department</label></td>
                                <!-- <td id="c3"></td> -->
                                <td id="c4" colspan="6"><select id="department" name="department">
                                    <option value="1">Operational Department</option>
                                    <option value="2">HR Department</option>
                                    <option value="3">Sales Department</option>
                                    <option value="4">Account Department</option>
                                </select></td>
                            </tr>

                            <tr>
                                <!-- <td id="c1"></td> -->
                                <td id="c2" colspan="2"><label for="designation">Designation</label></td>
                                <!-- <td id="c3"></td> -->
                                <td id="c4" colspan="6"><select id="designation" name="designation">
                                    <option value="1">CEO</option>
                                    <option value="2">Director</option>
                                    <option value="3">Manager</option>
                                    <option value="4">HR Officer</option>
                                    <option value="5">Employee</option>
                                </select></td>
                            </tr>

                            <tr>
                                <!-- <td id="c1"></td> -->
                                <td id="c2" colspan="2"><label for="supervisor">Supervisor ID</label></td>
                                <!-- <td id="c3"></td> -->
                                <td id="c4" colspan="6"><input type="text" id="supervisor" name="supervisor" size="50"></td>
                                
                            </tr>

                            <tr>
                                <!-- <td id="c1"></td> -->
                                <td id="c2" colspan="2"><label for="">Profile Picture </label></td>
                                <!-- <td id="c3"></td> -->
                                <td id="c4" colspan="6"><input type="file" name="image" id="image" onchange="loadFile(event)"
                                       style="display: none;">
                                <label for="image" id="image" name="image">Upload Image </label>
                                <div>
                                    <img id="output" width="200"/>
                                </div>

                                <script>
                                    var loadFile = function (event) {
                                        var image = document.getElementById('output');
                                        image.src = URL.createObjectURL(event.target.files[0]);
                                    };
                                </script></td>
                                
                            </tr>
                            
                            <tr>
                                <td id="c1"></td>
                                <td id="c2"></td>
                                <td id="c3" class="button"><button type="reset" id="cancel">Cancel</button></td>
                                <td id="c4"></td>
                                <td id="c5"></td>
                                <td id="c6"></td>
                                <td id="c7" class="button"><a href='' onclick="this.href='<?= PATH ?>/Currentdata/'+document.getElementById('hired').value"><button type="submit" id="add" name="submit">Add</button></a></td>
                                <td id="c8"></td>
                            </tr>   
                        </table>
                    </form>
                          
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1439 250"><path fill="#0f9eb8" fill-opacity="1" d="M0,160L48,144C96,128,192,96,288,80C384,
                        64,480,64,576,96C672,128,768,192,864,192C960,192,1056,128,1152,90.7C1248,53,1344,43,1392,37.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,
                        320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
 
            </div>
            
        </div>
    </div>
</div>
<script src="public\js\addemployee.js"></script>
</body>
</html>
