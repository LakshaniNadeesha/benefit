<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_PATH ?>approve.css">
    <title>Approve Benefit</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#accepted").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#accepted_table tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        $(document).ready(function () {
            $("#rejected").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#rejected_table tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        function validate_amount(e) {
                var t = e.value;
                e.value = (t.indexOf(".") >= 0) ? (t.substr(0, t.indexOf(".")) + t.substr(t.indexOf("."), 3)) : t;
        }

        function number_validation() {
            var n = document.forms["myform"]["claim_amount"].value;

            var decimal = /^[+]?[0-9]+\.[0-9]{2}$/;
            if (!n.match(decimal)) {
                document.getElementById("numberText").innerHTML = "<div style='font-family: Arial,serif; font-size: smaller; color: red'><i class='fas fa-exclamation' style='color: red;'></i> Please enter Numeric value</div>";
                return false;
            }
        }

    </script>
</head>

<body>
<div>
    <?php
    $this->view('includes/header1');
    ?>
</div>

<div class="page_content">
    <?php
    $this->view('includes/hrmanagernavbar');
    //    $this->view('includes/hrnav');
    ?>

    <div class="main_container">
        <div class="approve-container">
            <div>
                <p class="handling_title">Pending List</p>
            </div>
            <hr>
            <div class="card-container">
                <?php

                if (boolval($requested)) {
                    for ($i = 0; $i < sizeof($requested); $i++) {
                        if ($requested >= 1) {
                            //            for ($j = 0; $j < sizeof($requested[$i]); $j++) { ?>
                            <div class='header-approve' id='btn'>
                                <center>
                                    <img src="<?php echo $requested[$i]['profile_image']; ?>" alt='Profile Image'
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
                                <div style="margin-bottom: 15px">
                                    <p class='date'>
                                        <?php
                                        print_r($requested[$i]['details']->benefit_type); ?>
                                    </p>
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
                                    <button class="show_btn" type="button" name="show" value="show"
                                            id="<?php echo $btnChange ?>" onclick="reply_click(this.id)">Show
                                    </button>
                                </center>
                                <script type="text/javascript">
                                    document.querySelector('<?php echo "#".$btnChange; ?>').addEventListener('click',()=>{
                                        Change.open({
                                            title: 'Benefit Request',
                                            type: '<?php print_r($requested[$i]['details']->benefit_type); ?>',
                                            amount: '<?php print_r($requested[$i]['details']->claim_amount); ?>',
                                            date: '<?php print_r($requested[$i]['details']->claim_date); ?>',
                                            description: '<?php print_r($requested[$i]['details']->benefit_description); ?>',
                                            document: '<?php print_r($requested[$i]['details']->report_location); ?>',
                                            application: '<?php print_r($requested[$i]['details']->application_number); ?>'                                        })
                                    });
                                </script>


                            </div>
                            <?php
                        }
                    }
                } else {
                    echo "<div style='padding-left: 10px'>No requests yet</div>";
                } ?>

            </div>

        </div>
        <div class="approve-container">
            <div>
                <p class="handling_title">Benefit History</p>
            </div>
            <hr>
            <div class="accept_title">Approved List</div>
            <div class="search_bar">
                <input class="benefit_search" type="text" id="accepted">
                <i class="fa fa-search"></i>
            </div>
            <div class="history_table" style="margin-bottom: 10px">

                <?php
                if (boolval($accepted)) { ?>
                    <table id="claim_history_table">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Benefit Type</th>
                            <th>Description</th>
                            <th>Amount(LKR)</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody id="accepted_table">
                        <?php
                        for ($i = 0; $i < sizeof($accepted); $i++) { ?>
                            <tr>
                                <td><?php print_r($accepted[$i]['benefit_details']->claim_date); ?></td>
                                <td><?php print_r($accepted[$i]['emp_details'][0]->first_name);
                                    echo ' ';
                                    print_r($accepted[$i]['emp_details'][0]->last_name); ?></td>
                                <td><?php print_r($accepted[$i]['benefit_details']->benefit_type); ?></td>
                                <td><?php print_r($accepted[$i]['benefit_details']->benefit_description); ?></td>
                                <td><?php print_r($accepted[$i]['benefit_details']->claim_amount); ?></td>
                                <td class="status"><?php print_r($accepted[$i]['benefit_details']->benefit_status); ?></td>
                            </tr>
                            <?php
                        } ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    echo "<div style='padding-left: 10px'>No history yet</div>";
                } ?>
            </div>
            <div class="accept_title">Rejected List</div>
            <div class="search_bar">
                <input class="benefit_search" type="text" id="rejected">
                <i class="fa fa-search"></i>
            </div>
            <div class="history_table">

                <?php
                if (boolval($rejected)) { ?>
                    <table id="claim_history_table">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Benefit Type</th>
                            <th>Description</th>
                            <th>Amount(LKR)</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody id="rejected_table">
                        <?php
                        for ($i = 0; $i < sizeof($rejected); $i++) { ?>
                            <tr>
                                <td><?php print_r($rejected[$i]['benefit_details']->claim_date); ?></td>
                                <td><?php print_r($rejected[$i]['emp_details'][0]->first_name);
                                    echo ' ';
                                    print_r($rejected[$i]['emp_details'][0]->last_name); ?></td>
                                <td><?php print_r($rejected[$i]['benefit_details']->benefit_type); ?></td>
                                <td><?php print_r($rejected[$i]['benefit_details']->benefit_description); ?></td>
                                <td><?php print_r($rejected[$i]['benefit_details']->claim_amount); ?></td>
                                <td class="status"><?php print_r($rejected[$i]['benefit_details']->benefit_status); ?></td>
                            </tr>
                            <?php
                        } ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    echo "<div style='padding-left: 10px'>No history yet</div>";
                } ?>
            </div>
        </div>
    </div>

</div>

<script>
    //Add button
    const  Change = {
        open(options){
            options = Object.assign({},{
                title: '',
                type: '',
                amount: '',
                date: '',
                description: '',
                document: '',
                application: '',
                cancelText: 'Reject',
                oncancel: function () {}
            }, options);


            const html = `<div class="confirm">
    <div class="confirm__window">
        <div class="confirm__titlebar">
            <span class="confirm__title">${options.title}</span>
            <button class="confirm__close">&times;</button>
        </div>
        <div class="confirm__content">
            <div class="benefit_head" id="myForm">

                <div class="benefit_form">

                    <form name="myForm" action="" method="post" autocomplete="off" onsubmit=" return number_validation(); " enctype="multipart/form-data">

                        <input type="text" name="application_number" value="${options.application}" hidden>

                        <div class="benefit_row_1">
                            <div class="benefit_column_1">
                                <label for="benefit_type">Benefit Type</label>
                            </div>
                            <div class="benefit_column_2">
                                <input class="benefit_type" type="text" id="benefit_type" name="benefit_type" value="${options.type}" readonly>
                            </div>
                        </div>
                        <div class="benefit_row_1">
                            <div class="benefit_column_1">
                                <label for="benefit_type">Claimed Date</label>
                            </div>
                            <div class="benefit_column_2">
                                <input class="claimed_date" type="text" id="claimed_date" name="claimed_date" value="${options.date}" readonly>
                            </div>
                        </div>
                        <div class="benefit_row_1">
                            <div class="benefit_column_1">
                                <label for="claim_amount">Amount (LKR)</label>
                            </div>
                            <div class="benefit_column_2">
                                <input class="claim_amount" type="text" id="claim_amount" name="claim_amount" value="${options.amount}" readonly>
                            </div>
                        </div>
                        <div class="benefit_row_1">
                            <div class="benefit_column_1">
                                <p>Report Submission</p>
                            </div>
                            <div class="benefit_column_2">
                                <button class="btn" onclick="document.getElementById('link-1').click()"><i class="fa fa-download"></i>Download</button>
                                <a id="link-1" href="${options.document}" download hidden></a>
                            </div>
                        </div>
                        <div class="benefit_row_1">
                            <div class="benefit_column_1">
                                <label for="accepting_amount">Accepting Amount (LKR)</label>
                            </div>
                            <div class="benefit_column_2">
                                <input type="text" name="accepting_amount" value="${options.amount}" pattern="[0-9._%+-]+\.[0-9]{2}$" min="0" required oninput="validate_amount(this)">
                            </div>
                        </div>
                        <div class="benefit_row_1">
                            <div class="benefit_column_1">
                                <label for="reason">Note (If any)</label>
                            </div>
                            <div class="benefit_column_2">
                                <input type="text" name="reason">
                            </div>
                        </div>
                        <div class="confirm__buttons">
                            <button class="confirm__button confirm__button--ok confirm__button--fill" type="submit" value="Accept" name="submit">Accept</button>
                            <button class="confirm__button confirm__button--cancel" type="submit" value="Reject" name="reject">${options.cancelText}</button>
                        </div>
                    </form>

        </div>
        </div>

    </div>
</div>`;

            const template_1 = document.createElement('template');
            template_1.innerHTML = html;

            const confirmEl = template_1.content.querySelector('.confirm');
            const btnClose = template_1.content.querySelector('.confirm__close');
            const btnCancel = template_1.content.querySelector('.confirm__button--cancel');

            confirmEl.addEventListener('click', e => {
                if(e.target === confirmEl){
                    options.oncancel();
                    this._close(confirmEl);
                }
            });

            [btnCancel, btnClose].forEach(el => {
                el.addEventListener('click', () => {
                    options.oncancel();
                    this._close(confirmEl);
                });
            });

            document.body.appendChild(template_1.content);
        },

        _close (confirmEl){
            confirmEl.classList.add('confirm--close');
            confirmEl.addEventListener('animationend', () => {
                document.body.removeChild(confirmEl);
            });
        }
    }

</script>

<script>

    function addBox() {
        var temp = document.getElementById("temp").content;
        document.getElementById("btn").appendChild(temp);
    }

    document.getElementById("btn").addEventListener("click", addBox);

</script>



</body>
</html>
