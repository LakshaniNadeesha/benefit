<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>hrdocuments.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>updatedocuments.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>benefits.css">

    <title></title>
</head>

<body>
    <div class="hrdocuments_container">
    <div>
   <?php $this->view('includes/header1')?>
</div>

        <!-- <h1 class="h1">HR Documents</h1> -->

        <div class="main_container">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 50 1440 185"><path fill="#0f9eb8" fill-opacity="1" d="M0,64L26.7,58.7C53.3,
        53,107,43,160,80C213.3,117,267,203,320,218.7C373.3,235,427,181,480,181.3C533.3,181,587,235,640,229.3C693.3,224,747,160,800,
        128C853.3,96,907,96,960,112C1013.3,128,1067,160,1120,176C1173.3,192,1227,192,1280,170.7C1333.3,149,1387,107,1413,85.3L1440,
        64L1440,0L1413.3,0C1386.7,0,1333,0,1280,0C1226.7,0,1173,0,1120,0C1066.7,0,1013,0,960,0C906.7,0,853,0,800,0C746.7,0,693,0,640,
        0C586.7,0,533,0,480,0C426.7,0,373,0,320,0C266.7,0,213,0,160,0C106.7,0,53,0,27,0L0,0Z"></path></svg>
        <div class="document_list">
            <table>
                <tr>
                    <th>Document Name</th>
                    <th>Option</th>

                </tr>

                <?php
                    $i = 0;

                    if (boolval($row)) {

                        for ($i = 0; $i < sizeof($row); $i++) {

                            $vai = $row[$i]; 
                            ?>
                                <tr>
                                    <td><?php print_r($vai->document_name); ?></td>
                                    <td>  <button class="btn" onclick="document.getElementById('link<?php print_r($i)?>').click()"><i class="fa fa-download"></i>      Download</button>
                                    <?php $doc = $vai->document_name; ?>
                                    <a id="link<?php print_r($i)?>" href="<?= DOC_PATH ?><?php print_r($doc)?>.docx" download hidden></a></td>
                                </tr>

                            <?php 
                        }
                    } ?>
            </table>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 50 1440 140"><path fill="#0f9eb8" fill-opacity="1" d="M0,160L48,144C96,128,192,96,288,80C384,
            64,480,64,576,96C672,128,768,192,864,192C960,192,1056,128,1152,90.7C1248,53,1344,43,1392,37.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,
            320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
</div>

        <!-- <div class="row">
            <div class="column">
                <div class="card">
                    <h4>Employee Application Form</h4>
                    <img src="<?= IMG_PATH?>hrdocuments/emp_application_form.png" alt="" style="width:100%">
                    <button class="btn" onclick="document.getElementById('link-1').click()"><i class="fa fa-download"></i>      Download</button>
                    <a id="link-1" href="<?= DOC_PATH ?>employment-application-form.docx" download hidden></a>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <h4>Employee Emergency Contact Form</h4>
                    <img src="<?= IMG_PATH?>hrdocuments/emp_emergency_form.png" alt="" style="width:100%">
                    <button class="btn" onclick="document.getElementById('link-2').click()"><i class="fa fa-download"></i>      Download</button>
                    <a id="link-2" href="<?= DOC_PATH ?>employee-emergency-form.docx" download hidden></a>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <h4>Disciplinary action form</h4>
                    <img src="<?= IMG_PATH?>hrdocuments/emp_disciplinary_form.png" alt="" style="width:100%">
                    <button class="btn" onclick="document.getElementById('link-3').click()"><i class="fa fa-download"></i>      Download</button>
                    <a id="link-3" href="<?= DOC_PATH ?>disciplinary-action-form.docx" download hidden></a>
                </div>
            </div>                                                                                                                         
        </div> -->

        <!-- <div class="row">
            <div class="column">
                <div class="card">
                    <h4>HR Service Request Form</h4>
                    <img src="<?= IMG_PATH?>hrdocuments/emp_hr_request_form.png" alt="" style="width:100%">                  
                    <button class="btn" onclick="document.getElementById('link-4').click()"><i class="fa fa-download"></i>      Download</button>
                    <a id="link-4" href="<?= DOC_PATH ?>hr-service-request-form.docx" download hidden></a>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <h4>Exit Interview Form</h4>
                    <img src="<?= IMG_PATH?>hrdocuments/emp_exit_interview_form.png" alt="" style="width:100%">                   
                    <button class="btn" onclick="document.getElementById('link-5').click()"><i class="fa fa-download"></i>      Download</button>           
                   <a id="link-5" href="<?= DOC_PATH ?>exit-interview-form.docx" download hidden></a>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <h4>Travel Request Form</h4>
                    <img src="<?= IMG_PATH?>hrdocuments/emp_travel_request_form.png" alt="" style="width:100%">                    
                    <button class="btn" onclick="document.getElementById('link-6').click()"><i class="fa fa-download"></i>      Download</button>
                    <a id="link-6" href="<?= DOC_PATH ?>travel-request-form.docx" download hidden></a>
                </div>
            </div>
        </div> -->
       
    </div>
    
    
</body>

</html>