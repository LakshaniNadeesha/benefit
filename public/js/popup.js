const financial = document.querySelector('#financial');
const hr = document.querySelector('#hr');
const seles = document.querySelector('#seles');
const operational = document.querySelector('#operational');
const confirmEl = document.querySelector('.confirm');
const btnClose = document.querySelector('.confirm__close');
const btnOk = document.querySelector('.confirm__button--ok');
const btnCancel = document.querySelector('.confirm__button--cancel');
console.log(confirmEl);
console.log(btnClose);
console.log(btnOk);
console.log(btnCancel);
// console.log(btnChangeBg);
// document.body.appendChild(document.content); 

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

btnOk.addEventListener('click', () => {
    onok();
    close(confirmEl);
});

function onok() {
    if(document.querySelector('body').style.backgroundColor == 'white'){
        document.body.style.backgroundColor = 'blue';
    }else{
        document.body.style.backgroundColor = 'white';   
    }
    
}

// btnChangeBg.addEventListener('click',()=>{
//     pop(confirmEl);
// });

[hr, financial, seles, operational].forEach(el => {
    el.addEventListener('click', () => {
        // options.oncancel();
        pop(confirmEl);
    });
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