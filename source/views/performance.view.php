<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="<?= CSS_PATH ?>header2.css"> -->
    <link rel="stylesheet" href="<?= CSS_PATH ?>performance.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <title></title>
</head>
<body>
<div>
    <?php
    $this->view('includes/header1');
    ?>
</div>
<div class="profile_container">
    <div class="profile">
        <?php
        $this->view('includes/profile1');
        ?>
    </div>

    <div class="content" id="cont">
        <?php
        $this->view('includes/header2');
        ?>
        <div class="performance_details">
            <div class="heading">
                <h2>PERFORMANCES</h2>
            </div>
            <div>
                <div class="conta">
                    <div class="row">
                        <div class="col-6 chart" >
                            <canvas id="myChart2" ></canvas>
                        </div>
                    </div>
                </div>
                <?php
                //print_r($row);
                if (boolval($row) > 0) {
                    //print_r($row);
                    $rows = [$row[0]->communication, $row[0]->quality_of_work, $row[0]->organization, $row[0]->team_skills, $row[0]->multitasking_ability];
                   // print_r($rows);
                    $rowss = [$row[0]->communication_overall, $row[0]->quality_of_work_overall, $row[0]->organization_overall, $row[0]->team_skills_overall, $row[0]->multitasking_ability_overall];
                    $sum1=[$sum['communication'],$sum['quality_of_work'],$sum['organization'],$sum['team_skills'],$sum['multitasking_ability']];
                    $s2=[$summ['communication_overall'],$summ['quality_of_work_overall'],$summ['organization_overall'],$summ['team_skills_overall'],$summ['multitasking_ability_overall']];
                    // print_r($sum2);

                    ?>
                    <canvas id="myChart"></canvas>
                    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chart.js/2.7.3/chart.min.js" ></script> -->
                    <script type="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
                    <script >
                      var ctx=document.getElementById('myChart').getContext('2d');
                      var data2=<?=json_encode($rows)?>;
                   
                      var data4=<?=json_encode($sum1)?>;
                  
                      var chart= new Chart(ctx,{
                        type:'radar',
                        data:{
                            labels:['Communication', 'Quality of work', 'Organization', 'Team skills', 'Multitasking ability'],
                            datasets:[{
                                label:"My Last 3 Months Performance",
                                backgroundColor:'rgba(0,200,132,0.1)',
                                borderColor:'rgb(0,200,132)',
                                //data:[0,10,5,2,30],
                                data:data2,
                            },{
                                label:"Last 3 Months All Employee Performances",
                                backgroundColor:'rgba(0,100,132,0.1)',
                                borderColor:'rgb(0,100,132)',
                                // data:[0,10,5,2,30],
                                data:data4,
                            }]
                        },
                        options: {}
                      }); 
                    </script>

                <?php }?>
            </div>
        </div>
         <div class="performance_details">
            <div>
                <div class="conta">
                    <div class="row">
                        <div class="col-6 chart" >
                            <canvas id="myChart2" ></canvas>
                        </div>
                    </div>
                </div>
                <?php
               
                if (boolval($row) > 0) {
                    
                    
                  
                    $rowss = [$row[0]->communication_overall, $row[0]->quality_of_work_overall, $row[0]->organization_overall, $row[0]->team_skills_overall, $row[0]->multitasking_ability_overall];
                    
                    $s2=[$summ['communication_overall'],$summ['quality_of_work_overall'],$summ['organization_overall'],$summ['team_skills_overall'],$summ['multitasking_ability_overall']];
                    

                    ?>
                    <canvas id="myChart1"></canvas>
                    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chart.js/2.7.3/chart.min.js" ></script> -->
                    <script type="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
                    <script >
                      var ctxs=document.getElementById('myChart1').getContext('2d');
                      
                      var data3=<?=json_encode($rowss)?>;
                      
                      var data5=<?=json_encode($s2)?>;
                      var chart= new Chart(ctxs,{
                        type:'radar',
                        data:{
                            labels:['Communication', 'Quality of work', 'Organization', 'Team skills', 'Multitasking ability'],
                            datasets:[{
                                label:"My Overall Performances",
                                backgroundColor:'rgba(0,0,132,0.1)',
                                borderColor:'rgb(0,0,132)',
                                //data:[0,10,5,2,30],
                                data:data3,
                            },{
                                label:"All Employee Overall Performances",
                                backgroundColor:'rgba(0,200,132,0.1)',
                                borderColor:'rgb(255,99,139)',
                                //data:[0,10,5,2,30],
                                data:data5,
                            }]
                        },
                        options: {}
                      }); 
                    </script>

                <?php }?>
            </div>
        </div>
    </div>
</div>
    </div>
</div>
<!--<div class="fot">-->
<!--    --><?php //$this->view('includes/footer')?>
<!--</div>-->
</body>
</html>
