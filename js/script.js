function createPasswordToggle(passwordField, toggleButton) {
  toggleButton.addEventListener("click", function () {
    // Toggle the password field type
    const type =
      passwordField.getAttribute("type") === "password" ? "text" : "password";
    passwordField.setAttribute("type", type);

    // Toggle the eye icon
    const icon = toggleButton.querySelector("i");
    icon.classList.toggle("bi-eye-fill");
    icon.classList.toggle("bi-eye-slash-fill");
  });
}

// Initialize all password toggles on the page
document.querySelectorAll(".password-toggle").forEach((toggle) => {
  const passwordField = toggle.parentElement.querySelector(
    'input[type="password"]'
  );
  if (passwordField) {
    createPasswordToggle(passwordField, toggle);
  }
});

// Prevent context menu
document.addEventListener('contextmenu', (e) => e.preventDefault());

// Prevent F12, Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U
document.addEventListener('keydown', (e) => {
  if (
      e.key === 'F12' || 
      (e.ctrlKey && e.shiftKey && e.key === 'I') || 
      (e.ctrlKey && e.shiftKey && e.key === 'J') || 
      (e.ctrlKey && e.key === 'U')
  ) {
      e.preventDefault();
  }
});

// Prevent Ctrl+U
document.addEventListener('keydown', (e) => {
  if (e.ctrlKey && e.key === 'U') {
      e.preventDefault();
  }
});

  // Next and Previous Step Function
function nextStep(current, next) {
  // Basic validation for first step
  if (current === 1) {
      const username = document.querySelector('input[name="username"]').value;
      const email = document.querySelector('input[name="email"]').value;
      const fullname = document.querySelector('input[name="fullname"]').value;
      
      if (!username || !email || !fullname) {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          }
        });
        Toast.fire({
          title: "<i class='bi bi-exclamation-circle me-2 text-danger' style='font-size: 1.1rem;'></i> Please fill in all fields"
        });
          return;
      }
      
      if (!email.includes('@')) {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
        });
        Toast.fire({
          title: "<i class='bi bi-exclamation-circle me-2 text-danger' style='font-size: 1.1rem;'></i> Please enter a valid email address"
        });
        return;
      }
  }
  
  document.getElementById('step' + current).style.display = 'none';
  document.getElementById('step' + next).style.display = 'block';
}

function prevStep(current, prev) {
  document.getElementById('step' + current).style.display = 'none';
  document.getElementById('step' + prev).style.display = 'block';
}
