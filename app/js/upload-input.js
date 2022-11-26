const fileInput = document.getElementById('upload__file-input');
const filesInput = document.getElementById('upload__files-input');

const fileName = document.getElementById('upload__file-name');
const filesNames = document.getElementById('upload__files-names');

if (fileInput) {
    fileInput.addEventListener('change', () => {
        let inputFile = fileInput.files[0];
        fileName.innerText = inputFile.name;
    });
}

const container = document.getElementById('upload-container');
const openBtn = document.getElementById('upload-btn');
const cancelBtn = document.getElementById('upload__cancel-btn');

cancelBtn.addEventListener('click', (e) => {
    e.preventDefault();
    container.style.display = 'none';
});

openBtn.addEventListener('click', (e) => {
    e.preventDefault();
    container.style.display = 'flex';
});