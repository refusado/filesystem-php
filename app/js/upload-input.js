const fileInput = document.getElementById('file');
const filesInput = document.getElementById('files');

const fileName = document.getElementById('fileName');
const filesNames = document.getElementById('filesNames');

fileInput.addEventListener('change', () => {
    let inputFile = fileInput.files[0];
    fileName.innerText = inputFile.name;
});