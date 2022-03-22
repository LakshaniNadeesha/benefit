<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_PATH ?>approve.css">
    <title>Approve Reimbursement</title>
</head>

<body>
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
                
                    // if ($requested >= 1) {
                //            for ($j = 0; $j < sizeof($requested[$i]); $j++) { ?>
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
                                <button class="show_btn" type="button" name="show" value="show" id="<?php echo $btnChange ?>" onclick="reply_click(this.id)">Show</button>
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
            <div class="history_table">
                <?php
                if(boolval($requested_approve)){
                ?>
                <table id="claim_history_table">
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    for ($i = 0;$i < sizeof($requested_approve);$i++) {
                    ?>
                    <tr>
                        <td><?php print_r($requested_approve[$i]['details']->claim_date)?></td>
                        <td><?php print_r($requested_approve[$i]['first_name']); echo "  "; print_r($requested_approve[$i]['last_name']);?></td>
                        <td><?php print_r($requested_approve[$i]['details']->reimbursement_reason)?></td>
                        <td><?php print_r($requested_approve[$i]['details']->claim_amount)?></td>
                        <td><?php print_r($requested_approve[$i]['details']->reimbursement_status)?></td>


                    </tr>
                    <?php
                    }
                    ?>
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
                okText: 'Accept',
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
        </div>
        <div class="confirm__buttons">
            <button class="confirm__button confirm__button--ok confirm__button--fill">${options.okText}</button>
            <button class="confirm__button confirm__button--cancel">${options.rejectText}</button>

</div>
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
