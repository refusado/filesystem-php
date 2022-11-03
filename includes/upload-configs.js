const sizeInput = document.getElementById("sizeLimit");
const size = document.getElementById("sizeValue");

function updateSizeValue() {
  // 500KB 1MB 5MB 7MB 10MB 15MB 20MB 30MB 40MB 50MB 60MB 70MB 80MB 90MB 100MB 150MB
  switch (sizeInput.value) {
    case "1":
      size.textContent = "500KB";
      break;
    case "2":
      size.textContent = "1MB";
      break;
    case "3":
      size.textContent = "5MB";
      break;
    case "4":
      size.textContent = "7MB";
      break;
    case "5":
      size.textContent = "10MB";
      break;
    case "6":
      size.textContent = "15MB";
      break;
    case "7":
      size.textContent = "20MB";
      break;
    case "8":
      size.textContent = "30MB";
      break;
    case "9":
      size.textContent = "40MB";
      break;
    case "10":
      size.textContent = "60MB";
      break;
    case "11":
      size.textContent = "70MB";
      break;
    case "12":
      size.textContent = "90MB";
      break;
    case "13":
      size.textContent = "100MB";
      break;
    case "14":
      size.textContent = "150MB";
      break;
    default:
      break;
  }
}

sizeInput.addEventListener("mousemove", updateSizeValue);
sizeInput.addEventListener("input", updateSizeValue);

updateSizeValue();