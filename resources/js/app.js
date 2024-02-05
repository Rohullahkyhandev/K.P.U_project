import './bootstrap';
import './bootstrap';



// navbar part
const toggle = document.querySelector('.toggle');
const arrow = document.querySelector('.arrow');
let flag = false;
const showProfile = document.getElementById('showProfile');
showProfile.addEventListener('click', () => {
    toggle.classList.toggle('fade');
    arrow.classList.toggle('top_down');
    flag = true;
})
// end of navbar

// document.body.addEventListener('click', () => {
//     if (flag === true) {
//         toggle.style.display = 'none';
//         arrow.classList.toggle('top_down');
//     }
// })

// table toggle box
const toggleButton = document.querySelectorAll('.toggleButton');
const toggleBox = document.querySelectorAll('.toggleBox');



toggleButton.forEach(button => {
    button.addEventListener('click', () => {
        toggleBox.forEach(box => {
            box.classList.toggle('fade');
        })
    })
})

// sidebar buttons


