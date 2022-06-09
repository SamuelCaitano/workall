function showHide() {
  let input = document.getElementById("password");
  let eye = document.getElementsByClassName("fa-eye");
  
  if (input.type == "password") {
    input.type = "text";
    eye.class = "fa-eye-slash";
  } else {
    input.type = "password";
  }

  let button = document.querySelector(".fa-solid"); 

  if (button.classList.contains("fa-eye")) { 
    button.classList.remove("fa-eye"); 
    button.classList.add("fa-eye-slash"); 
  } else { 
    button.classList.remove("fa-eye-slash"); 
    button.classList.add("fa-eye"); 
  }
}