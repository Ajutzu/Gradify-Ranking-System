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

