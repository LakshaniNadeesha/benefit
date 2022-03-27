<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\css\color.css">
    <!-- <link rel="stylesheet" href="<?= CSS_PATH ?>addemployeeRedirect.css"> -->
    <link rel="stylesheet" href="public\css\popup.css">
    <link rel="stylesheet" href="public\css\deleteemployee.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"> </script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"> </script>
    <!-- <link rel="stylesheet" href="public\css\employeelist.css"> -->
    <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
    <title>Sucsess</title>
</head>

<body>
    <div>
        <?php $this->view('includes/header1') ?>
    </div>

    <?php if (Auth::access('HR Manager')) : ?>
        <div>
            <?php
            $this->view('includes/hrmanagernavbar');
            ?>
        </div>
    <?php endif; ?>
    <!--<div>-->
    <!--    --><?php
                //    $this->view('includes/header1')
                //    
                ?>
    <!--</div>-->
    <div class="page_content">
        <!--    --><?php //if (Auth::access('HR Officer')): 
                    ?>
        <!--        <div>-->
        <!--            --><?php
                            //            $this->view('includes/hrofficernavbar');
                            //            
                            ?>
        <!--        </div>-->
        <!--    --><?php //endif; 
                    ?>
        <div class="main_container">
            <div class="msg">
                <div class="title">
                    <p>Confirm for Delete</p>
                </div>
                <div class="emp_details">
                    <?php foreach ($rows as $entry) { ?>
                        <div class="picture">
                            <img src="<?php echo $entry->profile_image ?>" alt="Picture not found">
                        </div>
                        <div class="details">
                            <table>
                                <tr>
                                    <td class="left">EMPLOYEE ID</td>
                                    <td><?php echo $entry->employee_ID ?></td>
                                </tr>
                                <tr>
                                    <td class="left">NAME</td>
                                    <td><?php echo $entry->first_name . " " . $entry->last_name ?></td>
                                </tr>
                                <tr>
                                    <td class="left">E MAIL</td>
                                    <td><?php echo $entry->email ?></td>
                                </tr>
                                <tr>
                                    <td class="left">NIC</td>
                                    <td><?php echo $entry->employee_NIC ?></td>
                                </tr>
                                <tr>
                                    <td class="left">User Role</td>
                                    <td><?php echo $entry->user_role ?></td>
                                </tr>
                                <?php
                                if ($entry->department_ID == 1) {
                                    $department = "Operational Department";
                                } elseif ($entry->department_ID == 2) {
                                    $department = "HR Department";
                                } elseif ($entry->department_ID == 3) {
                                    $department = "Sells Department";
                                } else {
                                    $department = "Account Department";
                                }
                                ?>

                                <tr>
                                    <td class="left">Department</td>
                                    <td><?php echo  $department ?></td>
                                </tr>
                            </table>


                            <?php if (($entry->user_role == "Supervisor" || $entry->user_role == "HR Manager" || $entry->user_role == "HR Officer") && $entry->supervisor_ID == 0) {
                                // echo "Root Supervisor";
                            ?>
                                <div class="buttons" id="buttons">
                                    <!-- <button type="sumbit" id="cancel" name="cancel">Cancel</button>
                                    <button class="show-more" id="hr" type="submit" name="show">Show More <i class="fas fa-arrow-right"></i></button> -->
                                    <!-- <form method="post"> -->
                                    <input type="submit" id="cancel" class="butt" name="cancel" value="Cancel" />
                                    <input type="submit" id="delete" class="butt" name="delete" value="Delete" />
                                    <!-- </form> -->
                                    <!-- <button type="submit" id="add" name="submit">Update</button> -->
                                </div>

                            <?php
                            } elseif (($entry->user_role == "Supervisor" || $entry->user_role == "HR Manager" || $entry->user_role == "HR Officer") && $entry->supervisor_ID != 0) {
                                // echo "Supervisore under supervisore";
                            ?>
                                <!-- <button class="show-more" id="hr" type="submit" name="show">Show More <i class="fas fa-arrow-right"></i></button> -->
                                <div class="buttons" id="buttons">
                                    <!-- <button type="sumbit" id="cancel" name="cancel">Cancel</button>
                                    <button class="show-more" id="delete" type="submit" name="show">Show More</button> -->
                                    <!-- <form method="post"> -->
                                    <input type="submit" id="cancel" class="butt" name="cancel" value="Cancel" />
                                    <input type="submit" id="delete" class="butt" name="delete" value="Delete" />
                                    <!-- </form> -->
                                    <!-- <button type="submit" id="add" name="submit">Update</button> -->
                                </div>
                            <?php
                            } else { ?>
                                <div class="buttons">
                                    <form method="post">
                                        <input type="submit" id="cancel" class="butt" name="cancel" value="Cancel" />
                                        <input type="submit" id="delete" class="butt" name="delete" value="Delete" />
                                    </form>
                                </div>
                            <?php
                            }
                            ?>


                            <!-- <p>kjbshvb</p> -->
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="confirm init">

            <div class="confirm__window ">
                <div class="confirm__titlebar">
                    <span class="confirm__title">Assign Supervisor</span>
                    <button class="confirm__close">&times;</button>
                </div>

                <div class="confirm__content" id="dhr" style="display:none;">


                    <div class="data">
                        <form method="post">
                            <table>
                                <tr>
                                    <td>
                                        <p>Enter Supervisor ID</p>
                                    </td>

                                    <td> <input type="number" name="supervisor" id="supervisor" required> </td>
                                    <td><button type="button" id="search" onclick="searchFunction()">Search</button></td>
                                    <!-- <td><input type="submit"></td> -->
                                </tr>
                            </table>
                        </form>


                        <script>
                            var passedArray =
                                <?php echo json_encode($rows2); ?>;
                            console.log(passedArray);

                            var entryID = <?php echo $entry->employee_ID ?>;

                            // for (var i = 0; i < passedArray.length; i++) {
                            //      document.write(passedArray[i].employee_ID);
                            // }

                            var sid = document.getElementById("supervisor").value;


                            // if (sid) {
                            function searchFunction() {
                                var sid = document.getElementById("supervisor").value;
                                console.log(sid);
                                document.getElementById("supervisor_f").value = sid;
                                //    var i = 0;
                                for (var i = 0; i < passedArray.length; i++) {
                                    // document.write(passedArray[i].employee_ID);
                                    if (passedArray[i].employee_ID === sid && passedArray[i].employee_ID != entryID) {
                                        document.querySelector("#tdata").style.display = "block";
                                        var x = passedArray[i].profile_image;

                                        document.getElementsByClassName("img").src = x;
                                        document.getElementById("employee_ID").innerHTML = passedArray[i].employee_ID;
                                        document.getElementById("name").innerHTML = passedArray[i].first_name + " " + passedArray[i].last_name;
                                        document.getElementById("email").innerHTML = passedArray[i].email;
                                        document.getElementById("nic").innerHTML = passedArray[i].employee_NIC;
                                        document.getElementById("user_role").innerHTML = passedArray[i].user_role;

                                        if (passedArray[i].department_ID == 1) {
                                            document.getElementById("dept").innerHTML = "Operational Department";
                                        } else if (passedArray[i].department_ID == 2) {
                                            document.getElementById("dept").innerHTML = "HR Department";
                                        } else if (passedArray[i].department_ID == 3) {
                                            document.getElementById("dept").innerHTML = "Sells Department";
                                        } else {
                                            document.getElementById("dept").innerHTML = "Financial Department";
                                        }

                                        break;
                                    }

                                    // if(i = passedArray.length){
                                    //     document.getElementById("err").innerHTML = "Employee Not Found";
                                    // }
                                }
                            }
                            // }
                            // else{
                            //     document.getElementById("delete").style.display = "none";

                            // }
                        </script>


                        <div class="picture" style="display:none;">
                            <img id="img" src="" alt="Picture not found">

                        </div>
                        <center>
                            <h2 id="err"></h2>
                        </center>

                        <table id="tdata" style="display:none;">
                            <tr>
                                <td class="left">EMPLOYEE ID</td>
                                <td id="employee_ID"></td>
                            </tr>
                            <tr>
                                <td class="left">NAME</td>
                                <td id="name"></td>
                            </tr>
                            <tr>
                                <td class="left">E MAIL</td>
                                <td id="email"></td>
                            </tr>
                            <tr>
                                <td class="left">NIC</td>
                                <td id="nic"></td>
                            </tr>
                            <tr>
                                <td class="left">User Role</td>
                                <td id="user_role"></td>
                            </tr>
                            <tr>
                                <td class="left">Department</td>
                                <td id="dept"></td>
                            </tr>

                        </table>
                        <div class="confirm__buttons">
                            <!-- <button class="confirm__button confirm__button--cancel ">OK</button> -->
                            <form method="post">
                                <input type="hidden" name="supervisor_f" id="supervisor_f">
                                <input type="submit" id="delete" name="delete" value="Delete" />
                            </form>
                        </div>



                    </div>
                </div>

            </div>
        </div>


    </div>
    <script>
        const hr = document.querySelector('#delete');
        const cancel = document.querySelector('#cancel');
        const sub = document.querySelector('#sub');
        const confirmEl = document.querySelector('.confirm');
        const btnClose = document.querySelector('.confirm__close');

        const btnCancel = document.querySelector('.confirm__button--cancel');

        confirmEl.addEventListener('click', e => {
            if (e.target === confirmEl && e.target !== sub) {
                // options.oncancel();
                close(confirmEl);
            }
        });

        [btnCancel, btnClose].forEach(el => {
            if (el && el.target !== sub) {
                el.addEventListener('click', () => {
                    // options.oncancel();
                    close(confirmEl);
                });
            };

        });


        hr.addEventListener('click', () => {

            pop(confirmEl);
            console.log("This is hr " + hr);
            document.getElementById("dhr").style.display = "block";

        });

        // cancel.addEventListener('click',()=>{

        // })

        function close(confirmEl) {
            console.log('You closed the window!');
            confirmEl.classList.add('confirm--close');

            document.body.removeChild(confirmEl);


        };

        function pop(confirmEl) {

            document.body.appendChild(confirmEl);
            confirmEl.classList.remove('confirm--close');
            confirmEl.classList.remove('init');
        };
    </script>
</body>

</html>