<?php ?>
<html>
<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= CSS_PATH ?>login.css">
<title>Forgot-password</title>

<body>
        <?php
    error_reporting(E_ERROR | E_PARSE);
     if(boolval($errors))
     {
       error_reporting(E_ERROR | E_PARSE);
      foreach ($errors as $key ) {
        // code...
      
       $alert = "<script> alert ('$key')</script>";
          print_r($alert);   
        }
     }
    ?>
    <!--<?php
    $selector=$_GET['selector'];
    $validator=$_GET['validator'];
    if(empty($selector||$validator))
    {
        echo "Could not validate your request";
    }
    else
    {
        if(ctype_xdigit($selector)!==false &&ctype_xdigit($validator)!==false)
        {?>-->
            <div class="container">
    <div class="box-a">
        <h3 class="h3">ORACLE FREIGHT SOLUTIONS (PVT) LTD</h3>
        <form class="frm"  method="post">
    
            <div class="form1" >
                <input type="hidden" name="selector" value="<?php echo $selector ?>">
                <input type="hidden"  name="validator" value="<?php echo $validator ?>">
                <input class="new1" name="password" required id="password" placeholder="Enter password" type="text" size="25" maxlength="100" onkeyup="return passwordChanged();" /><br>
                <label  id="strength"></label><br>
               <!--  <input type="text" class="new1" placeholder="Enter password" name="password" required><br> -->

                <input type="text" class="new1" placeholder="Re-enter password" name="pwd-password" required><br> 
            </div>
            <div class="form2">
                 <button type="submit" name="reset-password">Reset Password</button>
            </div>
        </form>
          <div class="reset_form">
            <a href="<?=PATH?>"><button type="submit" name="back_btn" class="back_btn" value="Back"><i class="large material-icons"></i><span>Back</span></button></a>
        </div>
    </div>
</div>

        <?php
    }
    }

    ?>
    <script language="javascript">
    function passwordChanged() {
        var strength = document.getElementById('strength');
        var strongRegex = new RegExp("^(?=.{14,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
        var mediumRegex = new RegExp("^(?=.{10,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
        var enoughRegex = new RegExp("(?=.{8,}).*", "g");
        var pwd = document.getElementById("password");
        if (pwd.value.length == 0) {
            strength.innerHTML = 'Type Password';
        } else if (false == enoughRegex.test(pwd.value)) {
            strength.innerHTML = 'More Characters';
        } else if (strongRegex.test(pwd.value)) {
            strength.innerHTML = '<span style="color:green">Strong!</span>';
        } else if (mediumRegex.test(pwd.value)) {
            strength.innerHTML = '<span style="color:orange">Medium!</span>';
        } else {
            strength.innerHTML = '<span style="color:red">Weak!</span>';
        }
    }
</script>



</body>
</html>


