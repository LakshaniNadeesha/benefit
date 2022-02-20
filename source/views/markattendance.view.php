<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>attendance.css">

    <title>Attendance</title>
</head>
<script>
    function date_validation() {
        var t1 = document.forms["attendance-form"]["arrival"].value;
        var t2 = document.forms['attendance-form']["departure"].value;
        console.log("t1");
        document.getElementById("arrival").innerHTML = t1;

        var t1date = new Date("01/01/2021" + t1);
        var t2date = new Date("01/01/2021" + t2);

        if (t1date < t2date) {
            document.getElementById("arrival").innerHTML = "<div style='font-family: Arial,serif; font-size: smaller; color: red'><i class='fas fa-exclamation' style='color: red;'></i></div>";
        }
    }

</script>

<body>
<div>
    <?php
    $this->view('includes/header1');
    ?>
</div>

<div class="page_content">
    <?php
    $this->view('includes/parentemployeenavbar');
    ?>

    <div class="main_container">
        <div class="on_leave">
            <div class="section1">
                <p class="title"><u>On Leave</u></p>
                <p>Today</p>
                <img src="<?= Auth::getprofile_image() ?>" alt="on-leave-people" class="on-leave-people">
                <img src="<?= Auth::getprofile_image() ?>" alt="on-leave-people" class="on-leave-people">
                <img src="<?= Auth::getprofile_image() ?>" alt="on-leave-people" class="on-leave-people">
                <p>Tomorrow</p>
                <img src="<?= Auth::getprofile_image() ?>" alt="on-leave-people" class="on-leave-people">
                <img src="<?= Auth::getprofile_image() ?>" alt="on-leave-people" class="on-leave-people">
                <img src="<?= Auth::getprofile_image() ?>" alt="on-leave-people" class="on-leave-people">
            </div>
            <div class="section2">
                <p class="title"><u>Calender</u></p>
                <?php $this->view('includes/calendar') ?>
            </div>
        </div>
        <div class="right-section">

            <div class="emp_list">
                <form name="attendance-form" action="" method="post" onsubmit="return date_validation();"
                      enctype="multipart/form-data" autocomplete="off">
                    <p class="title">Employee List</p>
                    <div class="top-section">
                        <div class="to-be-add">
                            <div class="slideshow-container">
                                <div class="next-prev">
                                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                                </div>
                                <div class="mySlides fade">
                                    <div class="numbertext">1 / 2</div>
                                    <!--                                    <div class="mySlides fade">-->
                                    <p>To Be Add</p>
                                    <hr>
                                    <?php
                                    if (boolval($not_marked)) {
                                        for ($i = 0; $i < sizeof($not_marked); $i++) {
                                            ?>
                                            <div class="box">
                                                <img src="<?php print_r($not_marked[$i]->profile_image) ?>"
                                                     alt="on-leave-people"
                                                     class="on-leave-people">
                                                <p class="content1"><?php print_r($not_marked[$i]->first_name);
                                                    echo " ";
                                                    print_r($not_marked[$i]->last_name) ?></p>
                                                <p class="content2"><?php print_r($not_marked[$i]->department_ID) ?>
                                                <p class="content3"><?php print_r($not_marked[$i]->designation_code) ?></p>
                                                <?php
                                                $select = 'select';
                                                $select .= $i;
                                                ?>
                                                <input type="checkbox" id="<?php echo $select ?>" name="person[]"
                                                       value="<?php print_r($not_marked[$i]->employee_ID); ?>">
                                                <a href="http://localhost/benefit/markattendance/absent/<?php print_r($not_marked[$i]->employee_ID); ?>/<?php echo date('Y-m-d'); ?>">
                                                    <i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                            </div>
                                            <script>
                                                const hideBox = document.querySelector('<?php echo "#" . $select;?>');
                                                hideBox.addEventListener('change', function (e) {
                                                    if (hideBox.checked) {
                                                        list.style.display = "initial";
                                                    } else {
                                                        list.style.display = "none";
                                                    }
                                                });
                                            </script>
                                            <?php
                                        }
                                    } else {
                                        echo "No employees yet!";
                                        echo "<br><br>";
                                    } ?>
                                </div>
                                <div class="mySlides fade">
                                    <div class="numbertext">2 / 2</div>
                                    <!--                                    <div class="mySlide fade">-->
                                    hello
                                    <?php if (boolval($previous)) {
                                        for ($i = 0; $i < sizeof($previous); $i++) {
                                            print_r($previous[$i]);
                                            echo "<br>";
                                        }
                                    }
                                    ?>
                                </div>

                            </div>
                            <br>

                            <div style="text-align:center; float: bottom; top: 80%">
                                <span class="dot" onclick="currentSlide(1)"></span>
                                <span class="dot" onclick="currentSlide(2)"></span>
                            </div>

                        </div>

                        <div class="attendance_form">
                            <div class="form-title">Fill This</div>
                            <div class="form-content">
                                <div class="date">
                                    <label for="date">Date : </label>
                                    <input type="date" name="date" id="name" value="<?php echo date('Y-m-d'); ?>"
                                           required>
                                </div>
                                <div class="selected-names">
                                    <?php
                                    if (boolval($not_marked)) {
                                        for ($i = 0; $i < sizeof($not_marked); $i++) {
                                            $list = 'list';
                                            $list .= $i;
                                            ?>
                                            <div class="box" id="<?php echo $list ?>">
                                                <img src="<?php print_r($not_marked[$i]->profile_image) ?>"
                                                     alt="on-leave-people"
                                                     class="on-leave-people">
                                                <p class="content"><?php print_r($not_marked[$i]->first_name); ?></p>
                                            </div>
                                            <script>
                                                const list = document.querySelector('<?php echo "#" . $list;?>');
                                            </script>
                                            <?php
                                        }
                                    } ?>
                                </div>
                                <div class="row">
                                    <label for="arrival">Arrival</label>
                                    <input type="time" name="arrival" id="arrival" value="08:00:00" required>
                                </div>
                                <div class="row">
                                    <label for="departure">Departure</label>
                                    <input type="time" name="departure" id="departure" value="16:30:00" required>
                                </div>
                                <div class="row">
                                    <label for="ot-hours">OT Hours</label>
                                    <input type="number" name="ot-hours" id="ot-hours" value="0" min="0">
                                </div>
                                <div class="buttons">
                                    <button type="reset" class="m-cancel">Cancel</button>
                                    <input type="submit" class="m-mark" value="Mark" name="mark">
                                </div>
                            </div>
                </form>

            </div>
        </div>
    </div>
    <div class="history-table">
        <p>Attendance History</p>
        <hr>
        <?php if (boolval($history)) { ?>
            <table>
                <thead>
                <th>Name</th>
                <th>Arrival</th>
                <th>Departure</th>
                <th>Date</th>
                <th>OT Hours</th>
                <th>Status</th>
                <th>Option</th>
                </thead>
                <tbody>
                <?php
                for ($i = 0; $i < sizeof($history); $i++) {
                    if (boolval($history[$i])) {
                        for ($j = 0; $j < sizeof($history[$i]); $j++) {
                            ?>
                            <tr>
                                <td><?php print_r($history[$i][$j]->name); ?></td>
                                <td><?php print_r($history[$i][$j]->arrival_time); ?></td>
                                <td><?php print_r($history[$i][$j]->departure_time); ?></td>
                                <td><?php print_r($history[$i][$j]->date); ?></td>
                                <td><?php print_r($history[$i][$j]->ot_hours); ?></td>
                                <td><?php print_r($history[$i][$j]->status); ?></td>
                                <?php
                                $btnChange = 'btnChange';
                                $btnChange .= $i;
                                $btnChange .= $j;
                                $btnDelete = 'btnDelete';
                                $btnDelete .= $i;
                                $btnDelete .= $j;
                                //echo $btnChange;
                                ?>
                                <td id="options">
                                    <div id="<?php echo $btnChange ?>" onclick="reply_click(this.id)"><i
                                                class="fas fa-pencil-alt"></i></div>
                                    <script type="text/javascript">
                                        document.querySelector('<?php echo "#" . $btnChange;?>').addEventListener('click', () => {
                                            Change.open({
                                                title: 'Changing..',
                                                message: '',
                                                name: '<?php print_r($history[$i][$j]->name) ?>',
                                                date: '<?php print_r($history[$i][$j]->date) ?>',
                                                arrival: '<?php print_r($history[$i][$j]->arrival_time) ?>',
                                                departure: '<?php print_r($history[$i][$j]->departure_time) ?>',
                                                ot: '<?php print_r($history[$i][$j]->ot_hours) ?>',
                                                status: '<?php print_r($history[$i][$j]->status) ?>',
                                                id: '<?php print_r($history[$i][$j]->employee_ID) ?>',
                                                //href: '<?php //echo "change/"; print_r($history[$i][$j]->employee_ID); ?>//',
                                                onchange: () => {
                                                    //window.location.href = "<?php //print_r($history[$i][$j]->employee_ID); ?>//"
                                                },
                                            })
                                        });
                                    </script>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                } ?>
                </tbody>
            </table>
            <?php
        } else {
            echo "No history yet";
        } ?>
    </div>
</div>
<script>
    var slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }
</script>
<script>
    const Change = {
        open(options) {
            options = Object.assign({}, {
                title: '',
                message: '',
                name: '',
                date: '',
                arrival: '',
                departure: '',
                ot: '',
                status: '',
                id: '',

                cancelText: 'Cancel',
                onchange: function () {
                },
                oncancel: function () {
                }
            }, options);


            const change_html = `<div class="confirm">
    <div class="confirm__window">
        <div class="confirm__titlebar">
            <span class="confirm__title">${options.title}</span>
            <button class="confirm__close">&times</button>
        </div>
        <div class="confirm__content">${options.message}
            <div class="attendance-update_form" id="myForm">
                 <form action="" method="post" autocomplete="off">
                     <div class="first_row">
                          <div>
                              <div class="column_1">
                                  <label for="emp_name">Name :</label>
                              </div>
                              <div class="column_2">
                                    <input type="text" id="emp_name" name="emp_name" value="${options.name}" readonly>
                                    <input type="text"  name="id" value="${options.id}" readonly hidden>
                              </div>
                            </div>
                            <div>
                                <div class="column_2">
                                    <input type="date" id="date" name="date" value="${options.date}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="column_1">
                                <label for="arrival">Arrival</label>
                            </div>
                            <div class="column_2">
                                <input type="time" id="arrival" name="arrival" value="${options.arrival}" required >
                            </div>
                        </div>

                        <div class="row">
                            <div class="column_1">
                                <label for="departure">Departure</label>
                            </div>
                            <div class="column_2">
                                <input type="time" id="departure" name="departure" value="${options.departure}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="column_1">
                                <label for="ot_hours">OT Hours</label>
                            </div>
                            <div class="column_2">
                                <input type="number" id="ot_hours" name="ot_hours" value="${options.ot}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="column_1">
                                <label for="status">Status</label>
                            </div>
                            <div class="column_2">
                                <input type="text" id="status" name="status" value="${options.status}" readonly>
                            </div>
                        </div>
                        <div class="confirm__buttons">
                            <button class="confirm__button confirm__button--cancel" type="reset">${options.cancelText}</button>
                            <button class="confirm__button confirm__button--ok confirm__button--fill" type="submit" value="Change" name="submit">Change</button>
                        </div>
                 </form>
            </div>
        </div>
    </div>`;

            const template_3 = document.createElement('template');
            template_3.innerHTML = change_html;

            const confirmEl = template_3.content.querySelector('.confirm');
            const btnClose = template_3.content.querySelector('.confirm__close');
            // const btnchange = template_3.content.querySelector('.confirm__button--ok');
            const btnCancel = template_3.content.querySelector('.confirm__button--cancel');

            confirmEl.addEventListener('click', e => {
                if (e.target === confirmEl) {
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

        _close(confirmEl) {
            confirmEl.classList.add('confirm--close');
            confirmEl.addEventListener('animationend', () => {
                document.body.removeChild(confirmEl);
            });
        }
    }

</script>
</body>
</html>
