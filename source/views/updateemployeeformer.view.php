
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\css\color.css">
   <!--  <link rel="stylesheet" href="public\css\updateemployeeformer.css"> -->

    <title>Update former employee</title>
    <style >
        body {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif;
    background-color: var(--background);
    display: flex;
    flex-direction: column;
    justify-content: center;
    /* background-color: aqua; */
}

input {
    outline: none !important;
    font-size: large;
    border-style: none;
    border-bottom: solid 1px rgba(0, 0, 0, 0.418);
    color: var(--header);
    /* font-weight: bold; */
}

select option {
    color: var(--header);
}

.main_container {
    max-width: 100vw;
    display: flex;
    justify-content: center;
    /* height:100vh; */
}

svg{
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.main_container .form {
    width: 60%;
    margin: 8px;
    padding-bottom: 20px;
    height: auto;
    background-color: rgb(255, 255, 255);
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    box-shadow: 3px 5px 15px rgba(0, 0, 0, .20);
}

.main_container .form .title {
    text-align: center;
    font-size: x-large;
    font-weight: bold;
    /* background-color: var(--blue); */
}

.main_container .form .input_feild {
    max-width: 100%;
}

.main_container .form .input_feild .detail {
    padding: 15px;
    display: flex;
    justify-content: space-between;
}

.main_container .form .input_feild form {
    max-width: 100%;
    color: rgba(0, 0, 0, 0.685);
    font-size: large;
    display: flex;
    flex-direction: column;
}

.main_container .form .input_feild form div {
    padding: 15px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}

.main_container .form .input_feild div label {
    display: block;
    width: 220px;
    height: 30px;
    /* background-color: aqua; */
}

.main_container .form .input_feild div input {
    padding-left: 30px;
    width: 100%;
}

.main_container .form .input_feild form .address {
    display: flex;
    flex-direction: column;
}

.main_container .form .input_feild form div .address_content {
    display: flex;
    flex-direction: column;
    margin-left: 150px;
    max-width: 100%;
}

.main_container .form .input_feild form div .address_content input {
    padding-left: 10px;
    height: 30px;
}

.main_container .form .input_feild form div .address_content label {
    display: block;
    width: 150px;
    text-align: left;
    padding: 4px;
}

.main_container .form .input_feild form .marital input {
    width: 40px;
    padding-left: 10px;
    height: 15px;
}

.main_container .form .input_feild form div select {
    border-radius: 3px;
    height: 30px;
    padding: 4px;
    font-size: large;
}

.main_container .form .input_feild form .buttons {
    display: flex;
    max-width: 100%;
    justify-content: space-around;
    margin: 10px;
   
}

#email_current {
    width: 0;
    visibility: hidden;
}

#set {
    width: 0;
    visibility: hidden;
}

.main_container .form .input_feild form .buttons button {
    width: 150px;
    border-radius: 100px;
    color: var(--header);
    cursor: pointer;
    display: inline-block;
    font-family: Arial, Helvetica, sans-serif;
    font-weight: bold;
    padding: 7px 20px;
    text-align: center;
    text-decoration: none;
    transition: all 250ms;
    border: 0;
    font-size: 16px;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    letter-spacing: 2px;
}

.main_container .form .input_feild form .buttons #cancel {
    color: var(--red);
    background-color: #fcfaf9;
    border: 1.5px solid black;
}

.main_container .form .input_feild form .buttons #add {
    background-color: #6fccee;
    border: 1.5px solid var(--header);
    border: 1.5px solid black;
}

.main_container .form .input_feild form .buttons :hover {
    box-shadow: 0px 2px 5px var(--header);
    transform: scale(1.05);
    border-style: none;
}

@media screen and (max-width: 1000px) {
    .main_container {
        /* margin: 4%; */
        max-width: 100%;
        /* padding-right: 5px; */
        flex-direction: column-reverse;
    }
    .main_container .form {
        /* max-width: 100%; */
        width: 100%;
        margin: 0px;
        margin-bottom: 10px;
        /* padding: 5px; */
    }
}

@media screen and (max-width: 737px) {
    .main_container {
        margin: 1%;
    }
    .main_container .form .input_feild form div {
        display: flex;
        flex-direction: column;
    }
    .main_container .form .input_feild form div .address_content {
        display: flex;
        flex-direction: column;
        margin-left: 0;
    }
    .main_container .form .input_feild form div .address_content label {
        text-align: start;
        padding: 8px;
    }
    .main_container .form .input_feild form .marital {
        display: flex;
        flex-direction: row;
    }
    .main_container .form .input_feild form .buttons {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
}
    </style>
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
                                <label for="">Address</label>

                                <div class="address_content">
                                    <label for="street">Street</label>
                                    <input type="text" id="street" name="street" value="<?php echo $entry->street ?>">
                                    <label for="city">City</label>
                                    <input type="text" id="city" name="city" value="<?php echo $entry->city ?>">
                                    <label for="Province">Province</label>
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
                                <label for="marital" name="marital">Marital Status</label>
                                <input type="text" name="marital" id="set" value="<?php echo $entry->marital_status ?>">
                                <input type="radio" id="yes" name="marital" value="yes">
                                <label for="yes">Yes</label>
                                <input type="radio" id="no" name="marital" value="no">
                                <label for="no">No</label><br>
                            </div>
                            <div>
                                <label for="contact">Contact Number</label>
                                <input type="tel" id="contact" name="contact" placeholder="076-256****" pattern="[0-9]{3}-[0-9]{7}" size="50" value="<?php echo $entry->contact_number ?>">
                            </div>

                            <div>
                                <label for="email_current">Current E Mail</label>
                                <label for="email_current"><?php echo $entry->email ?></label><br>
                                <input type="email" id="email_current" name="email_current" value="<?php echo $entry->email ?>">
                            </div>

                            <div>
                                <label for="email_new">New E Mail</label>
                                <input type="email" id="email_new" name="email_new" size="50" required><br>
                            </div>
                            <div>
                                <p>Current Supervisor ID</p>

                                <?php
                                if ($entry->supervisor_ID == 0) {
                                    $supervisor = "Root Employee, Don't have Supervisor";
                                } else {
                                    $supervisor = $entry->supervisor_ID;
                                }

                                ?>
                                <p><?php echo $supervisor ?></p><br>
                                <!-- <?php print_r($rows) ?> -->

                            </div>
                            <div>
                                <label for="supervisor">New Supervisor ID</label>
                                <input type="number" id="supervisor" name="supervisor" size="50" value="<?php echo $entry->supervisor_ID ?>">
                            </div>
                            <div>
                                <label for="department">Department</label>
                                <input type="text" id="department" name="department" size="50" value="<?php echo $entry->department_ID ?>">
                                <select id="department" name="department" >

                                <?php if($entry->department_ID == 1){?>
                                    <option value= 1 >Operational Department</option>
                                    <option value= 2 >HR Department</option>
                                    <option value= 3 >Sells Department</option>
                                    <option value= 4 >Account Department</option>
                                <?php }
                                elseif($entry->department_ID == 2){ ?>
                                    <option value= 2 >HR Department</option>
                                    <option value= 3 >Sells Department</option>
                                    <option value= 4 >Account Department</option>
                                    <option value= 1 >Operational Department</option>
                                <?php }
                                elseif($entry->department_ID == 3) { ?>
                                    <option value= 3 >Sells Department</option>
                                    <option value= 4 >Account Department</option>
                                    <option value= 1 >Operational Department</option>
                                    <option value= 2 >HR Department</option>
                                <?php }
                                else { ?> 
                                    <option value= 4 >Account Department</option>
                                    <option value= 1 >Operational Department</option>
                                    <option value= 2 >HR Department</option>
                                    <option value= 3 >Sells Department</option>
                                <?php }
                                ?>
                                    <!-- <option value = "" ><?php echo $entry->department_ID ?></option>
                                    <option value= 1 >Operational Department</option>
                                    <option value= 2 >HR Department</option>
                                    <option value= 3 >Sells Department</option>
                                    <option value= 4 >Account Department</option> -->
                                </select>
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
