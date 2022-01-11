<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_PATH ?>updatedocuments.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>updatebenefit.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>benefits.css">
    <title></title>
</head>

<body>
<div>
    <?php
    $this->view('includes/header1');
    ?>
</div>

<div class="page_content">
    <?php if (Auth::access('HR Manager')): ?>
        <div>
            <?php
            $this->view('includes/hrmanagernavbar');
            ?>
        </div>
    <?php endif; ?>

    <?php if (Auth::access('HR Officer')): ?>
        <div>
            <?php
            $this->view('includes/hrofficernavbar')
            ?>
        </div>
    <?php endif; ?>
    <div class="main_container">
        <div class="benefit_list">
            <div class="title_container">
                <p class="handling_title">Document List List</p>
                <?php if(Auth::access('HR Manager')): ?>
                <div class="add_documents" id="add_documents" onclick="openForm()">
                    <p><i class="fas fa-plus-circle"></i> Add New Documents</p>
                </div>
                    <script type="text/javascript">

                        document.querySelector('#add_documents').addEventListener('click', () => {
                            //document.getElementById("this.id").addEventListener('click', () => {
                            Confirm.open({
                                title: 'New Document!',
                                onok: () => {
                                    window.location.href = "updatedocuments/"
                                },
                            })
                        });
                    </script>
                <?php endif; ?>
            </div>
            <?php
            if(boolval($row)){ ?>
            <table id="benefitList">
                <thead>
                    <tr>
                        <th>Document Name</th>
                        <th>File Path</th>
                        <th>Last Update</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for($i=0 ;$i<sizeof($row); $i++){ ?>
                    <tr>
                        <td><?php print_r($row[$i]->document_name); ?></td>
                        <td><?php print_r($row[$i]->document_path); ?></td>
                        <td><?php print_r($row[$i]->updated_date); ?></td>
                        <?php
                        $btnChange = 'btnChange';
                        $btnChange .= $i;
                        $btnDelete = 'btnDelete';
                        $btnDelete .= $i;
                        //echo $btnChange;
                        ?>
                        <td id="options"><div id="<?php echo $btnChange ?>" onclick="reply_click(this.id)"><i class="fas fa-edit" id="edit"></i></div>
                                        <script type="text/javascript">
                                            document.querySelector('<?php echo "#".$btnChange;?>').addEventListener('click', () => {
                                                Change.open({
                                                    title: 'Changing..',
                                                    name: '<?php print_r($row[$i]->document_name) ?>',
                                                    date: '<?php print_r($row[$i]->updated_date) ?>',
                                                    submission: '<?php print_r($row[$i]->document_path) ?>',
                                                    href: '<?php echo"editdocuments/"; print_r($row[$i]->document_name); ?>',
                                                    // onchange: () => {
                                                    //     window.location.href = "<?php // print_r($row[$i]->document_name); ?>"
                                                    // },
                                                })
                                            });
                                        </script>
                            <?php if(Auth::access('HR Manager')): ?>
                            <div id="<?php echo $btnDelete ?>" onclick="reply_click(this.id)"><i class="fas fa-trash-alt" id="delete"></i></div>
                                <script type="text/javascript">
                                    document.querySelector('<?php echo "#".$btnDelete;?>').addEventListener('click', () => {
                                        Deletion.open({
                                            title: 'Are you sure you want to delete this?',
                                            onok: () => {
                                                window.location.href = "delete/<?php print_r($row[$i]->document_name); ?>"
                                            }
                                        })
                                    });
                                </script>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <?php
                    } ?>
                </tbody>
            </table>
            <?php
            }
            else { ?>
                    <div class="no_benefits">No Documents Yet!</div>
            <?php }?>
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
                //okText: 'Save',
                cancelText: 'Cancel',
                //rejectText: 'Reject',
                //onok: function () {},
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

                    <form action="" method="post" autocomplete="off">

                    <div class="row">
                        <div class="column_1">
                            <label for="d_name">Document Name</label>
                        </div>
                        <div class="column_2">
                            <input type="text" id="d_name" name="d_name" required>
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
                           <i class="fas fa-cloud-upload-alt"></i>
                           <p>Browse File to Upload</p>
                            </form2>
                            <div>
                            <section class="progress-area"></section>
                          
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
            //const btnReject = template.content.querySelector('.confirm__button--cancel');
            const btnClose = template_1.content.querySelector('.confirm__close');
            //const btnOk = template.content.querySelector('.confirm__button--ok');
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
                //rejectText: 'Reject',
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
            //const btnReject = template_2.content.querySelector('.confirm__button--cancel');
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
                name: '',
                date: '',
                submission: '',
                href: '',
                //okText: 'Save',
                cancelText: 'Cancel',
                //rejectText: 'Reject',
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
                            <label for="d_name">Document Name</label>
                        </div>
                        <div class="column_2">
                            <input type="text" id="d_name" name="d_name" value="${options.name}" required>
                        </div>
                </div>

                <div class="row">
                        <div class="column_1">
                            <label for="updated_date">Updated Date</label>
                        </div>
                        <div class="column_2">
                            <input type="date" id="updated_date" value="${options.date}"name="updated_date" readonly>
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
                           ${options.submission}
				           </div>
                           <i class="fas fa-cloud-upload-alt"></i>
                           <p>Browse File to Upload</p>
                            </form2>
                            <div>
                            <section class="progress-area"></section>
                          
                        </div>
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
            //const btnReject = template_3.content.querySelector('.confirm__button--cancel');
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