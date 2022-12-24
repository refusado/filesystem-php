const openDeleteBox = document.getElementById('openDelete');
const closeDeleteBox = document.getElementById('closeDelete');
const deleteBox = document.getElementById('deleteBox');

openDeleteBox.addEventListener('click', () => {
    deleteBox.classList.add('active');
    console.log('abrir');
});

closeDeleteBox.addEventListener('click', () => {
    deleteBox.classList.remove('active');
    console.log('fechar');
});