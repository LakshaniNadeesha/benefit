<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>updatedocuments.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>benefits.css">
    <title></title>
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
//        $this->view('includes/hrofficernav');
        $this->view('includes/hrofficernavbar');
        ?>
    <?php endif; ?>

    <div class="main_container">
    <div class="benefit_head">
    <fieldset>
                <legend><div>UPDATE DOCUMENTS</div></legend>
               
                <form name="myform" action="#" method="POST" onsubmit=" return validation()" enctype="multipart/form-data">

                <div class="row">
                        <div class="column_1">
                            <label for="d_name">Document Name</label>
                        </div>
                        <div class="column_2">
                            <input type="text" id="d_name" name="d_name" value="<?php print_r($arr[0]->document_name); ?>" required>
                        </div>
                </div>

                <div class="row">
                        <div class="column_1">
                            <label for="updated_date">Updated Date</label>
                        </div>
                        <div class="column_2">
                            <input type="date" id="updated_date" value="<?php echo date('Y-m-d') ?>"name="updated_date" readonly>
                        </div>
                </div>

                <div class="row">
                        <div class="column_1">
                            <label for="submission">Invoice Submission</label>
                        </div>
                        <!-- <div id="error_show"> -->

                        <div class="invoice_submission">
                            <form2>
                           <input class="file-input" type="file" id="document" name="document" accept=".docx" multiple required hidden>
                           <div class="invoice_name">
				           <?php $report=array();
				           $report=$arr[0]->document_path;
                           print_r($report); 
				           ?>
				</div>
                           <i class="fas fa-cloud-upload-alt"></i>
                           <p>Browse File to Upload</p>
                            </form2>
                            <div>
                            <section class="progress-area"></section>
                          
                        </div>
                        </div>
                        
                        <div id="error-mzg">
                        <?php
                        if (boolval($errors)) {
                        print_r($errors);?>
                        <?php
                        }
                        ?>
                        </div>
                        </div>  
                        <div class="d_button">
                    <a href="<?= PATH ?>Hrdocuments/updatedocuments">
                        <input type="submit" value="Update" name="submit"></a>
                        <a href="<?= PATH ?>Hrdocuments/updatedocuments">
                            <input class="cancle_button" type="button" value="Cancel"></a>

                    </div>                 
                </div>

                   

                </form>

    </fieldset>
    </div> 
</div>
</div>

<!-- <script src="public/js/hrdocuments.js"></script> -->
<script>
function validation() {
    var m = document.forms["myform"]["d_name"].value;
    if (isNaN(m)) {
        // document.getElementById("validText").innerHTML = "Reason: " + m;
        return true;
    } else {
        alert("Please enter a valid docuemnt name");
        return false;
    }
}


const form = document.querySelector("form2"),
    fileInput = document.querySelector(".file-input"),
    progressArea = document.querySelector(".progress-area");
// uploadedArea = document.querySelector(".uploaded-area");

form.addEventListener("click", () => {
    fileInput.click();
});

fileInput.onchange = ({ target }) => {
    let file = target.files[0];
    if (file) {
        let fileName = file.name;
        if (fileName.length >= 15) {
            let splitName = fileName.split('.');
            fileName = splitName[0].substring(0, 15) + "... ." + splitName[1];
        } else {
            fileName = file.name;
        }
        uploadFile(fileName);
    }
}

function uploadFile(name) {
    let progressHTML = `<span class="name" style="color: black; font-size:15px; margin-right:10px;font-weight:normal;margin-left:0;">${name}</span>`;
    progressArea.innerHTML = progressHTML;
    let data = new FormData(form);
    xhr.send(data);
}

</script>

</body>

</html>