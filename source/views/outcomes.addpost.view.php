<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= CSS_PATH ?>outcomes.addpost.css">
    <link>
<!--    <style>-->
<!--        input[type=text], select, textarea {-->
<!--            width: 100%;-->
<!--            padding: 12px;-->
<!--            border: 1px solid #ccc;-->
<!--            border-radius: 4px;-->
<!--            box-sizing: border-box;-->
<!--            margin-top: 6px;-->
<!--            margin-bottom: 16px;-->
<!--            resize: vertical;-->
<!--        }-->
<!---->
<!--        input[type=submit] {-->
<!--            background-color: #04AA6D;-->
<!--            color: white;-->
<!--            padding: 12px 20px;-->
<!--            border: none;-->
<!--            border-radius: 4px;-->
<!--            cursor: pointer;-->
<!--        }-->
<!---->
<!---->
<!--    </style>-->
</head>
<body>
<?php if (Auth::access('HR Officer') || Auth::access('HR Manager')): ?>

    <div>
        <?php $this->view('includes/header1') ?>
    </div>


    <div class="profile_container">
    
        <div class="container">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 50 1440 185"><path fill="#0f9eb8" fill-opacity="1" d="M0,64L26.7,58.7C53.3,
        53,107,43,160,80C213.3,117,267,203,320,218.7C373.3,235,427,181,480,181.3C533.3,181,587,235,640,229.3C693.3,224,747,160,800,
        128C853.3,96,907,96,960,112C1013.3,128,1067,160,1120,176C1173.3,192,1227,192,1280,170.7C1333.3,149,1387,107,1413,85.3L1440,
        64L1440,0L1413.3,0C1386.7,0,1333,0,1280,0C1226.7,0,1173,0,1120,0C1066.7,0,1013,0,960,0C906.7,0,853,0,800,0C746.7,0,693,0,640,
        0C586.7,0,533,0,480,0C426.7,0,373,0,320,0C266.7,0,213,0,160,0C106.7,0,53,0,27,0L0,0Z"></path></svg>

        <div class="back_btn">
        <a href="<?= PATH ?>Outcomes"><i class="large material-icons">arrow_back</i></a>
                </div>
    
            <h3>Meeting outcomes Form</h3>
            <form method="post">
                <div class="form_details">
                    <div class="row">
                        <label for="fname">Title</label>
                        <input type="text" id="title" name="title" placeholder="Title.." required="required">
                    </div>
                    <div class="row">
                        <label for="lname">Date</label>
                        <input type="date" id="date" name="date" placeholder="Your last name.." required="required"><br>
                    </div>
                    <div class="row">
                        <label for="subject">Outcomes</label>
                        <textarea id="outcomes" name="outcomes" placeholder="Write something.."
                                  required="required"></textarea><br>
                    </div>
                    <div class="buttons">
                        <input type="reset" value="Cancel">
                        <input type="submit" name="submit" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>
</body>
</html>
