
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
     <link rel="stylesheet" href="<?=CSS_PATH?>home.css">
     <link rel="stylesheet" href=" <?=CSS_PATH?>popup.css">
     <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
     <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <title>Home Page</title>
    
</head>

<body>
<div>
    
   <?php $this->view('includes/header1')?>
   
</div>


<div class="container">
    <div class="left">
        
        <div class="card_container" >
            <div class="card">
                <h2>Financial Department</h2>
<!--                <p><i class="fas fa-user-alt"></i>  Manger: Mr.Aruna</p>-->
                <p class="users"><i class="fas fa-users"></i>
                    <?php if (boolval($rows[3])) {
                        echo " ";
                        print_r(sizeof($rows[3]));
                    }?>
                </p>
                <button class="show-more" id="financial" >Show More <i class="fas fa-arrow-right"></i></button>
                <form action="" method="post"><input type="hidden" name="hide" id="hide" value=""></form>
            </div>
        </div>

        <div class="card_container" >
            <div class="card">
                <h2>Operational Department</h2>
                <!--                <p><i class="fas fa-user-alt"></i>  Manger: Mr.Chathura</p>-->
                <p class="users"><i class="fas fa-users"></i>
                    <?php if (boolval($rows[0])) {
                        echo " ";
                        print_r(sizeof($rows[0]));
                    }?>
                </p>
                <button class="show-more" id="operational" >Show More <i class="fas fa-arrow-right"></i></button>
                <!-- <form action="" method="post"><input type="hidden" name="hide" id="hide" value=""></form> -->
            </div>
        </div>

        <div class="card_container" >
            <div class="card">
                <h2>HR Department</b></h2>
<!--                <p><i class="fas fa-user-alt"></i>  Manger: Mr.Silva</p>-->
                <p class="users"><i class="fas fa-users"></i>
                    <?php if (boolval($rows[1])) {
                        echo " ";
                        print_r(sizeof($rows[1]));
                    }?>
                </p>
                <button class="show-more" id="hr" >Show More <i class="fas fa-arrow-right"></i></button>
                <!-- <form action="" method="post"><input type="hidden" name="hide" id="hide" value=""></form> -->
            </div>
        </div>

        <div class="card_container" >
            <div class="card">
                <h2>Sales Department</h2>
<!--                <p><i class="fas fa-user-alt"></i>  Manger: Mr.Bimsara</p>-->
                <p class="users"><i class="fas fa-users"></i>
                    <?php if (boolval($rows[2])) {
                        echo " ";
                        print_r(sizeof($rows[2]));
                    }?>
                </p>
                <button class="show-more" id="seles" type="submit" >Show More <i class="fas fa-arrow-right"></i></button>
                <!-- <form  method="get"><input type="hidden" name="hide" id="hide" value="<?php $i ?>" ></form> -->
                <!-- <input type="button" value="Click" onclick="dosomething('Hello')"> -->
            </div> 
        <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="1" d="M0,256L30,229.3C60,203,120,149,180,106.7C240,64,300,32,360,26.7C420,21,480,43,540,58.7C600,75,660,85,720,80C780,75,840,53,900,37.3C960,21,1020,11,1080,53.3C1140,96,1200,192,1260,234.7C1320,277,1380,267,1410,261.3L1440,256L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path></svg> -->

        </div> 
        
    </div>

    <div class="right" >
        <div class="cal">
            <?php $this->view('includes/calendar')?>
        </div>  
    </div>
</div>



<!-- <footer>
        <p class="ofs">Copyright © 2021 Oracle Freight Solutions | Powered by Oracle Freight Solutions</p>
</footer> -->
    
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 100 1440 180"><path fill="#0f9eb8" fill-opacity="1" d="M0,256L26.7,261.3C53.3,
267,107,277,160,266.7C213.3,256,267,224,320,224C373.3,224,427,256,480,245.3C533.3,235,587,181,640,154.7C693.3,128,747,128,800,
128C853.3,128,907,128,960,138.7C1013.3,149,1067,171,1120,165.3C1173.3,160,1227,128,1280,122.7C1333.3,117,1387,139,1413,149.3L1440,
160L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,
800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,
27,320L0,320Z"></path></svg>
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>

<!-- newly added -->

<div class="confirm init" >
        <div class="confirm__window ">
            <div class="confirm__titlebar">
                <span class="confirm__title">Employee Details</span>
                <button class="confirm__close">&times;</button>
            </div>
            <div class="confirm__content" id="doperation" style="display: none;">
               
               <h2 >Operational Department</h2>
               <p>An operations department ensures that the production process is completed 
                   from start to finish. These production processes need to line up with the goals and 
                   functions of other departments within a company.</p>
                  
                <div class="data">

                    <?php
                    
                    if (boolval($rows)) {
                        if (count($rows) > 0) {
                            foreach ($rows[0] as $entry) { ?>
                                
                                    
                                <div class="cards" id = "d1" >
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
                                    
                                </div>
                                   
                            <?php }
                           
                        }
                    } ?> 
                </div>
            </div>
            <div class="confirm__content" id="dhr" style="display: none;">
                
               <h2 >HR Department</h2>
               <p>An HR department is tasked with maximizing employee productivity and protecting the company from any issues that may arise
                   within the workforce. HR responsibilities include compensation and benefits, recruitment, firing, and keeping 
                   up to date with any laws that may affect the company and its employees.</p>
                <p>Functions in HR Department</p>
                <ul>
                    <li>Human resource planning</li>
                    <li>Recruitment and selection</li>
                    <li>Performance management</li>
                    <li>Job Analysis</li>
                    <li>Staffing</li>
                    <li>Training and Development</li>

                </ul>  

                   
                <div class="data">

                    <?php
                    
                    if (boolval($rows)) {
                        if (count($rows) > 0) {
                            foreach ($rows[1] as $entry) { ?>
                                
                                    
                                <div class="cards" >
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
                                    
                                </div>
                                   
                            <?php }
                           
                        }
                    } ?> 
                </div>
            </div>

            <div class="confirm__content" id="dselse" style="display: none;">
                
               <h2 >Seles Department</h2>
               <p>The sales department consists of a set of business activities and processes that help a sales organization run 
                   effectively, efficiently and in support of business strategies and objectives. The sales department 
                   generally includes sales, sales support or business operations.</p>
                  
                <div class="data">

                    <?php
                    
                    if (boolval($rows)) {
                        if (count($rows) > 0) {
                            foreach ($rows[2] as $entry) { ?>
                                
                                    
                                <div class="cards"  >
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
                                    
                                </div>
                                   
                            <?php }
                           
                        }
                    } ?> 
                </div>
            </div>

            <div class="confirm__content" id="dfinancial" style="display: none;">
               
               <h2 >Financial Department</h2>
               <p>A finance department is the unit of a business responsible for obtaining and handling any monies on behalf of the organization. 
                   The department controls the income and expenditure in addition to ensuring effective business running with minimum disruptions.</p> 
                <p>Besides the roles of handling the payroll, income and expenses, finance department responsibilities also include 
                   economic analysis to improve key business strategies.</p>
             
                <div class="data">

                    <?php
                    
                    if (boolval($rows)) {
                        if (count($rows) > 0) {
                            foreach ($rows[3] as $entry) { ?>
                                
                                    
                                <div class="cards"  >
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
                                    
                                </div>
                                   
                            <?php }
                           
                        }
                    } ?> 
                </div>
            </div>
            <div class="confirm__buttons">
                <!-- <button class="confirm__button confirm__button--ok confirm__button--fill">OK</button> -->
                <button class="confirm__button confirm__button--cancel ">OK</button>

            </div>
        </div>
</div>

<script src="public\js\popup.js"></script>
    <script>
        
    </script>

</body>   
</html>

	<!--<?=Auth::getfirst_name()?>-->
