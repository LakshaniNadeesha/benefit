<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\css\color.css">
    <link rel="stylesheet" href="public\css\employeelist.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>Employees</title>
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
    <!-- <script src="https://kit.fontawesome.com/b99e675b6e.js"></script> -->
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
    $this->view('includes/header1');
    ?>
</div>

<div class="page_content">

    <?php if (Auth::access('HR Manager')): ?>
            <?php
            $this->view('includes/hrmanagernavbar');
//            $this->view('includes/hrnav');
            ?>
    <?php endif; ?>

    <?php if (Auth::access('HR Officer')): ?>
            <?php
//            $this->view('includes/hrofficernav');
                $this->view('includes/hrofficernavbar');
            ?>
    <?php endif; ?>


    <!-- nAAaAaaaaaaa -->

    <div class="main_container">
        

        <div class="details">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 50 1440 200"><path fill="#0f9eb8" fill-opacity="1" d="M0,64L26.7,58.7C53.3,
        53,107,43,160,80C213.3,117,267,203,320,218.7C373.3,235,427,181,480,181.3C533.3,181,587,235,640,229.3C693.3,224,747,160,800,
        128C853.3,96,907,96,960,112C1013.3,128,1067,160,1120,176C1173.3,192,1227,192,1280,170.7C1333.3,149,1387,107,1413,85.3L1440,
        64L1440,0L1413.3,0C1386.7,0,1333,0,1280,0C1226.7,0,1173,0,1120,0C1066.7,0,1013,0,960,0C906.7,0,853,0,800,0C746.7,0,693,0,640,
        0C586.7,0,533,0,480,0C426.7,0,373,0,320,0C266.7,0,213,0,160,0C106.7,0,53,0,27,0L0,0Z"></path></svg>
            
            <!-- <label for="department">Select Department<i class='fas fa-edit'></i></label> -->
                <div class="head">
                    <select id="department" name="department" onchange="myFunction()">
                        
                        <option value="oper">Operational Department</option>
                        <option value="hr">HR Department</option>
                        <option value="seles">Seles Department</option>
                        <option value="acc">Account Department</option>
                    </select>
                    <div class="search">
                        <i class='fa fa-search'></i>
                    </div>
                    <!-- <button type="submit" ></button> -->
                </div>
                
                
            <!-- <p id="demo">krkerk</p>   -->
            

            <div class="employee">
                <div class="title">
                    <p>Employees</p>
                </div>
                <div class="data" id= "oper">

                    <?php
                    if (boolval($rows[0])) {
                        if (count($rows[0]) > 0) {
                            foreach ($rows[0] as $entry) { ?>
                                
                                    <form method="post">
                                        <div class="cards">
                                            <input type="text" name="id" id="id"
                                                   value="<?php echo $entry->employee_ID ?>">
                                            <div class="img">
                                                <img src="<?php echo $entry->profile_image ?>" alt="">
                                            </div>
                                            <div class="name">
                                                <p><?php echo $entry->first_name." " .$entry->last_name ?> </p>
                                            </div>

                                            <div class="role">
                                                <p><?php echo $entry->user_role?> </p>
                                            </div>

                                            <div class="email">
                                                <p><?php echo $entry->email ?></p>
                                            </div>
                                            <div class="butons">
                                                <?php if (Auth::access('HR Manager')): ?>                                              
                                                    <button class="button-btn" type="submit" id="edit" name="edit"> <i class='fas fa-edit'></i> </button>       
                                                <?php endif; ?>
                                                <?php if (Auth::access('HR Officer') || Auth::access('HR Manager')): ?>                                              
                                                    <button class="button-btn" type="submit" id="delete" name="delete"> <i class='fas fa-trash-alt'></i> </button>                                                
                                                <?php endif; ?>
                                                                                        
                                            </div>
                                        </div>
                                    </form>
                                
                           <?php } 
                        }
                    } ?> 
                </div>

                <div class="data" id="hr" style="display: none;">

                    <?php
                    if (boolval($rows[1])) {
                        if (count($rows[1]) > 0) {
                            foreach ($rows[1] as $entry) { ?>
                                
                                    <form method="post">
                                        <div class="cards">
                                            <input type="text" name="id" id="id"
                                                   value="<?php echo $entry->employee_ID ?>">
                                            <div class="img">
                                                <img src="<?php echo $entry->profile_image ?>" alt="">
                                            </div>
                                            <div class="name">
                                                <p><?php echo $entry->first_name." " .$entry->last_name ?> </p>
                                            </div>

                                            <div class="role">
                                                <p><?php echo $entry->user_role?> </p>
                                            </div>

                                            <div class="email">
                                                <p><?php echo $entry->email ?></p>
                                            </div>
                                            <div class="butons">
                                                <?php if (Auth::access('HR Manager')): ?>                                              
                                                    <button class="button-btn" type="submit" id="edit" name="edit"> <i class='fas fa-edit'></i> </button>       
                                                <?php endif; ?>
                                                <?php if (Auth::access('HR Officer') || Auth::access('HR Manager')): ?>                                              
                                                    <button class="button-btn" type="submit" id="delete" name="delete"> <i class='fas fa-trash-alt'></i> </button>                                                
                                                <?php endif; ?>
                                                                                        
                                            </div>
                                        </div>
                                    </form>
                                
                           <?php } 
                        }
                    } ?> 
                </div>

                <div class="data" id="seles" style="display: none;">

                    <?php
                    if (boolval($rows[2])) {
                        if (count($rows[2]) > 0) {
                            foreach ($rows[2] as $entry) { ?>
                                
                                    <form method="post">
                                        <div class="cards">
                                            <input type="text" name="id" id="id"
                                                   value="<?php echo $entry->employee_ID ?>">
                                            <div class="img">
                                                <img src="<?php echo $entry->profile_image ?>" alt="">
                                            </div>
                                            <div class="name">
                                                <p><?php echo $entry->first_name." " .$entry->last_name ?> </p>
                                            </div>

                                            <div class="role">
                                                <p><?php echo $entry->user_role?> </p>
                                            </div>

                                            <div class="email">
                                                <p><?php echo $entry->email ?></p>
                                            </div>
                                            <div class="butons">
                                                <?php if (Auth::access('HR Manager')): ?>                                              
                                                    <button class="button-btn" type="submit" id="edit" name="edit"> <i class='fas fa-edit'></i> </button>       
                                                <?php endif; ?>
                                                <?php if (Auth::access('HR Officer') || Auth::access('HR Manager')): ?>                                              
                                                    <button class="button-btn" type="submit" id="delete" name="delete"> <i class='fas fa-trash-alt'></i> </button>                                                
                                                <?php endif; ?>
                                                                                        
                                            </div>
                                        </div>
                                    </form>
                                
                           <?php } 
                        }
                    } ?> 
                </div>
                <div class="data" id="acc" style="display: none;">

                    <?php
                    if (boolval($rows[3])) {
                        if (count($rows[3]) > 0) {
                            foreach ($rows[3] as $entry) { ?>
                                
                                    <form method="post">
                                        <div class="cards">
                                            <input type="text" name="id" id="id"
                                                   value="<?php echo $entry->employee_ID ?>">
                                            <div class="img">
                                                <img src="<?php echo $entry->profile_image ?>" alt="">
                                            </div>
                                            <div class="name">
                                                <p><?php echo $entry->first_name." " .$entry->last_name ?> </p>
                                            </div>

                                            <div class="role">
                                                <p><?php echo $entry->user_role?> </p>
                                            </div>

                                            <div class="email">
                                                <p><?php echo $entry->email ?></p>
                                            </div>
                                            <div class="butons">
                                                <?php if (Auth::access('HR Manager')): ?>                                              
                                                    <button class="button-btn" type="submit" id="edit" name="edit"> <i class='fas fa-edit'></i> </button>       
                                                <?php endif; ?>
                                                <?php if (Auth::access('HR Officer') || Auth::access('HR Manager')): ?>                                              
                                                    <button class="button-btn" type="submit" id="delete" name="delete"> <i class='fas fa-trash-alt'></i> </button>                                                
                                                <?php endif; ?>
                                                                                        
                                            </div>
                                        </div>
                                    </form>
                                
                           <?php } 
                        }
                    } ?> 
                </div>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 50 1440 200"><path fill="#0f9eb8" fill-opacity="1" d="M0,160L48,144C96,128,192,96,288,80C384,
            64,480,64,576,96C672,128,768,192,864,192C960,192,1056,128,1152,90.7C1248,53,1344,43,1392,37.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,
            320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
    </div>
</div>
<!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="1" d="M0,288L21.8,266.7C43.6,245,
87,203,131,160C174.5,117,218,75,262,96C305.5,117,349,203,393,240C436.4,277,480,267,524,234.7C567.3,203,611,149,655,154.7C698.2,160,
742,224,785,256C829.1,288,873,288,916,272C960,256,1004,224,1047,181.3C1090.9,139,1135,85,1178,96C1221.8,107,1265,181,1309,
202.7C1352.7,224,1396,192,1418,176L1440,160L1440,320L1418.2,320C1396.4,320,1353,320,1309,320C1265.5,320,1222,320,1178,320C1134.5,
320,1091,320,1047,320C1003.6,320,960,320,916,320C872.7,320,829,320,785,320C741.8,320,698,320,655,320C610.9,320,567,320,524,320C480,
320,436,320,393,320C349.1,320,305,320,262,320C218.2,320,175,320,131,320C87.3,320,44,320,22,320L0,320Z"></path></svg>
<div> -->
<!--<div>-->
<!--    --><?php //$this->view('includes/footer')?>
<!--</div>-->
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>

<script>
function myFunction() {
  var x = document.getElementById("department").value;
//   document.getElementById("demo").innerHTML = "You selected: " + x;
  console.log("myfunction called");

//   document.getElementById("oper").style.display = "none";
  document.getElementById("oper").style.display = "none";
  document.getElementById("hr").style.display = "none";
  document.getElementById("seles").style.display = "none";
  document.getElementById("acc").style.display = "none";
  document.getElementById(x).style.display = "block";
//   document.forms["myform"].submit();
//   alert("Value is sumitted");
  
}
</script>

</body>
</html>
