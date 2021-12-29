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
    document.getElementById('hide').value = 2;
    console.log(document.getElementById('hide').value);
   
});

financial.addEventListener('click', () => {
    
    pop(confirmEl);
    document.getElementById('hide').value = 4;
    console.log("This is financial "+financial);
    console.log(document.getElementById('hide').value);
});

operational.addEventListener('click', () => {
    // options.oncancel();
    pop(confirmEl);
    document.getElementById('hide').value = 1;
    console.log("This is operation "+operational);
    console.log(document.getElementById('hide').value);
});

seles.addEventListener('click', () => {
    // options.oncancel();
    pop(confirmEl);
    document.getElementById('hide').value = 3;
    console.log("This is selse "+seles);
    console.log(document.getElementById('hide').value);
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