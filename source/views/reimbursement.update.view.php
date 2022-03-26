<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport"content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?=CSS_PATH?>reimbursement.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>header1.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>profile1.css">
	<script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<title>Update Reimbursment Details</title>
	
</head>
<body class="update-body">

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
    <div class="content">
        <?php
        $this->view('includes/header2');
        ?>
        <div class="reimbursement_container">
<div class="reimbursement_details">
<div class="back_btn1">
                    <a href="<?= PATH ?>Reimbursement"><i class="large material-icons">arrow_back</i></a>
                </div>
            <fieldset class="feildset-1">
                <legend>UPDATE REIMBURSEMENT</legend> 
              
	<div class="update_reimbursement">
	<form name="myform" action="#" method="post"  onsubmit=" return validation()" enctype="multipart/form-data">
			<?php
                if(boolval($arr)){
                    //print_r($arr);
                    // print_r($row['error']);
                }?>		
		

		<div class="row">
			<div class="column_1">
			<label for="c_amount">Claim Amount</label>
			</div>
		<div class="column_2">
			<input type="text" id="claim_amount" name="claim_amount" value="<?php print_r($arr[0]->claim_amount); ?>" required>
		</div>
		</div>
		
		<div class="row">
			<div class="column_1">
			<label for="subject">Pay For</label>
			</div>
		<div class="column_2">
			<textarea id="subject" name="subject" style="height:200px;" required> <?php print_r($arr[0]->reimbursement_reason); ?></textarea>
		</div>
		</div>

		<div class="row">
            <div class="column_1">
                <label for="submission">Invoice Submission</label>
            </div>
            <div id="error_show">

            <div class="invoice_submission1">
                <form2>
                <input class="file-input" type="file" id="invoice_submission" name="invoice_submission" accept=".pdf, .png" multiple required hidden>
				<div class="invoice_name">
				<?php $report=array();
				$report=$arr[0]->invoice_submission;
                // $report_name = $report(2:5);
				// print_r(array_slice($report,30));
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
            </div>
		<!-- </form>	 -->
		
		<a href="<?=PATH?>Reimbursement/updating/<?= $arr->invoice_hashing?>">
        <input type="submit" value="Update" name="submit" id="update-confirmation"></a>

		
		<input class="cancle-confirmation" type="reset" value="Cancel"></a>

		<script type="text/javascript">
			const form = document.querySelector("form2"),
    		fileInput = document.querySelector(".file-input"),
    		progressArea = document.querySelector(".progress-area");

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
    		let progressHTML = `<span class="name" style="color: black; font-size:15px; margin-right:80px;font-weight:normal;margin-left:0;">${name}</span>`;
    		progressArea.innerHTML = progressHTML;
    		let data = new FormData(form);
    		xhr.send(data);
		}
        </script>	
	</form>
	</fieldset>

	</div>
	</div>
	</div>
</div>
<script type="text/javascript">
	function validation() {
    var p = document.forms["myform"]["claim_amount"].value;
    var decimal = /^[+]?[0-9]+\.[0-9]+$/;
    if (p.match(decimal)) {
        var f1 = reason_validation();
        var f2 = true
        if (f1 && f2) {
            return true;
        } else {
            return false;
        }
    } else {
        alert('Please enter valid numeric value')
            // Swal.fire('Please enter valid numeric value')
        reason_validation();
        return false;
    }
}

function reason_validation() {
    var m = document.forms["myform"]["subject"].value;
    if (isNaN(m)) {
        // document.getElementById("validText").innerHTML = "Reason: " + m;
        return true;
    } else {
        alert("Please enter a valid reason");
        return false;
    }
}



</script>   		
	<!-- <script src="public/js/reimbursement.js"></script> -->
     
</body>
</html>