//ajaxFunction
function ajaxRequest(reqUrl, method, sts, ajaxform) {
  return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.open(method, reqUrl, sts);
    xhr.onreadystatechange = () => {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          resolve(xhr.responseText);
          reqUrl = null;
          method = null;
          sts = null;
          form = null;
        } else {
          reject(xhr.statusText);
          reqUrl = null;
          method = null;
          sts = null;
          form = null;
        }
      }
    };
    xhr.send(ajaxform);
  });
}
//ajaxFunction

const signInForm = document.getElementById('signinForm');
const fPwForm = document.getElementById('forgotPwModal');

function filpAuth() {
  var signUpBox = document.getElementById('signUpBox');
  var signInBox = document.getElementById('signInBox');

  signInBox.classList.toggle('d-none');
  signUpBox.classList.toggle('d-none');
}

// sign up
function signUp() {
  var firstName = document.getElementById('fname').value;
  var lastName = document.getElementById('lname').value;
  var gender = document.getElementById('gender').value;
  var email = document.getElementById('semail').value;
  var password = document.getElementById('spw').value;
  var rePassword = document.getElementById('rspw').value;

  var formData = new FormData();
  formData.append('fname', firstName);
  formData.append('lname', lastName);
  formData.append('gender', gender);
  formData.append('email', email);
  formData.append('password', password);
  formData.append('repassword', rePassword);

  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.responseText == 'OK') {
        alert('Log In to your account')
      } else {
        document.getElementById('signUpWrn').className = 'text-danger';
        document.getElementById('signUpWrn').innerHTML = xhr.responseText;
      }
    }
  };

  xhr.open('POST', 'signup_process.php', true);
  xhr.send(formData);
}

// Add a JavaScript event listener to open the modal when the link is clicked
$(document).ready(function () {
  $('#forgotPasswordLink').click(function (e) {
    e.preventDefault(); // Prevent default link behavior
    $('#exampleModal').modal('show'); // Show the modal
  });
});

function signUp() {
  // alert('Sign Up');
  var firstName = document.getElementById('fname').value;
  var lastName = document.getElementById('lname').value;
  var gender = document.getElementById('gender').value;
  var email = document.getElementById('semail').value;
  var password = document.getElementById('spw').value;
  var rePassword = document.getElementById('rspw').value;

  // alert(firstName + ' ' + lastName + ' ' + gender + ' ' + email + ' ' + password
  //   + ' ' + rePassword);

  var formData = new FormData();
  formData.append('fname', firstName);
  formData.append('lname', lastName);
  formData.append('gender', gender);
  formData.append('email', email);
  formData.append('password', password);
  formData.append('repassword', rePassword);

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.responseText == 'OK') {
        alert('Log In to your account')
      } else {
        document.getElementById('signUpWrn').className = 'text-danger';
        document.getElementById('signUpWrn').innerHTML = xhr.responseText;
      }
    }
  }
  xhr.open('POST', 'signup_process.php', true);
  xhr.send(formData);

}

function logIn() {
  var email = document.getElementById('email').value;
  var password = document.getElementById('password').value;
  var rememberMe = document.getElementById('rememberme').checked;

  var formData = new FormData();
  formData.append('email', email);
  formData.append('password', password);
  formData.append('rememberme', rememberMe);

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.responseText == 'OK') {
        alert('Login successful');
        window.location = 'index.php';
      } else {
        document.getElementById('signInWarn').innerHTML = xhr.responseText;
      }
    }
  };
  xhr.open('POST', 'login_process.php', true);
  xhr.send(formData);
}

function sendEmail() {
  var email = document.getElementById('fpwEmail').value;
  
}