<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href=" <?= CSS_PATH ?>outcome.css">
<!--    <link rel="stylesheet" href="public\css\outcome.css">-->

    <title></title>
</head>

<body>

<div>
    <?php $this->view('includes/header1') ?>
</div>


<div class="profile_container">

  

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 50 1440 185"><path fill="#0f9eb8" fill-opacity="1" d="M0,64L26.7,58.7C53.3,
        53,107,43,160,80C213.3,117,267,203,320,218.7C373.3,235,427,181,480,181.3C533.3,181,587,235,640,229.3C693.3,224,747,160,800,
        128C853.3,96,907,96,960,112C1013.3,128,1067,160,1120,176C1173.3,192,1227,192,1280,170.7C1333.3,149,1387,107,1413,85.3L1440,
        64L1440,0L1413.3,0C1386.7,0,1333,0,1280,0C1226.7,0,1173,0,1120,0C1066.7,0,1013,0,960,0C906.7,0,853,0,800,0C746.7,0,693,0,640,
        0C586.7,0,533,0,480,0C426.7,0,373,0,320,0C266.7,0,213,0,160,0C106.7,0,53,0,27,0L0,0Z"></path></svg>
    
        <div class="row">
        <div class="title">Meeting Outcomes</div>
        <div class="leftcolumn">
            <?php if (Auth::access('HR Officer') || Auth::access('HR Manager')): ?>
                <form class="add_meeting">
                    <button type="submit" formaction="<?= PATH ?>Outcomes/addpost" id="add" name="submit">Add
                    </button>
                </form>
            <?php endif; ?>
            <?php if (count($row) > 0)
                for ($i = sizeof($row) - 1; $i >= 0; $i--) {
                    ?>
                    <div class="card">
                        <div class="meeting_name">
                            <h2><?php print_r($row[$i]->title); ?></h2>
                            <?php if (Auth::access('HR Officer') || Auth::access('HR Manager')): ?>
                                <a href="<?= PATH ?>/Outcomes/updatepost/<?php print_r($row[$i]->post_id); ?>" class="edit_icon"><i class="fas fa-edit"></i></a>
                            <?php endif; ?>
                        </div>
                        <h5>Meeting Date: <?php print_r($row[$i]->date); ?></h5>
                        <p class="sub_title">Outcomes..</p>
                        <div class="outcome">

                            <p class="outcome_content"><?php print_r($row[$i]->description); ?></p>

                        </div>
                    </div>
                <?php } ?>
        </div>
    </div>
</div>
</div>


<!-- a -->
<!-- <div class="header">
  <h2>Blog Name</h2>
</div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">
      <h2>TITLE HEADING</h2>
      <h5>Title description, Dec 7, 2017</h5>
      
      <p>Some text..</p>
      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
    </div>
    <div class="card">
      <h2>TITLE HEADING</h2>
      <h5>Title description, Sep 2, 2017</h5>
      <p>Some text..</p>
      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
    </div>
  </div>
</div> -->
</body>
</html>
</body>

</html>
