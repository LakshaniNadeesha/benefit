
<!DOCTYPE html>
<html>
<head>
	    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <!-- <link rel="stylesheet" href="<?= CSS_PATH ?>supervisorviewperformance.css"> -->
     
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Fomer Employees</title>
	<style>
* {box-sizing: border-box;}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnavs {
  overflow: hidden;
  background-color: #e9e9e9;
}

.topnavs a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnavs a:hover {
  background-color: #ddd;
  color: black;
}

.topnavs a.active {
  background-color: #2196F3;
  color: white;
}

.topnavs .search-container {
  float: right;
}

.topnavs input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}

.topnavs .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}

@media screen and (max-width: 600px) {
  .topnavs .search-container {
    float: none;
  }
  .topnavs a, .topnav input[type=text], .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnavs input[type=text] {
    border: 1px solid #ccc;  
  }
}
</style>
</head>
<body>
	<div>
    <?php
    $this->view('includes/header1')
    ?>
</div>


<div class="page_content">
    <?php if (Auth::access('HR Manager')): ?>
        <?php
//        $this->view('includes/hrnav');
        $this->view('includes/hrmanagernavbar');
        ?>
    <?php endif; ?>

    <?php if (Auth::access('HR Officer')): ?>
        <?php
        $this->view('includes/hrofficernavbar');
        ?>
    <?php endif; ?>

<!-- 	<?php
		print_r($row);

	 ?>
 -->
<div class="topnavs">
  <div class="search-container">
<input st type="text" id="myInput" onkeyup='tableSearch()' placeholder="Search By NIC" class="fa fa-search">
</div>
</div>

<table class="table" id="myTable" data-filter-control="true" data-show-search-clear-button="true">

                <tr>
                    <th><label>
                            <input name="select_all" value="1" type="checkbox">
                        </label></th>
                    <th>Name</th>
                    <!-- <th>Last Name</th> -->
                    <th>Gender</th>
                    <th>NIC</th>
                    <th>Communication overall</th>
                    <th>Quality of work overall</th>
                    <th>Organizationoverall</th>
                    <th>Team skills overall</th>
                    <th>Multitasking ability overall</th>
                    <th>Last modifydate</th>
                    <th>Option</th>
                    
                </tr>
                <?php
                     // foreach ($row as $key ) 
                if(boolval($row))
                { 
                   // print_r($row);
                    for($i=0;$i<sizeof($row);$i++){

                    ?>


                <tr>
                    <td><input type="checkbox" name="name1" ></td>
<!--                    <td>--><?php //print_r($row[$i]['first_name']);?><!--  --><?php //print_r($row[$i]['last_name']);?><!--</td>-->
                    <!-- <td><?php print_r($row[$i]['last_name']);?> </td> -->
                    <td><?php print_r($row[$i]['gender']);?> </td>
                    <td><?php print_r($row[$i]['employee_NIC']);?></td>
                    <td><?php print_r($row[$i]['details']->communication_overall);echo"%";?></td>
                    <td><?php print_r($row[$i]['details']->quality_of_work_overall);echo"%";?></td>
                    <td><?php print_r($row[$i]['details']->organization_overall);echo"%";?></td>
                    <td><?php print_r($row[$i]['details']->team_skills_overall);echo"%";?></td>
                    <td><?php print_r($row[$i]['details']->multitasking_ability_overall);echo"%";?></td>
                    <td><?php print_r($row[$i]['details']->last_modifydate);echo"%";?></td>
                   <td> 
                        <a href="<?= PATH ?>UpdateemployeeController/addfomeremp/<?=$row[$i]['employee_ID']?>"><i class="fas fa-edit"></i></a>
                    </td>
                    
                </tr>
                <?php
                     }   
                    }?>
            </table>
<script type="application/javascript">
        function tableSearch() {
            let input, filter, table, tr, td, txtValue;

            //Intialising Variables
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            for (let i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[4];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }

        }
    </script>
	
</body>
</html>
