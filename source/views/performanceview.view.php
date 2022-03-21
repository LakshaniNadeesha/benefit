<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="<?= CSS_PATH ?>color.css">
    <!-- <link rel="stylesheet" href="<?= CSS_PATH ?>supervisorviewperformance.css"> -->
    <title>PerformenceView</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?=CSS_PATH?>footer.css">
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
    $this->view('includes/header1');
    ?>
</div>

    <div class="page_content">
    <?php if (Auth::access('HR Officer')):
//    $this->view('includes/supervisornav');
    $this->view('includes/hrofficernavbar');
endif;
if (Auth::access('HR Manager')):
    $this->view('includes/hrmanagernavbar');
endif;
    ?>
</div>
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
                    <th>NIC </th>
                    <th>communication</th>
                    <th>quality of work</th>
                    <th>organization</th>
                    <th>team skills</th>
                    <th>Communication overall</th>
                    <th>Quality of work overall</th>
                    <th>Organization overall</th>
                    <th>Team skills overall</th>
                    <th>Multitasking ability overall</th>
                    
                </tr>
                <?php
                     // foreach ($row as $key ) 
                if(boolval($employee_details))
                { 
                   // print_r($row);
                    for($i=0;$i<sizeof($employee_details);$i++){

                    ?>
                <tr>
                    <td><input type="checkbox" name="name1" ></td>
                    <td><?php print_r($employee_details[$i]['first_name']);?> <?php print_r($employee_details[$i]['last_name']);?> </td>
                    <!-- <td><?php print_r($employee_details[$i]['last_name']);?></td> -->
                    <td><?php print_r($employee_details[$i]['employee_NIC']);?></td>
                    <td><?php print_r($employee_details[$i]['communication']);?></td>
                    <td><?php print_r($employee_details[$i]['quality_of_work']);?></td>
                    <td><?php print_r($employee_details[$i]['organization']);?></td>
                    <td><?php print_r($employee_details[$i]['team_skills']);?></td>
                    <td><?php print_r($employee_details[$i]['communication_overall']);?></td>
                    <td><?php print_r($employee_details[$i]['quality_of_work_overall']);?></td>
                    <td><?php print_r($employee_details[$i]['organization_overall']);?></td>
                    <td><?php print_r($employee_details[$i]['team_skills_overall']);?></td>
                    <td><?php print_r($employee_details[$i]['multitasking_ability_overall']);?></td> 

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
                td = tr[i].getElementsByTagName("td")[2];
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
