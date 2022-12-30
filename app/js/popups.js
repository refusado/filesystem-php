// **** Popup de exclusão de arquivo

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

// **** Popup de configurações

const openSettings = document.querySelector('#openSettings');
const settingsBox = document.querySelector('.settings');

openSettings.addEventListener('click', () => {
    settingsBox.classList.add('active');
});

settingsBox.addEventListener('click', (e) => {
    if (e.target == settingsBox)
        settingsBox.classList.remove('active');
});

// **** Popup de informações

const openInfo = document.querySelector('#openInfo');
const infoBox = document.querySelector('.info');

openInfo.addEventListener('click', () => {
    infoBox.classList.add('active');
});

infoBox.addEventListener('click', (e) => {
    if (e.target == infoBox)
        infoBox.classList.remove('active');
});

// **** Popup de upload de arquivo

const openDownloadBox = document.querySelector('#upload-btn');
const closeDownloadBox = document.querySelector('#upload__cancel-btn');
const downloadBox = document.querySelector('#upload-container');

const fileName = document.querySelector('#upload__name');
const fileBox = document.querySelector('#file-list-box');

const filesInput = document.querySelector('#upload__input');

openDownloadBox.addEventListener('click', () => {
    filesInput.value = "";

    const aliveFiles = [...document.querySelectorAll('.upload__name')];
    aliveFiles.map(n => fileBox.removeChild(n));
    fileBox.classList.remove('box--filled');

    downloadBox.classList.add('active');
});

downloadBox.addEventListener('click', (e) => {
    if (e.target == downloadBox)
    downloadBox.classList.remove('active');
});

closeDownloadBox.addEventListener('click', () => {
    downloadBox.classList.remove('active');
});

filesInput.addEventListener('change', () => {
    if (filesInput.files[0])
        fileBox.classList.add('box--filled');
    
    let names = "";
    Array.from(filesInput.files).map(file => {
        names += `${file.name}\n`;

        let newName = document.createElement('span');
        newName.classList.add('upload__name');
        newName.innerText = file.name;
    
        fileBox.appendChild(newName);
    });
});









window.addEventListener('keyup', (e) => {
    const activeElements = [...document.querySelectorAll('.active')];
    if (e.key == 'Escape')
        activeElements.map(e => e.classList.remove('active'));
});