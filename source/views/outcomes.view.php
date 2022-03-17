<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_PATH ?>performance.css">
    <title></title>
    <style>
* {
  box-sizing: border-box;
}

/* Add a gray background color with some padding */
body {
  font-family: Arial;
  padding: 20px;
  background: #f1f1f1;
}

/* Header/Blog Title */
.header {
  padding: 30px;
  font-size: 40px;
  text-align: center;
  background: white;
}

/* Create two unequal columns that floats next to each other */
/* Left column */
.leftcolumn {   
  float: left;
  width: 75%;
}

/* Right column */
.rightcolumn {
  float: left;
  width: 25%;
  padding-left: 20px;
}

/* Fake image */
.fakeimg {
  background-color: #aaa;
  width: 100%;
  padding: 20px;
}

/* Add a card effect for articles */
.card {
   background-color: white;
   padding: 20px;
   margin-top: 20px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Footer */
.footer {
  padding: 20px;
  text-align: center;
  background: #ddd;
  margin-top: 20px;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 800px) {
  .leftcolumn, .rightcolumn {   
    width: 100%;
    padding: 0;
  }
}
</style>
</head>

<body>

<div>
   <?php $this->view('includes/header1')?>
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
  <div class="leftcolumn">
    <?php if (Auth::access('HR Officer') ||Auth::access('HR Manager')): ?>
    <form>
      <button type="submit"  formaction="<?= PATH ?>Outcomes/addpost" id="add" name="submit">Add new post</button>  
    </form>
    <?php endif; ?>
    <?php if(count($row)>0)
      for($i=sizeof($row)-1;$i>=0;$i--){ 
    ?>
    <div class="card">
      <h2><?php print_r($row[$i]->title);?></h2>
      <h5><?php print_r($row[$i]->date);?></h5>     
      <p>Outcomes..</p>
      <p><?php print_r($row[$i]->description);?></p>
      <?php if (Auth::access('HR Officer') ||Auth::access('HR Manager')): ?>
      <a href="<?= PATH ?>"><i class="fas fa-edit"></i></a>
      <?php endif;?>
    </div>
    <?php }?>
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
