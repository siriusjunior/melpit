require('./bootstrap');

document.querySelector('.image-picker input')
.addEventListener('change', (e) => {
const input = e.target;
const reader = new FileReader();
reader.onload = (e) => {
input.closest('.image-picker').querySelector('img').src = e.target.result
};
reader.readAsDataURL(input.files[0]);
});