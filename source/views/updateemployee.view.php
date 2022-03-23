<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\css\color.css">
    <link rel="stylesheet" href="public\css\updateemployee.css">

    <title>Update employee</title>
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


    <div class="main_container">

        <div class="form">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 200">
                <path fill="#0f9eb8" fill-opacity="1" d="M0,64L30,64C60,64,120,64,180,64C240,64,300,64,360,58.7C420,53,
    480,43,540,80C600,117,660,203,720,197.3C780,192,840,96,900,64C960,32,1020,64,1080,
    64C1140,64,1200,32,1260,37.3C1320,43,1380,85,1410,106.7L1440,128L1440,0L1410,0C1380,
    0,1320,0,1260,0C1200,0,1140,0,1080,0C1020,0,960,0,900,0C840,0,780,0,720,0C660,0,600,
    0,540,0C480,0,420,0,360,0C300,0,240,0,180,0C120,0,60,0,30,0L0,0Z"></path>
            </svg>
            <div class="title">
                <p>Update Employee Details</p>
            </div>
            <div class="input_feild">
                <?php
                if (boolval($rows)) {
                    if (count($rows) > 0)
                        foreach ($rows

                            as $entry) {
                ?>

                        <div class="detail">
                            <p>Name : <?php echo $entry->first_name ?> <?php echo $entry->last_name ?></p>
                            <p>Employee ID: <?php echo $entry->employee_ID ?></p>
                        </div>
                        <form method="post">

                            <div class="address">
                                <label for="" id="left">Address</label>

                                <div class="address_content">
                                    <label for="street" id="left">Street</label>
                                    <input type="text" id="street" name="street" value="<?php echo $entry->street ?>">
                                    <label for="city" id="left">City</label>
                                    <input type="text" id="city" name="city" value="<?php echo $entry->city ?>">
                                    <label for="Province" id="left">Province</label>
                                    <select id="province" name="province">
                                        <option value="<?php echo $entry->province ?>"><?php echo (ucfirst($entry->province)) ?>
                                            Province
                                        </option>
                                        <option value="western">Western Province</option>
                                        <option value="central">Central Province</option>
                                        <option value="southern">Southern Province</option>
                                        <option value="uva">Uva Province</option>
                                        <option value="sabaragamuwa">Sabaragamuwa Province</option>
                                        <option value="north_western">North Western Province</option>
                                        <option value="north_central">North Central Province</option>
                                        <option value="nothern">Nothern Province</option>
                                        <option value="eastern">Eastern Province</option>

                                    </select>
                                </div>
                            </div>

                            <div class="marital">
                                <label for="marital" name="marital" id="left">Marital Status</label>
                                <input type="text" name="marital" id="set" value="<?php echo $entry->marital_status ?>">
                                <input type="radio" id="yes" name="marital" value="yes">
                                <label for="yes" id="left">Yes</label>
                                <input type="radio" id="no" name="marital" value="no">
                                <label for="no" id="left">No</label><br>
                            </div>
                            <div>
                                <label for="contact" id="left">Contact Number</label>
                                <input type="tel" id="contact" name="contact" placeholder="076-256****" pattern="[0-9]{3}-[0-9]{7}" size="50" value="<?php echo $entry->contact_number ?>">
                            </div>

                            <div>
                                <label for="email_current" id="left">Current E Mail</label>
                                <label for="email_current" id="left"><?php echo $entry->email ?></label><br>
                                <input type="email" id="email_current" name="email_current" value="<?php echo $entry->email ?>">
                            </div>

                            <div>
                                <label for="email_new" id="left">New E Mail</label>
                                <input type="email" id="email_new" name="email_new" size="50" required><br>
                            </div>
                            <div>
                                <p id="left">Current Supervisor ID</p>
                                <input type="hidden" name="c_supervisor" value="<?php echo $entry->supervisor_ID ?>">
                                <?php
                                if ($entry->supervisor_ID == 0) {
                                    $supervisor = "Root Employee, Don't have Supervisor";
                                } else {
                                    $supervisor = $entry->supervisor_ID;
                                }

                                ?>
                                <p id="left"><?php echo $supervisor ?></p><br>
                                <!-- <?php print_r($rows) ?> -->

                            </div>
                            <div>
                                <label for="supervisor" id="left">New Supervisor ID</label>
                                <input type="number" id="supervisor" name="supervisor" size="50" value="<?php echo $entry->supervisor_ID ?>">
                            </div>
                            <div id="newdepart">
                                <label for="department" id="left">Department</label>

                                <div id="dept_h">
                                    <div id="dept">
                                        <label id="d_left">Current</label>
                                        <!-- <label type="text" id="depart" name="depart" size="50" value="<?php echo $entry->department_ID ?>"> -->
                                        <?php
                                            if($entry->department_ID == 1){
                                                $depart = "Operational Department";
                                            }elseif($entry->department_ID == 2){
                                                $depart = "HR Department";
                                            }elseif($entry->department_ID == 3){
                                                $depart = "Sells Department";
                                            }else{
                                                $depart = "Financial Department";
                                            }
                                        ?>
                                        <label id="d_left"><?php echo $depart ?></label>
                                    </div>
                                    <div id="dept">
                                        <label id="d_left">New</label>
                                        <select id="department" name="department">

                                            <?php if ($entry->department_ID == 1) { ?>
                                                <option value=1>Operational Department</option>
                                                <option value=2>HR Department</option>
                                                <option value=3>Sells Department</option>
                                                <option value=4>Financal Department</option>
                                            <?php } elseif ($entry->department_ID == 2) { ?>
                                                <option value=2>HR Department</option>
                                                <option value=3>Sells Department</option>
                                                <option value=4>Financal Department</option>
                                                <option value=1>Operational Department</option>
                                            <?php } elseif ($entry->department_ID == 3) { ?>
                                                <option value=3>Sells Department</option>
                                                <option value=4>Financal Department</option>
                                                <option value=1>Operational Department</option>
                                                <option value=2>HR Department</option>
                                            <?php } else { ?>
                                                <option value=4>Financial Department</option>
                                                <option value=1>Operational Department</option>
                                                <option value=2>HR Department</option>
                                                <option value=3>Sells Department</option>
                                            <?php }
                                            ?>
                                            <!-- <option value = "" ><?php echo $entry->department_ID ?></option>
                                    <option value= 1 >Operational Department</option>
                                    <option value= 2 >HR Department</option>
                                    <option value= 3 >Sells Department</option>
                                    <option value= 4 >Account Department</option> -->
                                        </select>
                                    </div>
                                </div>


                            </div>

                    <?php }
                }

                    ?>
                    <div class="buttons">
                        <button type="sumbit" id="cancel" name="cancel">Cancel</button>
                        <button type="submit" id="add" name="submit">Update</button>
                    </div>

                        </form>


            </div>
        </div>

    </div>

</body>

</html>