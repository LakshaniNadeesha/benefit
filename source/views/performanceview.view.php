<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_PATH ?>color.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>formeremployees.css">
    <title>PerformenceView</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
<div class="former_emp">
    <table class="table" id="myTable" data-filter-control="true" data-show-search-clear-button="true">
</div>
<tr>
    <th></th>
    <th>Name</th>
    <!-- <th>Last Name</th> -->
    <th>NIC</th>
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
if (boolval($employee_details)) {
    // print_r($row);
    for ($i = 0; $i < sizeof($employee_details); $i++) {

        ?>
        <tr>
            <td><input type="checkbox" name="name1"></td>
            <td><?php print_r($employee_details[$i]['first_name']); ?><?php print_r($employee_details[$i]['last_name']); ?> </td>
            <!-- <td><?php print_r($employee_details[$i]['last_name']); ?></td> -->
            <td><?php print_r($employee_details[$i]['employee_NIC']); ?></td>
            <td><?php print_r($employee_details[$i]['communication']); ?></td>
            <td><?php print_r($employee_details[$i]['quality_of_work']); ?></td>
            <td><?php print_r($employee_details[$i]['organization']); ?></td>
            <td><?php print_r($employee_details[$i]['team_skills']); ?></td>
            <td><?php print_r($employee_details[$i]['communication_overall']); ?></td>
            <td><?php print_r($employee_details[$i]['quality_of_work_overall']); ?></td>
            <td><?php print_r($employee_details[$i]['organization_overall']); ?></td>
            <td><?php print_r($employee_details[$i]['team_skills_overall']); ?></td>
            <td><?php print_r($employee_details[$i]['multitasking_ability_overall']); ?></td>

        </tr>
        <?php
    }
} ?>
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
