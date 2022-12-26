const openDeleteBox = document.querySelector('.openDelete');
const closeDeleteBox = document.querySelector('.closeDelete');
const deleteBox = document.querySelector('.deleteBox');

if (openDeleteBox)
openDeleteBox.addEventListener('click', () => {
    deleteBox.classList.add('active');
});

if (closeDeleteBox)
closeDeleteBox.addEventListener('click', () => {
    deleteBox.classList.remove('active');
});


const openSettings = document.querySelector('#openSettings');
const settingsBox = document.querySelector('.settings');

const openInfo = document.querySelector('#openInfo');
const infoBox = document.querySelector('.info');


openSettings.addEventListener('click', () => {
    settingsBox.classList.add('active');
});

settingsBox.addEventListener('click', (e) => {
    if (e.target == settingsBox)
        settingsBox.classList.remove('active');
});

openInfo.addEventListener('click', () => {
    infoBox.classList.add('active');
});

infoBox.addEventListener('click', (e) => {
    if (e.target == infoBox)
        infoBox.classList.remove('active');
});