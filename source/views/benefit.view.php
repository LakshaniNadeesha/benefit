<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_PATH ?>benefits.css">
    <link href="assets/css/feather.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <title>Benefits</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</head>
<body>
<div>
    <?php
    $this->view('includes/header1')
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
        $this->view('includes/header2')
        ?>
        <div class="benefit_container">
            <div class="benefit_head">
                <p class="main_title">Benefits</p>
                <hr>
                <div>

                    <form action="BenefitrequestController">
                            <div class="benefit_card">
                                <?php

                                if (boolval($show)) {
                                    for ($i = 0; $i < sizeof($show); $i++) {
                                        ?>
                                        <div class="benefit_card_column">
                                            <a href="<?= PATH ?>BenefitrequestController/<?php print_r($show[$i]->benefit_type) ?>">
                                                <div class="card">
                                                    <p class="title"><?php print_r($show[$i]->benefit_type); ?></p>
                                                    <div class="text">Remaining Amount</div>
                                                    <div class="remain_amount"><?php print_r($show[$i]->remaining_amount); ?>
                                                        LKR
                                                    </div>
                                                    <div class="text">Max Amount</div>
                                                    <div class="max_amount"><?php print_r($show[$i]->max_amount); ?>
                                                        LKR
                                                    </div>
                                                    <div class="text">Renew Date</div>
                                                    <div class="text"><?php print_r($show[$i]->renew_date); ?></div>
                                                    <div>
                                                        <button type="button" value="claim" onclick="selection();">
                                                            Claim
                                                        </button>
                                                    </div>
                                                    <script type="text/javascript">
                                                        function selection() {

                                                        }
                                                    </script>
                                                </div>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                } ?>
                            </div>
                    </form>
                </div>

            </div>


            <div class="benefit_history">
                <div class="history_header">
                    <i class="fa fa-history" aria-hidden="true"></i>
                    <p class="main_title">Benefit History</p>
                </div>
                <hr>

                <?php
                if (boolval($pending)) {
                    if (isset($pending)) { ?>
                        <div class="pending_section">
                        <?php for ($i = 0; $i < sizeof($pending); $i++) {
                            $row = $pending[$i]; ?>
                            <div class='pending_benefits'>
                                <div><?php print_r($row->benefit_type); ?> </div>
                                <div><?php print_r($row->claim_date); ?></div>
                                <div><i>Pending</i></div>

                                <a href="<?= PATH ?>Benefit/cancel/<?= $row->report_hashing ?>">
                                    <button type='submit' value='Decline' name="delete" class='delete_button'><i class="fa fa-trash"></i> Delete
                                    </button>
                                </a>
                            </div>
                        <?php } ?>
                        </div>
                    <?php }
                }
                ?>
                <?php
                if(boolval($handled)){?>
                <input class="benefit_search" type="text" id="myInput">
                <i class="fa fa-search"></i>
                <div class="history_table">
                    <table id="benefit_history_result">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Claimed Amount(LKR)</th>
                        <th>Accepted Amount(LKR)</th>
                        <th>Status</th>
                        <th>Notes (If any)</th>
                    </tr>
                    </thead>
                    <tbody id="myTable">
                    <?php
                    for($i=0;$i<sizeof($handled);$i++){
                    ?>
                    <tr>
                        <td><?php print_r($handled[$i]->claim_date); ?> </td>
                        <td><?php print_r($handled[$i]->benefit_type); ?> </td>
                        <td><?php print_r($handled[$i]->benefit_description); ?> </td>
                        <td><?php print_r($handled[$i]->claim_amount); ?> </td>
                        <td><?php print_r($handled[$i]->accepted_amount); ?></td>
                        <td><?php print_r($handled[$i]->benefit_status); ?> </td>
                        <td style="text-transform: capitalize"><?php
                            if($handled[$i]->handling_reason){
                                print_r($handled[$i]->handling_reason);
                            } else {
                                echo "-";
                            }
                            ?> </td>
                    </tr>
                <?php
                    }
                }
                else{
                    echo "No Request Done Yet";
                }
                ?>
                    </tbody>
                </table>
                </div>

            </div>

        </div>
    </div>
</div>

</body>
</html>

