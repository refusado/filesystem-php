const openBtn = document.getElementById('upload-btn');
const container = document.getElementById('upload-container');
const filesInput = document.getElementById('upload__input');
const fileName = document.getElementById('upload__name');
const cancelBtn = document.getElementById('upload__cancel-btn');
const box = document.getElementById('file-list-box');

if (filesInput) {
    filesInput.addEventListener('change', () => {
        if (filesInput.files[0])
            box.classList.add('box--filled');
        
        let names = "";
            
        deleteFileName();
        Array.from(filesInput.files).map(file => {
            names += `${file.name}\n`;

            insertNewFile(file.name);
        });
    });
}

function insertNewFile(fileName) {
    let newName = document.createElement('span');
    newName.classList.add('upload__name');
    newName.innerText = fileName;

    box.appendChild(newName);
}

function deleteFileName() {
    const aliveNameFiles = document.getElementsByClassName('upload__name');
    Array.from(aliveNameFiles).map(n => {
        box.removeChild(n);
    });
}

cancelBtn.addEventListener('click', (e) => {
    e.preventDefault();
    container.style.display = 'none';

    deleteFileName(filesInput.files);
    box.classList.remove('box--filled');
});

openBtn.addEventListener('click', (e) => {
    e.preventDefault();
    container.style.display = 'flex';
});