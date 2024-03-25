function toggleForm() {
  var container = document.querySelector(".container");
  container.classList.toggle("active");
}

function validateForm() {
    var emailInput = document.getElementById('email');
    var emailError = document.getElementById('emailError');
    var email = emailInput.value.trim();
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
    if (email === '') {
      emailError.textContent = 'Email is required';
      emailInput.focus();
      return false;
    } else if (!emailPattern.test(email)) {
      emailError.textContent = 'Please enter a valid email address';
      emailInput.focus();
      return false;
    }
  
    emailError.textContent = '';
    return true;
  }