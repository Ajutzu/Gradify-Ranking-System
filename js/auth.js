// Register

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
        },
      });
      Toast.fire({
        title:
          "<i class='bi bi-exclamation-circle me-2 text-danger' style='font-size: 1.1rem;'></i> Please fill in all fields",
        background: "white",
        textColor: "black",
      });
      return;
    }

    if (!email.includes("@")) {
      const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
      });
      Toast.fire({
        title:
          "<i class='bi bi-exclamation-circle me-2 text-danger' style='font-size: 1.1rem;'></i> Please enter a valid email address",
        background: "white",
        textColor: "black",
      });
      return;
    }
  }

  document.getElementById("step" + current).style.display = "none";
  document.getElementById("step" + next).style.display = "block";
}

function prevStep(current, prev) {
  document.getElementById("step" + current).style.display = "none";
  document.getElementById("step" + prev).style.display = "block";
}

// Login

document.addEventListener("DOMContentLoaded", function () {
  var params = new URLSearchParams(window.location.search);
  var value = params.get("answer");
  if (value == "Authentication Failed") {
    let timerInterval;
    Swal.fire({
      title: "Authentication Failed",
      html: "<div class=text-center>I will close in <b></b> milliseconds.</di>",
      timer: 2000,
      timerProgressBar: true,
      didOpen: () => {
        Swal.showLoading();
        const timer = Swal.getPopup().querySelector("b");
        timerInterval = setInterval(() => {
          timer.textContent = `${Swal.getTimerLeft()}`;
        }, 100);
      },
      willClose: () => {
        clearInterval(timerInterval);
      },
    }).then((result) => {
      if (result.dismiss === Swal.DismissReason.timer) {
        console.log("I was closed by the timer");
      }
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  var params = new URLSearchParams(window.location.search);
  var value = params.get("output");

  if (value == "error") {
    Swal.fire({
      icon: "error",
      title: "Something Went Wrong",
      html: '<div class="text-center">An error occurred while processing your request. Please try again later.</div>',
    });
  }
});
