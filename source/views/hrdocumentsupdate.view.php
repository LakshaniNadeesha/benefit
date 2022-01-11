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
    <title>HRDoc Update</title>
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
        <div class="document_list">
            <div class="title_container">
                <p class="handling_title">Documents</p>
                <?php if(Auth::access('HR Manager')): ?>
                <div class="add_documents">
                    <p> <a style="text-decoration:none" href="<?= PATH ?>Hrdocuments/add/"><i class="fas fa-plus-circle"></i>New Document</a></p>
                    <!-- <a href="<?= PATH ?>Hrdocuments/add/"><i class="fas fa-edit" id="edit"></i></a> -->

                </div>
                <?php endif; ?>
            </div>
            <table>
                <tr>
                    <th>Document Name</th>
                    <th>File Path</th>
                    <th>Last Update</th>
                    <th>Option</th>
                </tr>

                <?php
                    $i = 0;

                    if (boolval($row)) {

                        for ($i = 0; $i < sizeof($row); $i++) {

                            $vai = $row[$i]; 
                            ?>
                                <tr>
                                    <td><?php print_r($vai->document_name); ?></td>
                                    <td><?php print_r($vai->document_path); ?></td>
                                    <td><?php print_r($vai->updated_date); ?></td>
                                    <?php
                                      $btnDelete = 'btnDelete';
                                      $btnDelete .= $i;
                                    ?>
                                    <td><a href="<?= PATH ?>Hrdocuments/editdocuments/<?= $vai->document_name?>"><i class="fas fa-edit" id="edit"></i></a>
                                    <?php if(Auth::access('HR Manager')): ?>
                                    <a href="<?= PATH ?>Hrdocuments/delete/<?= $vai->document_hashing ?>">
                                    <i class="fas fa-trash-alt" id="delete"></i></a>
                                    <?php endif; ?>
                                    </td>
                                </tr>

                            <?php 
                        }
                    } ?>
            </table>
        </div>
   
</div>
</div>

<script>
//Delete Button
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

            // btnReject.addEventListener('click', e => {
            //     options.onreject();
            //     this._close(confirmEl);
            // });

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
            // [btnClose].forEach(el => {
            //     el.addEventListener('click', () => {
            //         options.oncancel();
            //         this._close(confirmEl);
            //     });
            // });

            document.body.appendChild(template_2.content);
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
