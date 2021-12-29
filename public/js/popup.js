const financial = document.querySelector('#financial');
const hr = document.querySelector('#hr');
const seles = document.querySelector('#seles');
const operational = document.querySelector('#operational');
const confirmEl = document.querySelector('.confirm');
const btnClose = document.querySelector('.confirm__close');

const btnCancel = document.querySelector('.confirm__button--cancel');
console.log(confirmEl);
console.log(btnClose);

console.log(btnCancel);

console.log("This is hr "+hr);
console.log("this is financial "+financial);
console.log("this is seles "+ seles);
console.log("this is operational "+operational);

confirmEl.addEventListener('click',e => {
    if (e.target === confirmEl) {
        // options.oncancel();
        close(confirmEl);
    }
});

[btnCancel, btnClose].forEach(el => {
    el.addEventListener('click', () => {
        // options.oncancel();
        close(confirmEl);
    });
});

// btnOk.addEventListener('click', () => {
//     onok();
//     close(confirmEl);
// });

// function onok() {
//     if(document.querySelector('body').style.backgroundColor == 'white'){
//         document.body.style.backgroundColor = 'blue';
//     }else{
//         document.body.style.backgroundColor = 'white';   
//     }
    
// }

// btnChangeBg.addEventListener('click',()=>{
//     pop(confirmEl);
// });

// [hr, financial, seles, operational].forEach(el => {
//     el.addEventListener('click', () => {
//         // options.oncancel();
//         pop(confirmEl);
//         console.log("This is hr "+hr);
//         // console.log("this is financial "+financial);
//         // console.log("this is seles "+ seles);
//         // console.log("this is operational "+operational);
//     });
// });

hr.addEventListener('click', () => {
   
    pop(confirmEl);
    console.log("This is hr "+hr);
    document.getElementById("dhr").style.display = "block";
    document.getElementById("dfinancial").style.display = "none";
    document.getElementById("doperation").style.display = "none";
    document.getElementById("dselse").style.display = "none";
   
});

financial.addEventListener('click', () => {
    
    pop(confirmEl);
   
    document.getElementById("dfinancial").style.display = "block";
    document.getElementById("doperation").style.display = "none";
    document.getElementById("dselse").style.display = "none";
    document.getElementById("dhr").style.display = "none";
    
});

operational.addEventListener('click', () => {
    // options.oncancel();
    pop(confirmEl);
    // document.getElementById('hide').value = 1;
    document.getElementById("doperation").style.display = "block";
    document.getElementById("dselse").style.display = "none";
    document.getElementById("dhr").style.display = "none";
    document.getElementById("dfinancial").style.display = "none";

    // console.log("This is operation "+operational);
    // console.log(document.getElementById('hide').value);
});

seles.addEventListener('click', () => {
    // options.oncancel();
    pop(confirmEl);
    // document.getElementById('selse').style.display="block";
    document.getElementById("dselse").style.display = "block";
    document.getElementById("dhr").style.display = "none";
    document.getElementById("dfinancial").style.display = "none";
    document.getElementById("doperation").style.display = "none";

    // console.log("This is selse "+seles);
    // console.log(document.getElementById('hide').value);
});

function close (confirmEl) {
    console.log('You closed the window!');
    confirmEl.classList.add('confirm--close');

    document.body.removeChild(confirmEl);
        
        
};

function pop(confirmEl){
   
    document.body.appendChild(confirmEl);
    confirmEl.classList.remove('confirm--close');
    confirmEl.classList.remove('init');
};