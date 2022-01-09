<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_PATH ?>updatebenefit.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>benefits.css">
    <title>Update Benefit</title>
</head>

<body>
<script type="text/javascript">
    function number_validation() {
        var n = document.forms["myForm"]["claiming_amount"].value;

        var decimal = /^[+]?[0-9]+\.[0-9]{2}$/;
        if (!n.match(decimal)) {
            document.getElementById("numberText").innerHTML = "<div style='font-family: Arial,serif; font-size: smaller; color: red'><i class='fas fa-exclamation' style='color: red;'></i> Please enter Numeric value</div>";
            var r1 = false;
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
    <?php if (Auth::access('HR Manager')): ?>
        <div>
            <?php
            //            $this->view('includes/hrnav');
            $this->view('includes/hrmanagernavbar');
            ?>
        </div>
    <?php endif; ?>

    <?php if (Auth::access('HR Officer')): ?>
        <div>
            <?php
            //            $this->view('includes/hrofficernav');
            $this->view('includes/hrofficernavbar')
            ?>
        </div>
    <?php endif; ?>
    <div class="main_container">
        <div class="benefit_list">
            <div class="title_container">
                <p class="handling_title">Benefits List</p>
                <?php if(Auth::access('HR Manager')): ?>
                <div class="add_benefits" id="add_benefits" onclick="openForm()">
                    <p><i class="fas fa-plus-circle"></i> Add New Benefit</p>
                </div>
                    <script type="text/javascript">

                        document.querySelector('#add_benefits').addEventListener('click', () => {
                            //document.getElementById("this.id").addEventListener('click', () => {
                            Confirm.open({
                                title: 'New Benefit!',
                                // onok: () => {
                                //     window.location.href = "add"
                                // },
                            })
                        });
                    </script>
                <?php endif; ?>
            </div>
            <?php if(boolval($details)){ ?>
                <ul class="responsive-table">
                    <li class="table-header">
                        <div class="col col-1">Code</div>
                        <div class="col col-2">Benefit Type</div>
                        <div class="col col-3">Amount</div>
                        <div class="col col-4">Valid Years</div>
                        <div class="col col-5">Valid Months</div>
                        <div class="col col-6">Visibility</div>
                        <div class="col col-7">Options</div>
                    </li>
                    <?php for($i=0;$i<sizeof($details);$i++){ ?>
                        <li class="table-row">
                            <div class="col col-1" data-label="Benefit Code"><?php print_r($details[$i]->benefit_code); ?></div>
                            <div class="col col-2" data-label="Benefit Type"><?php print_r($details[$i]->benefit_type); ?></div>
                            <div class="col col-3" data-label="Amount"><?php print_r($details[$i]->max_amount); ?></div>
                            <div class="col col-4" data-label="Valid Years"><?php print_r($details[$i]->valid_years); ?></div>
                            <div class="col col-5" data-label="Valid Months"><?php print_r($details[$i]->valid_months); ?></div>
                            <div class="col col-6" data-label="PVisibility"><?php if($details[$i]->visibility == "Yes"){
                                    echo "<i class='fa fa-eye' aria-hidden='true'></i>";
                                } else{
                                    echo "<i class='fa fa-eye-slash' aria-hidden='true'></i>";
                                }?></div>
                            <div class="col col-7" data-label="Options" id="options">
                                <?php
                                $btnChange = 'btnChange';
                                $btnChange .= $i;
                                $btnDelete = 'btnDelete';
                                $btnDelete .= $i;
                                //echo $btnChange;
                                ?>
                                <div class="edit" id="<?php echo $btnChange ?>" onclick="reply_click(this.id)"><i class="fas fa-edit" id="edit"></i></div>
                                <script type="text/javascript">
                                    document.querySelector('<?php echo "#".$btnChange;?>').addEventListener('click', () => {
                                        Change.open({
                                            title: 'Changing..',
                                            code: '<?php print_r($details[$i]->benefit_code) ?>',
                                            type: '<?php print_r($details[$i]->benefit_type) ?>',
                                            amount: '<?php print_r($details[$i]->max_amount) ?>',
                                            months: '<?php print_r($details[$i]->valid_months) ?>',
                                            years: '<?php print_r($details[$i]->valid_years) ?>',
                                            href: '<?php echo"change/"; print_r($details[$i]->benefit_ID); ?>',
                                            onchange: () => {
                                                window.location.href = "<?php print_r($details[$i]->benefit_ID); ?>"
                                            },
                                        })
                                    });
                                </script>
                                <div class="delete" id="<?php echo $btnDelete ?>" onclick="reply_click(this.id)"><i class="fas fa-trash-alt" id="delete"></i></div>
                                <script type="text/javascript">
                                    document.querySelector('<?php echo "#".$btnDelete;?>').addEventListener('click', () => {
                                        Deletion.open({
                                            title: 'Are you sure you want to delete this?',
                                            onok: () => {
                                                window.location.href = "delete/<?php print_r($details[$i]->benefit_ID); ?>"
                                            }
                                        })
                                    });
                                </script>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>

    </div>
    <center>
        <img src="<?= IMG_PATH ?>down.png"  alt="" class="img">
    </center>
</div>
<script>
    //Add button
    const  Confirm = {
        open(options){
            options = Object.assign({},{
                title: '',
                message: '',
                cancelText: 'Cancel',
                oncancel: function () {}
            }, options);


            const html = `<div class="confirm">
    <div class="confirm__window">
        <div class="confirm__titlebar">
            <span class="confirm__title">${options.title}</span>
            <button class="confirm__close">&times;</button>
        </div>
        <div class="confirm__content">${options.message}
            <div class="benefit_head" id="myForm">

                <div class="benefit_form">

                    <form name="myForm" action="" method="post" autocomplete="off" onsubmit=" return number_validation(); " enctype="multipart/form-data">

                        <div class="row">
                            <div class="row_1">
                                <div class="column_1">
                                    <label for="benefit_type">Benefit Type</label>
                                </div>
                                <div class="column_2">
                                    <input type="text" id="benefit_type" name="benefit_type" required >
                                </div>
                            </div>
                            <div class="row_1">
                                <div class="column_1">
                                    <label for="benefit_code">Benefit Code</label>
                                </div>
                                <div class="column_2">
                                    <input type="text" id="benefit_code" name="benefit_code" placeholder="Enter an unique code" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="row_1">
                                <div class="column_1">
                                    <label for="claiming_amount">Amount (LKR)</label>
                                </div>
                                <div class="column_2">
                                    <input type="number" id="max_amount" name="max_amount"
                                           placeholder="20000.00" required pattern="[0-9._%+-]+\.[0-9]{2}$" min="0">
                                </div>
                            </div>
                            <div class="row_1">
                                <div class="column_1">
                                    <label for="valid_months">Valid Months</label>
                                </div>
                                <div class="column_2">
                                    <input type="number" id="valid_months" name="valid_months" required pattern="[0-9]{2}" min="0" max="11">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="row_1">
                                <div class="column_1">
                                    <label for="valid_years">Valid Years</label>
                                </div>
                                <div class="column_2">
                                    <input type="number" id="valid_years" name="valid_years" required pattern="[0-9]{2}" min="0">
                                </div>
                            </div>
                            <div class="row_1">
                                <div class="column_1">
                                    <label for="visibility">Visibility</label>
                                </div>
                                <div class="column_2">
                                    <select name="visibility">
                                        <option>No</option>
                                        <option>Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="confirm__buttons">
                            <button class="confirm__button confirm__button--ok confirm__button--fill" type="submit" value="Add" name="submit">Add</button>
                            <button class="confirm__button confirm__button--cancel" type="reset">${options.cancelText}</button>
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


    //Delete button
    const  Deletion = {
        open(options){
            options = Object.assign({},{
                title: '',
                message: '',
                okText: 'Delete',
                cancelText: 'Cancel',
                onok: function () {},
                oncancel: function () {}
            }, options);


            const delete_html = `<div class="confirm">
    <div class="confirm__window">
        <div class="confirm__titlebar">
            <span class="confirm__title">${options.title}</span>
            <button class="confirm__close">&times;</button>
        </div>

        <div class="confirm__buttons" style="margin-top: 0">
            <button class="confirm__button confirm__button--ok confirm__button--fill" type="submit" value="Delete" name="submit">${options.okText}</button>
            <button class="confirm__button confirm__button--cancel" type="reset">${options.cancelText}</button>

        </div>
    </div>
</div>`;

            const template_2 = document.createElement('template');
            template_2.innerHTML = delete_html;

            const confirmEl = template_2.content.querySelector('.confirm');
            const btnClose = template_2.content.querySelector('.confirm__close');
            const btnOk = template_2.content.querySelector('.confirm__button--ok');
            const btnCancel = template_2.content.querySelector('.confirm__button--cancel');

            confirmEl.addEventListener('click', e => {
                if(e.target === confirmEl){
                    options.oncancel();
                    this._close(confirmEl);
                }
            });

            btnOk.addEventListener('click', () => {
                options.onok();
                this._close(confirmEl);
            });

            [btnCancel, btnClose].forEach(el => {
                el.addEventListener('click', () => {
                    options.oncancel();
                    this._close(confirmEl);
                });
            });

            document.body.appendChild(template_2.content);
        },

        _close (confirmEl){
            confirmEl.classList.add('confirm--close');
            confirmEl.addEventListener('animationend', () => {
                document.body.removeChild(confirmEl);
            });
        }
    }

    //Change button
    const  Change = {
        open(options){
            options = Object.assign({},{
                title: '',
                message: '',
                type: '',
                code: '',
                amount: '',
                months: '',
                years: '',
                href: '',
                cancelText: 'Cancel',
                onchange: function () {},
                oncancel: function () {}
            }, options);


            const change_html = `<div class="confirm">
    <div class="confirm__window">
        <div class="confirm__titlebar">
            <span class="confirm__title">${options.title}</span>
            <button class="confirm__close">&times;</button>
        </div>
        <div class="confirm__content">${options.message}
            <div class="benefit_head" id="myForm">
                <!-- <div class="heading">
                        <h2>CLAIM BENEFIT</h2>
                    </div> -->

                <div class="benefit_form">

                    <form action="" method="post" autocomplete="off">
                        <div class="row">
                            <div class="column_1">
                                <label for="benefit_code">Code</label>
                            </div>
                            <div class="column_2">
                                <input type="text" id="benefit_code" name="benefit_code" value="${options.code}" required readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="column_1">
                                <label for="benefit_type">Benefit Type</label>
                            </div>
                            <div class="column_2">
                                <input type="text" id="benefit_type" name="benefit_type" value="${options.type}" required readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="column_1">
                                <label for="claiming_amount">Maximum Amount (LKR)</label>
                            </div>
                            <div class="column_2">
                                <input type="number" id="max_amount" name="max_amount" value="${options.amount}"
                                       placeholder="200,000.00" required pattern="[0-9._%+-]+\.[0-9]{2}$" min="0">
                            </div>
                        </div>
                        <div class="row">
                            <div class="column_1">
                                <label for="valid_months">Valid Months</label>
                            </div>
                            <div class="column_2">
                                <input type="text" id="valid_months" name="valid_months" value="${options.months}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="column_1">
                                <label for="valid_years">Valid Years</label>
                            </div>
                            <div class="column_2">
                                <input type="text" id="valid_years" name="valid_years" value="${options.years}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="column_1">
                                <label for="visibility">Visibility</label>
                            </div>
                            <div class="column_2">
                                <select name="visibility">
                                    <option>No</option>
                                    <option>Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="confirm__buttons">
                            <button class="confirm__button confirm__button--ok confirm__button--fill" type="submit" value="Change" name="submit">Change</button>
                            <button class="confirm__button confirm__button--cancel" type="reset">${options.cancelText}</button>
                        </div>
                    </form>

        </div>
        </div>

    </div>
</div>`;

            const template_3 = document.createElement('template');
            template_3.innerHTML = change_html;

            const confirmEl = template_3.content.querySelector('.confirm');
            const btnClose = template_3.content.querySelector('.confirm__close');
            const btnchange = template_3.content.querySelector('.confirm__button--ok');
            const btnCancel = template_3.content.querySelector('.confirm__button--cancel');

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

            document.body.appendChild(template_3.content);
        },

        _close (confirmEl){
            confirmEl.classList.add('confirm--close');
            confirmEl.addEventListener('animationend', () => {
                document.body.removeChild(confirmEl);
            });
        }
    }

</script>
</body>
</html>
