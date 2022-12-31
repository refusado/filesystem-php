const sizeInput = document.querySelector("#sizeLimit");
const size = document.querySelector("#sizeValue");
const fileSizes = ["0B", "500KB", "1MB", "5MB", "7MB", "10MB", "15MB", "20MB", "30MB", "40MB", "60MB", "70MB", "90MB", "100MB", "150MB"]

function updateSizeValue() {
  size.textContent = fileSizes[sizeInput.value];
}

sizeInput.addEventListener("mousemove", updateSizeValue);
sizeInput.addEventListener("input", updateSizeValue);

updateSizeValue();
