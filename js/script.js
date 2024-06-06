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

$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})

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

function sendEmail(event) {
  event.preventDefault();
  var email = document.getElementById('fpwEmail').value;
  var formData = new FormData();
  formData.append('email', email);

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.responseText == 'Sent') {
        // alert('Verification code sent successfully');
        document.getElementById('fpwMoadlWrn').className = 'text-success';
        document.getElementById('fpwMoadlWrn').innerHTML = xhr.responseText;
      } else {
        document.getElementById('fpwMoadlWrn').className = 'text-danger';
        document.getElementById('fpwMoadlWrn').innerHTML = xhr.responseText;
      }
    }
  };
  xhr.open('POST', 'sendVcodeProcess.php', true);
  xhr.send(formData);
}

function sendToPwReset(event) {
  event.preventDefault();
  var email = document.getElementById('fpwEmail').value;
  var code = document.getElementById('fpwCode').value;

  var formData = new FormData();
  formData.append('email', email);
  formData.append('code', code);

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.responseText == 'OK') {
        window.location = 'reset-password.php?email=' + email;
      } else {
        document.getElementById('fpwMoadlWrn').className = 'text-danger';
        document.getElementById('fpwMoadlWrn').innerHTML = xhr.responseText;
      }
    }
  };
  xhr.open('POST', 'pwResetProcess.php', true);
  xhr.send(formData);

}

function resetPw(email) {
  var password = document.getElementById('pw').value;
  var rePassword = document.getElementById('cpw').value;

  var formData = new FormData();
  formData.append('email', email);
  formData.append('pw', password);
  formData.append('rpw', rePassword);

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.responseText == 'OK') {
        alert('Password reset successful, Please Login');
        window.location = 'account.php';
      } else {
        document.getElementById('nPwWarn').className = 'text-danger';
        document.getElementById('nPwWarn').innerHTML = xhr.responseText;
      }

    }
  };
  xhr.open('POST', 'newPwProcess.php', true);
  xhr.send(formData);

}

function saveProfile() {
  var firstName = document.getElementById('fname').value;
  var lastName = document.getElementById('lname').value;
  var email = document.getElementById('email').value;
  // alert(firstName + lastName + email);

  var formData = new FormData();
  formData.append('fname', firstName);
  formData.append('lname', lastName);
  formData.append('email', email);

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.responseText == 'OK') {
        alert('Profile updated successfully');
      } else {
        alert(xhr.responseText);
      }

    }
  }
  xhr.open('POST', 'saveProfileProcess.php', true);
  xhr.send(formData);

}

function addToCartCard(id, event) {
  event.preventDefault();

  var formData = new FormData();
  formData.append('id', id);

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.responseText == 'OK') {
        alert('Product added to cart');
        // window.location = 'cart.php';
      } else {
        window.location = 'account.php';
      }
    }
  }
  xhr.open('POST', 'addToCartProcessCard.php', true);
  xhr.send(formData);

}

function addToCartSp(id, event) {
  event.preventDefault();

  var quantity = document.getElementById("quantity").value;

  var formData = new FormData();
  formData.append('id', id);
  formData.append('qty', quantity);

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.responseText == 'OK') {
        alert('Product added to cart');
        // window.location = 'cart.php';
      } else {
        alert(xhr.responseText);
        window.location = 'account.php';
      }
    }
  }
  xhr.open('POST', 'addToCartProcessSp.php', true);
  xhr.send(formData);

}