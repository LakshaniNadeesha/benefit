var eye1 = document.getElementById("eye1");
var eye2 = document.getElementById("eye2");
var password = document.getElementById("pwd");
var confir = document.getElementById("confirm");

var dob = document.getElementById("dob");

var showPassword = false;

function dob_validate() {
    var dateObj = new Date();
    var min_date = subDays(dateObj, 18000);
    var max_date = subDays(dateObj, 6570);

    var max_m = dateObj.getUTCMonth() + 1;
    var max_d = dateObj.getUTCDate();
    var max_y = dateObj.getUTCFullYear();


    var min_m = min_date.getUTCMonth() + 1; //months from 1-12
    var min_d = min_date.getUTCDate();
    var min_y = min_date.getUTCFullYear();

    newdate = min_y + "-" + min_m + "-" + min_d;


    var max_m = max_date.getUTCMonth() + 1;
    var max_d = max_date.getUTCDate();
    var max_y = max_date.getUTCFullYear();

    max_date = max_y + "-" + max_m + "-" + max_d;


    // console.log(newdate);

    dob.min = newdate;
    dob.max = max_date;
    // console.log(dob.value);
    // console.log(dob.min);
}

dob_validate()


function subDays(myDate, days) {
    return new Date(myDate.getTime() - days * 24 * 60 * 60 * 1000);
}





eye1.addEventListener("click", function() {

    if (showPassword == false) {
        password.setAttribute("type", "text");
        eye1.classList.add("fa-eye-slash");
        eye1.classList.remove("fa-eye");
        showPassword = true;
    } else {
        confir.setAttribute("type", "password");
        password.setAttribute("type", "password");
        eye1.classList.remove("fa-eye-slash");
        eye1.classList.add("fa-eye");
        showPassword = false;
    }

});

eye2.addEventListener("click", function() {

    if (showPassword == false) {
        confir.setAttribute("type", "text");
        eye2.classList.add("fa-eye-slash");
        eye2.classList.remove("fa-eye");
        showPassword = true;
    } else {
        confir.setAttribute("type", "password");
        eye2.classList.remove("fa-eye-slash");
        eye2.classList.add("fa-eye");
        showPassword = false;
    }

});

var pass = document.getElementById("pwd");
var msg = document.getElementById("message");
var str = document.getElementById("strenght");
var phide = document.getElementById("phide");
var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
var hasNumber = /\d/;
var lett = /[abcdefghijklmnopqrstuvwxyz]/;

pass.addEventListener('input', () => {
    if (pass.value.length > 0) {
        msg.style.display = "block";
        document.getElementById("phide").value = "notvalied";
    } else {
        msg.style.display = "none";
    }
    if (pass.value.length < 4) {
        str.innerHTML = "Weak";
        msg.style.color = "red"
        msg.style.fontWeight = "bold"
        pass.style.borderBottomColor = "red";
        document.getElementById("phide").value = "notvalied";
    }
    if (pass.value.length > 4 && (format.test(pass.value) || hasNumber.test(pass.value))) {
        if (pass.value.length > 5 && format.test(pass.value) && hasNumber.test(pass.value) && lett.test(pass.value)) {
            str.innerHTML = "Strong";
            document.getElementById("phide").value = "valied";
            msg.style.color = "green";
            pass.style.borderBottomColor = "green";
            msg.style.fontWeight = "bold"
        } else {
            str.innerHTML = "Medium";
            msg.style.color = "blue";
            msg.style.fontWeight = "bold"
            pass.style.borderBottomColor = "blue";
            document.getElementById("phide").value = "notvalied";
        }

    }
})

var fname = document.getElementById("fname");
var lname = document.getElementById("lname");
var fval = document.getElementById("fval");
var lval = document.getElementById("lval");
var fhide = document.getElementById("fhide");
var lhide = document.getElementById("lhide");

fname.addEventListener('input', () => {
    if (format.test(fname.value) || hasNumber.test(fname.value)) {
        fval.style.display = "block";
        fname.style.color = "red";
        document.getElementById("fhide").value = "notvalied";
    } else {
        fval.style.display = "none";
        fname.style.color = "var(--header_dark)";
        document.getElementById("fhide").value = "valied";
    }
})

lname.addEventListener('input', () => {
    if (format.test(lname.value) || hasNumber.test(lname.value)) {
        lval.style.display = "block";
        lname.style.color = "red";
        // lhide.innerHTML = "notvalied";
        document.getElementById("lhide").value = "notvalied";
    } else {
        lval.style.display = "none";
        lname.style.color = "var(--header_dark)";
        // lhide.innerHTML = "valied";
        document.getElementById("lhide").value = "valied";
    }
})

var nic = document.getElementById("nic");
var nicval = document.getElementById("nicval");
var nichide = document.getElementById("nichide");

nic.addEventListener('input', () => {
    var space = nic.value.split(" ");
    console.log(space.length);
    if(space.length > 1){
        
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
        nicval.innerHTML = "Cannot Include Spaces";
        document.getElementById("nichide").value = "notvalied";
        nicval.style.display = "block";
        nicval.style.color = "red";
    } else if (nic.value.length < 10 && nic.value.length > 0) {
        nicval.innerHTML = "Minimum 10 digits must includes";
        // nichide.innerHTML = "notvalied";
        document.getElementById("nichide").value = "notvalied";
        nicval.style.display = "block";
        nicval.style.color = "red";
    } else if (nic.value.length == 10) {

        var le = nic.value.slice(9);
        var num = nic.value.slice(0, 9);
        if (!format.test(num) && !lett.test(num) && (le == "v" || le == "V")) {
            nicval.innerHTML = "NIC is Valid";
            var nbd = mynicfunction(nic.value);
            if (nbd.valid.length > 0) {
                // console.log(nbd.valid);
                nicval.innerHTML = nbd.valid;
                nicval.style.color = "red";
                document.getElementById("nichide").value = "notvalied";
            }
            else{
                document.getElementById("nichide").value = "valied";
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
                nicval.style.display = "block";
                nicval.style.color = "green";

                var date = nbd.date;
                var month = nbd.month;
                var formattedMonth = ("0" + month).slice(-2);
                var formattedDate = ("0" + date).slice(-2);
                // console.log(formattedMonth);
                // console.log(date);

                var year = nbd.year;
                var gender = nbd.gender;

                var bday =  `${year}-${formattedMonth}-${formattedDate}`;
                document.getElementById("dob").value = bday;

                if(gender == "Male"){
                    radiobtn = document.getElementById("male");
                    radiobtn.checked = true;
                }else{
                    radiobtn = document.getElementById("female");
                    radiobtn.checked = true;
                }
                // console.log(document.getElementById("dob").value);
                // console.log(bday);
            }

        } else {
            nicval.innerHTML = "NIC is Not Valid";
            // nichide.innerHTML = "notvalied";
            document.getElementById("nichide").value = "notvalied";
            nicval.style.display = "block";
            nicval.style.color = "red";
        }
    } else if (nic.value.length == 12) {
        if (!format.test(nic.value) && !lett.test(nic.value)) {
            nicval.innerHTML = "NIC is Valid";

            var nbd = mynicfunction(nic.value);
            if (nbd.valid.length > 0) {
                // console.log(nbd.valid);
                nicval.innerHTML = nbd.valid;
                nicval.style.color = "red";
                document.getElementById("nichide").value = "notvalied";
            } else {
                document.getElementById("nichide").value = "valied";
                nicval.style.display = "block";
                nicval.style.color = "green";

                var date = nbd.date;
                var month = nbd.month;

                // console.log(month.length)
                // var myNumber = 7;
                var formattedMonth = ("0" + month).slice(-2);
                var formattedDate = ("0" + date).slice(-2);
                // console.log(formattedMonth);
                // console.log(date);

                var year = nbd.year;
                var gender = nbd.gender;

                var bday =  `${year}-${formattedMonth}-${formattedDate}`;
                document.getElementById("dob").value = bday;

                if(gender == "Male"){
                    radiobtn = document.getElementById("male");
                    radiobtn.checked = true;
                }else{
                    radiobtn = document.getElementById("female");
                    radiobtn.checked = true;
                }
                // console.log(document.getElementById("dob").value);
                // console.log(bday);
            }
            // nichide.innerHTML = "valied";

        } else {
            nicval.innerHTML = "NIC is Not Valid";
            nicval.style.color = "red";
            nicval.style.display = "block";
            // nichide.innerHTML = "notvalied";
            document.getElementById("nichide").value = "notvalied";
        }
    } else {
        nicval.innerHTML = "NIC is Not Valid";
        // nichide.innerHTML = "notvalied";
        document.getElementById("nichide").value = "notvalied";
        nicval.style.display = "block";
        nicval.style.color = "red";
    }
})


function mynicfunction(nic) {
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
    // const nyear = [31,59,90,120,151,181,212,243,273,304,334,365];
    const nyear = [31,60,91,121,152,182,213,244,274,305,335,366];
    const bday = {month:"",date:"",year:"",gender:"",valid:""};


    var len = nic.length;
    // console.log(len);
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes

    if(len == 12){
        const year = nic[0]*1000 + nic[1]*100 + nic[2]*10 + nic[3]*1;
        var day = nic[4]*100 + nic[5]*10 + nic[6]*1;
        console.log("Day in length 12 : ",day);
        bday.year = year;

        if (day == 500 || day == 0) {
            bday.valid = "####500##### or ####000##### Not Valid";
        }

        if (day > 500) {
            bday.gender = "Female";
            day = day - 500;
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
            // console.log("Day in length 12 inside day > 500 : ",day);
        }else{
            // console.log("Day in length 12 inside day < 500 : ",day);
            bday.gender = "Male";
        }

        // if(year % 100 != 0 && year%4 == 0){
        //     console.log("inside leap year function");
        //     while(day - leapyear[i] > 0){
        //         i++;
        //     }
        //     console.log("While loop : ",i);
        //     bday.month = i+1;
        //     console.log(day - leapyear[i]);
        //     if(day - leapyear[i-1]>0){
        //         console.log("hbdbchbk",day - leapyear[i-1] );
        //     }else{
        //         console.log("day",day);
        //     }
        // }else{
            // console.log("inside normal year part length 12");
            var i =0;
            while(day - nyear[i] > 0){
                i++;
            }
            // console.log("While loop : ",i);
            bday.month = i+1;
            // console.log(day - nyear[i]);
            if(day - nyear[i-1]>0){
                // console.log("hbdbchbk",day - nyear[i-1] );
                bday.date = day - nyear[i-1];
            }else{
                // console.log("day",day);
                bday.date = day;
            }
        // }
    }
    else if(len == 10){
        const year = 1*1000 + 9*100 + nic[0]*10 + nic[1]*1;
        var day = nic[2]*100 + nic[3]*10 + nic[4]*1;

        // var date = 0;
        // console.log(day);

        bday.year = year;

        if (day == 500 || day == 0) {
            bday.valid = "##500##### or ####000##### Not Valid";
        }

        if (day > 500) {
            bday.gender = "Female";
            day = day - 500;
        } else {
            bday.gender = "Male";
        }
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
        ///////////////////////////// CALCULATE FOR LEAP YEAR /////////////////////////////

        // if(year % 100 != 0 && year%4 == 0){
        //     console.log("inside leap year function");
        //     while(day - leapyear[i] > 0){
        //         i++;
        //     }
        //     console.log("While loop : ",i);
        //     bday.month = i+1;
        //     console.log(day - leapyear[i]);
        //     if(day - leapyear[i-1]>0){
        //         console.log("hbdbchbk",day - leapyear[i-1] );
        //     }else{
        //         console.log("day",day);
        //     }
        // }else{
            // console.log("inside normal year part length 12");
            var i =0;
            while(day - nyear[i] > 0){
                i++;
            }
            // console.log("While loop : ",i);
            bday.month = i+1;
            // console.log(day - nyear[i]);
            if(day - nyear[i-1]>0){
                // console.log("hbdbchbk",day - nyear[i-1] );
                bday.date = day - nyear[i-1];
            }else{
                // console.log("day",day);
                bday.date = day;
            }
        // }
    }
    // console.log(bday.date,"--",bday.month,"--",bday.year,"///");
    return bday;
}

// var n = "995000373v";
// var d = myfunction(n);
// console.log(d.date,d.gender,d.valid);