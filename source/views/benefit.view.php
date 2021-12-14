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
                            if(boolval($all_details)){
                                if(boolval($remaining)){
                                    for($i=0;$i<sizeof($all_details);$i++){?>
                                    <div class="benefit_card_column">
                                        <a href="<?= PATH ?>BenefitrequestController/<?php print_r($all_details[$i]->benefit_type) ?>">
                                        <div class="card">
                                            <p class="title"><?php print_r($all_details[$i]->benefit_type); ?></p>
                                            <div class="text">Remaining Amount</div>
                                            <div class="remain_amount"><?php print_r($remaining[$i]->remaining_amount); ?> LKR</div>
                                            <div class="text">Max Amount</div>
                                            <div class="max_amount"><?php print_r($all_details[$i]->max_amount); ?> LKR</div>
                                            <div class="text">Renew Date</div>
                                            <div class="text"><?php print_r($remaining[$i]->renew_date); ?></div>
                                            <div>
                                                <button type="button" value="claim" onclick="selection();">Claim</button>
                                            </div>
                                            <script type="text/javascript">
                                                function selection(){

                                                }
                                            </script>
                                        </div>
                                        </a>
                                    </div>
                                    <?php
                                    }
                                }
                            }?>
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
                    if (isset($pending)) {
                        for ($i = 0; $i < sizeof($pending); $i++) {
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
                        <?php }
                    }
                }
                ?>

                <?php
                if(boolval($all_details)){?>
                <div class="benefit_type">
                    <form action="">
                        <select id="benefit_type" name="benefit">
                            <option></option>
                            <?php
                            for($i=0;$i<sizeof($all_details);$i++){?>
                            <option value="medical"><?php print_r($all_details[$i]->benefit_type); ?></option>
                            <?php
                            }?>
                        </select>
                        <a href="#"><i class="fa fa-search"></i></a>
                    </form>
                </div>
                <?php
                }?>
                <?php
                if(boolval($handled)){?>
                <div class="history_table">
                <table id="benefit_history_result">
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Amount(LKR)</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    for($i=0;$i<sizeof($handled);$i++){
                    ?>
                    <tr>
                        <td><?php print_r($handled[$i]->claim_date); ?> </td>
                        <td><?php print_r($handled[$i]->benefit_type); ?> </td>
                        <td><?php print_r($handled[$i]->benefit_description); ?> </td>
                        <td><?php print_r($handled[$i]->claim_amount); ?> </td>
                        <td><?php print_r($handled[$i]->benefit_status); ?> </td>
                    </tr>
                <?php
                    }
                }
                else{
                    echo "No Request Done Yet";
                }
                ?>
                </table>
                </div>

            </div>

        </div>
    </div>
</div>

</body>
</html>

