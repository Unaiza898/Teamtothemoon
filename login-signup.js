// const loginForm = document.getElementById("login-form");
// const loginButton = document.getElementById("login-form-submit");
// const loginErrorMsg = document.getElementById("login-error-msg");

// // When the login button is clicked, the following code is executed
// loginButton.addEventListener("click", (e) => {
//     // Prevent the default submission of the form
//     e.preventDefault();
//     // Get the values input by the user in the form fields
//     const username = loginForm.username.value;
//     const password = loginForm.password.value;

//     if (username === "user" && password === "web_dev") {
//         // If the credentials are valid, show an alert box and reload the page
//         alert("You have successfully logged in.");
//         location.href("/Dashboard")
//     } else {
//         // Otherwise, make the login error message show (change its oppacity)
//         loginErrorMsg.style.opacity = 1;
//     }
// })
// function validateLoginForm() {
// 	var name = document.getElementById("logName").value;
// 	var password = document.getElementById("logPassword").value;

// 	if (name == "" || password == "") {
// 		document.getElementById("errorMsg").innerHTML = "Please fill the required fields"
// 		return false;
// 	}

// 	else if (password.length < 8) {
// 		document.getElementById("errorMsg").innerHTML = "Your password must include atleast 8 characters"
// 		return false;
// 	}
// 	else {
// 		alert("Successfully logged in");
// 		return true;
// 	}
// }
// function validateSignupForm() {
// 	var mail = document.getElementById("signEmail").value;
// 	var name = document.getElementById("signName").value;
// 	var password = document.getElementById("signPassword").value;

// 	if (mail == "" || name == "" || password == "") {
// 		document.getElementById("errorMsg").innerHTML = "Please fill the required fields"
// 		return false;
// 	}

// 	else if (password.length < 8) {
// 		document.getElementById("errorMsg").innerHTML = "Your password must include atleast 8 characters"
// 		return false;
// 	}
// 	else {
// 		alert("Successfully signed up");
// 		return true;
// 	}
// }