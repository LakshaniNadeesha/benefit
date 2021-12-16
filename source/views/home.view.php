
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
        
        <div class="card_container" id = "financial">
            <div class="card">
                <h2>Financial Department</h2>
                <p><i class="fas fa-user-alt"></i>  Manger: Mr.Aruna</p>
                <p class="users"><i class="fas fa-users"></i>  10</p>
                <button class="show-more" id="financial">Show More <i class="fas fa-arrow-right"></i></button>
            </div>
        </div>
        
        <div class="card_container" id = "hr">
            <div class="card">
                <h2>HR Department</b></h2>
                <p><i class="fas fa-user-alt"></i>  Manger: Mr.Silva</p>
                <p class="users"><i class="fas fa-users"></i>  07</p>
                <button class="show-more" id="hr">Show More <i class="fas fa-arrow-right"></i></button>
            </div>
        </div>

        <div class="card_container" id = "operational">
            <div class="card">
                <h2>Operational Department</h2>
                <p><i class="fas fa-user-alt"></i>  Manger: Mr.Chathura</p>
                <p class="users"><i class="fas fa-users"></i> 38</p>
                <button class="show-more" id="operational">Show More <i class="fas fa-arrow-right"></i></button>
            </div>
        </div>

        <div class="card_container" id = "seles">
            <div class="card">
                <h2>Sales Department</h2>
                <p><i class="fas fa-user-alt"></i>  Manger: Mr.Bimsara</p>
                <p class="users"><i class="fas fa-users"></i> 25</p>
                <button class="show-more" id="seles">Show More <i class="fas fa-arrow-right"></i></button>
                <!-- <input type="button" value="Click" onclick="dosomething('Hello')"> -->
            </div> 
        <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="1" d="M0,256L30,229.3C60,203,120,149,180,106.7C240,64,300,32,360,26.7C420,21,480,43,540,58.7C600,75,660,85,720,80C780,75,840,53,900,37.3C960,21,1020,11,1080,53.3C1140,96,1200,192,1260,234.7C1320,277,1380,267,1410,261.3L1440,256L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path></svg> -->

        </div> 
        
    </div>

    <div class="right">
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
                <span class="confirm__title">Emplohyee Details</span>
                <button class="confirm__close">&times;</button>
            </div>
            <div class="confirm__content">
               <h2>Department Name</h2>
               <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sapiente quod, tempora quaerat
                    earum iste veniam recusandae ex deserunt quos distinctio aut necessitatibus nihil, autem 
                    obcaecati, ad ipsum molestias nemo dolore!</p>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sapiente quod, tempora quaerat
                    earum iste veniam recusandae ex deserunt quos distinctio aut necessitatibus nihil, autem 
                    obcaecati, ad ipsum molestias nemo dolore!</p>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sapiente quod, tempora quaerat
                    earum iste veniam recusandae ex deserunt quos distinctio aut necessitatibus nihil, autem 
                    obcaecati, ad ipsum molestias nemo dolore!</p>
                <div class="data">

                    <?php
                    if (boolval($rows)) {
                        if (count($rows) > 0) {
                            foreach ($rows[1] as $entry) { ?>
                                
                                    
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
