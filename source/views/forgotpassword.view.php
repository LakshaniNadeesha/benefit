<?php ?>
<html>
<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="<?= CSS_PATH ?>login.css">
<title>Forgot-password</title>

<body>
<!--<div class="big-img"></div>-->
<div class="container">
    <div class="box-a">
        <h2 class="h2">ORACLE FREIGHT SOLUTIONS</h2>
        <form class="frm" action="" method="post">
    
            <div class="form1" >
                <label for="uname"></label>
                <input type="text" class="new1" placeholder="Enter UserEmail" name="email" required><br>
            </div>
            <div class="reset_form">
                <button type="submit" name="reset-req" class="reset_btn">Reset</button>
            </div>
        </form>
        <div class="reset_form">
            <a href="<?=PATH?>"><button type="submit" name="back_btn" class="back_btn" value="Back"><i class="large material-icons">arrow_back</i><span>Back</span></button></a>
        </div>
        <div class="check-email" style="text-align: center; font-size: 15px; color: #22242A">
        <?php
            if(isset($_GET['reset']))
            {
                if($_GET['reset']=="success")
                {
                    echo '<p>Check your e-mail</p> ';
                }

            }

        ?>
    </div>
    </div>
</div>


</body>
</html>
