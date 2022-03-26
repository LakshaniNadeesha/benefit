<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_PATH ?>approvereimbursement.css">
    <title>Approve Reimbursement</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#reimbursement").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#reimbursement_table tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        $(document).ready(function () {
            $("#reimbursement1").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#reimbursement_table1 tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</head>

<body>
<script type="text/javascript">
	function validation() {
    var p = document.forms["myform"]["accepted_amount"].value;
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
        reason_validation();
        return false;
    }
}

function reason_validation() {
    var m = document.forms["myform"]["rejected_reason"].value;
    if (isNaN(m)) {
        return true;
    } else {
        alert("Please enter a valid reason");
        return false;
    }
}
</script>
<div>
    <?php
    $this->view('includes/header1');
    ?>
</div>
<div class="page_content">

    <?php
        $this->view('includes/parentemployeenavbar');
//    $this->view('includes/supervisornav');
    ?>

    <div class="main_container">
        <div class="approve-container">
            <div>
                <p class="handling_title">To Be Handle</p>
            </div>
            <hr>
            <div class="card-container">
            <?php
            if(boolval($requested)){
                // print_r(sizeof($requested));
                for ($i = 0;$i < sizeof($requested);$i++) {
                  
                
      ?>
                        <div class='header-approve' id='btn'>
                            <center>
                                <img src="<?php echo $requested[$i]['profile_image'];?>" alt='Profile Image'
                                     class='profile__image'>
                            </center>
                            <p class='name'>
                                <?php
                                print_r($requested[$i]['first_name']); ?>
                            </p>
                            <p class="name">
                                <?php
                                echo " ";
                                print_r($requested[$i]['last_name']);
                                ?>
                            </p>
                            <div>
                                <p class='date'>
                                    <?php
                                    print_r($requested[$i]['details']->claim_date); ?>
                                </p>
                            </div>
                            <?php
                                $btnChange = 'btnChange';
                                $btnChange .= $i;
                                //echo $btnChange;
                            ?>
                            <center>
                                <button class="show_btn" type="button" name="show" value="show" id="<?php echo $btnChange ?>" 
                                onclick="reply_click(this.id)">Show</button>
                                <!-- <a href="<?= PATH ?>Approvereimbursement/accept_reject/<?//= $requested[$i]['details']->invoice_hashing?>">
                                <input class="show_btn" type="button" value="Show"></a> -->
                            </center>
                            <script type="text/javascript">
                                    <?php
                                    $string = $requested[$i]['details']->invoice_submission;
                                    $newString = substr($string,31);

                                    ?>

                                document.querySelector('<?php echo "#".$btnChange;?>').addEventListener('click', () => {
                                    Confirm.open({
                                        title: 'Request From <?php print_r($requested[$i]['first_name']); echo " "; print_r($requested[$i]['last_name']); ?>',
                                        ClaimedDate : '<?php print_r($requested[$i]['details']->claim_date); echo "<br>";?>',
                                        ClaimedAmount : '<?php print_r($requested[$i]['details']->claim_amount); echo "<br>";?>',
                                        Description : '<?php print_r($requested[$i]['details']->reimbursement_reason); echo "<br>";?>',
                                        document: '<?php print_r($newString); echo "<br>";?>',
                                        link: '<?php print_r($requested[$i]['details']->invoice_submission) ?>',
                                        onok: () => {
                                            window.location.href = "Approvereimbursement/accept/<?php print_r($requested[$i]['details']->invoice_hashing); ?>"
                                        },
                                        onreject: () => {
                                            window.location.href = "Approvereimbursement/reject/<?php print_r($requested[$i]['details']->invoice_hashing); ?>"
                                        }

                                    })
                                });
                            </script>
                        </div>
                        <?php
                    }

                } 
            // }
            ?>

            </div>
        </div>
        <div class="approve-container">
            <div>
                <p class="handling_title">Reimbursement History</p>
            </div>
            <hr>
            
            <div class="name_tab">
                <p><i class="fa fa-check"></i>  Accepted Reimbursements</p>
                </div>
                <div class="search_bar">
                <input class="reimbursement_search" type="text" id="reimbursement">
                <i class="fa fa-search"></i>
            </div>
            <div class="history_table">
                <?php
                if(boolval($requested_approve)){
                ?>
                <table id="claim_history_table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Amount (LKR)</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody id="reimbursement_table">
                    <?php
                    for ($i = 0;$i < sizeof($requested_approve);$i++) {
                        if($requested_approve[$i]['details']->reimbursement_status == "accepted"){
                    ?>
                    <tr>
                        <td><?php print_r($requested_approve[$i]['details']->claim_date)?></td>
                        <td><?php print_r($requested_approve[$i]['first_name']); echo "  "; print_r($requested_approve[$i]['last_name']);?></td>
                        <td style="text-transform: capitalize;"><?php print_r($requested_approve[$i]['details']->reimbursement_reason)?></td>
                        <td><?php print_r($requested_approve[$i]['details']->claim_amount)?></td>
                        <td style="text-transform: capitalize"><?php print_r($requested_approve[$i]['details']->reimbursement_status)?></td>


                    </tr>
                    <?php
                    }
                }
                    ?>
                    </tbody>
                </table>
                <?php
                }
                else{
                    echo "<div style='padding-left: 10px'>No history yet</div>";
                }
                ?>
            </div>

<!-- rejected_table -->
                <div class="name_tab">
                <p><i class="fa fa-times"></i>  Rejected Reimbursements</p>
                </div>
                <div class="search_bar">
                    <input class="reimbursement_search" type="text" id="reimbursement1">
                    <i class="fa fa-search"></i>
                </div>
            <div class="history_table1">
                <?php
                if(boolval($requested_approve)){
                ?>
                <table id="claim_history_table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Amount (LKR)</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody id="reimbursement_table1">
                    <?php
                    for ($i = 0;$i < sizeof($requested_approve);$i++) {
                        if($requested_approve[$i]['details']->reimbursement_status == "rejected"){
                    ?>
                    <tr>
                        <td><?php print_r($requested_approve[$i]['details']->claim_date)?></td>
                        <td><?php print_r($requested_approve[$i]['first_name']); echo "  "; print_r($requested_approve[$i]['last_name']);?></td>
                        <td style="text-transform: capitalize;"><?php print_r($requested_approve[$i]['details']->reimbursement_reason)?></td>
                        <td><?php print_r($requested_approve[$i]['details']->claim_amount)?></td>
                        <td style="text-transform: capitalize"><?php print_r($requested_approve[$i]['details']->reimbursement_status)?></td>


                    </tr>
                    <?php
                    }
                }
                    ?>
                    </tbody>
                </table>
                <?php
                }
                else{
                    echo "<div style='padding-left: 10px'>No history yet</div>";
                }
                ?>
            </div>
        </div>

    </div>
</div>

<script>

    function addBox() {
        var temp = document.getElementById("temp").content;
        document.getElementById("btn").appendChild(temp);
    }

    document.getElementById("btn").addEventListener("click", addBox);

</script>

<script>
    const  Confirm = {
        open(options){
            options = Object.assign({},{
                title: '',
                ClaimedDate: '',
                ClaimedAmount: '',
                Description: '',
                document: '',
                link: '',
                // okText: 'Accept',
                rejectText: 'Reject',
                onok: function () {},
                oncancel: function () {},
                onreject: function () {}
            }, options);


            const html = `<div class="confirm">
    <div class="confirm__window">
        <div class="confirm__titlebar">
            <span class="confirm__title">${options.title}</span>
            <button class="confirm__close">&times;</button>
        </div>
        <div class="confirm__content">
        <form name="myForm" action="" method="post" onsubmit="return validation();" enctype="multipart/form-data">
            <div class="row">
                <div class="column_1">
                    <p>Claimed Date</p>
                </div>
                <div class="column_2">
                    <p>${options.ClaimedDate}</p>
                </div>
            </div>
            <div class="row">
                <div class="column_1">
                    <p>Claimed Amount</p>
                </div>
                <div class="column_2">
                    <p>${options.ClaimedAmount}</p>
                </div>
            </div>
            <div class="row">
                <div class="column_1">
                    <p>Reason</p>
                </div>
                <div class="column_2">
                    <p>${options.Description}</p>
                </div>
            </div>
            <div class="row">
                <div class="column_1">
                    <p>Report Submission</p>
                </div>
                <div class="column_2">
                    <p>${options.document}</p>
                    <button class="btn" onclick="document.getElementById('link-1').click()"><i class="fa fa-download"></i>      Download</button>
                    <a id="link-1" href="${options.link}" download hidden></a>
                </div>
            </div>
            <div class="row">
                <div class="column_1">
                    <p>Accepted Amount</p>
                </div>
                <div class="column_2">
                    <input type="text" id="accepted_amount" name="accepted_amount">
                </div>
            </div>
            <div class="row">
                <div class="column_1">
                    <p>Rejected Reason (If Any)</p>
                </div>
                <div class="column_2">
                    <input type="text" id="rejected_reason" name="rejected_reason">
                </div>
            </div>
        </div>      
        <div class="confirm__buttons">
            <button class="confirm__button confirm__button--ok confirm__button--fill" type="submit" name="submit">Accept</button>
            <button class="confirm__button confirm__button--cancel">${options.rejectText}</button>
</div>
</form>
    </div>
</div>`;

            const template = document.createElement('template');
            template.innerHTML = html;

            const confirmEl = template.content.querySelector('.confirm');
            const btnReject = template.content.querySelector('.confirm__button--cancel');
            const btnClose = template.content.querySelector('.confirm__close');
            const btnOk = template.content.querySelector('.confirm__button--ok');

            confirmEl.addEventListener('click', e => {
                if(e.target === confirmEl){
                    options.oncancel();
                    this._close(confirmEl);
                }
            });

            btnReject.addEventListener('click', e => {
                options.onreject();
                this._close(confirmEl);
            });


            btnOk.addEventListener('click', () => {
                options.onok();
                this._close(confirmEl);
            });

            [btnClose].forEach(el => {
                el.addEventListener('click', () => {
                    options.oncancel();
                    this._close(confirmEl);
                });
            });

            document.body.appendChild(template.content);
        },

        _close (confirmEl){
            confirmEl.classList.add('confirm--close');
            confirmEl.addEventListener('animationend', () => {
                document.body.removeChild(confirmEl);
            });
        }
    }
</script>
<!--<div>-->
<!--    --><?php //$this->view('includes/footer') ?>
<!--</div>-->
</body>

</html>