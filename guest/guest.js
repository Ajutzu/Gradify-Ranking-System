setTimeout(() => {
    const adSection = document.getElementById('adSection');
    adSection.style.display = 'block';
    setTimeout(() => {
        adSection.style.opacity = 1; // Fade in
        adSection.classList.add('slide-in');
    }, 10); 
}, 3000);


let btn = document.getElementById('adSection');

btn.addEventListener('click', () => {
    adSection.style.display = 'none';
});