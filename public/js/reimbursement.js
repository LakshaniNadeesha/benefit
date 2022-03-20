// function number_validation() {
//     var n = document.forms["myform"]["claim_amount"].value;
//     if (isNaN(n)) {
//         alert("Please enter numeric value as claim amount");
//         reason_validation();
//         return false;
//     } else {
//         // document.getElementById("validText").innerHTML = "Numeric";
//         var f1 = reason_validation();
//         var f2 = true
//         if (f1 && f2) {
//             return true;
//         } else {
//             return false;
//         }
//     }
// }

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
    let progressHTML = `<span class="name" style="color: black; font-size:15px; margin-right:80px;font-weight:normal;margin-left:0;">${name}</span>`;
    progressArea.innerHTML = progressHTML;
    let data = new FormData(form);
    xhr.send(data);
}

//get claim date
// var today = new Date();
// var max_m = today.getUTCMonth() + 1;
// var max_d = today.getUTCDate();
// var max_y = today.getUTCFullYear();

// today_date = max_y + "-" + max_m + "-" + max_d;

// document.getElementById("claim_date").setAttribute("max", today_date);

// var dateObj = new Date();

// var min_date = subDays(dateObj, 6);

// var min_m = min_date.getUTCMonth() + 1; //months from 1-12
// var min_d = min_date.getUTCDate();
// var min_y = min_date.getUTCFullYear();

// newdate = min_y + "-" + min_m + "-" + min_d;

// document.getElementById("claim_date").setAttribute("min", newdate);


// function subDays(myDate, days) {
//     return new Date(myDate.getTime() - days * 24 * 60 * 60 * 1000);
// }