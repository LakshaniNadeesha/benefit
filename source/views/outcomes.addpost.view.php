<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?= CSS_PATH ?>performance.css">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
</head>
<body>
  <?php if (Auth::access('HR Officer') ||Auth::access('HR Manager')): ?>

<div>
   <?php $this->view('includes/header1')?>
</div>


<div class="profile_container">
    <div class="profile">
        <?php
        $this->view('includes/profile1');
        ?>
    </div>
<div class="container">
  <h3>Meeting outcomes Form</h3>
  <form method="post">
    <label for="fname">Title</label>
    <input type="text" id="title" name="title" placeholder="title.." required="required">

    <label for="lname">Date</label>
    <input type="date" id="date" name="date" placeholder="Your last name.." required="required"><br>
  <br>
    <label for="subject">Outcomes</label>
    <textarea id="outcomes" name="outcomes" placeholder="Write something.." required="required" style="height:200px"></textarea>

    <input type="submit" name="submit" value="Submit">
  </form>
</div>
</div>
<?php endif; ?>
</body>
</html>
