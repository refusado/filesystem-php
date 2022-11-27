const openBtn = document.getElementById('upload-btn');
const container = document.getElementById('upload-container');
const filesInput = document.getElementById('upload__input');
const fileName = document.getElementById('upload__name');
const cancelBtn = document.getElementById('upload__cancel-btn');

if (filesInput) {
    filesInput.addEventListener('change', () => {
        let names = "";
        Array.from(filesInput.files).map(file => {
            names += `${file.name}\n`;
        });
        fileName.innerText = names;
    });
}

cancelBtn.addEventListener('click', (e) => {
    e.preventDefault();
    container.style.display = 'none';
});

openBtn.addEventListener('click', (e) => {
    e.preventDefault();
    container.style.display = 'flex';
});