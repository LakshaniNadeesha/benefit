<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href=" <?= CSS_PATH ?>outcome.css">
    <link rel="stylesheet" href="public\css\outcome.css">

    <title></title>
</head>

<body>

<div>
    <?php $this->view('includes/header1') ?>
</div>


<!-- <div class="profile">
        <?php
$this->view('includes/profile1');
?>
</div> -->
<!-- a -->
<div class="profile_container">
    <div class="profile">
        <?php
        $this->view('includes/profile1');
        ?>
    </div>


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
                                <a href="<?= PATH ?>" class="edit_icon"><i class="fas fa-edit"></i></a>
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
