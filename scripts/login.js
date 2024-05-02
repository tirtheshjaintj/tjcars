const login_form=document.getElementById("login_form");
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
function validateEmail(email) {
  return emailRegex.test(email);
}

login_form.addEventListener("submit",(e)=>{
const email=document.getElementById("email").value.trim();
const password=document.getElementById("password").value.trim();
e.preventDefault();
if(!validateEmail(email) || password.trim().length<8){
    Swal.fire({
        title: "Wrong Credentials!",
        icon: "warning"
      });
      return;
}
// Create a new FormData object
const formData = new FormData();
// Append data to the FormData object
formData.append('email', email);
formData.append('password', password);
fetch('/tjcars/controllers/loggedin.php', {
  method: 'POST',
  body: formData // Pass the FormData object as the body
})
.then(response => {
  if (!response.ok) {
    throw new Error('Network response was not ok');
  }
  return response.text();
})
.then(data => {
//console.log(data);
if(data==0){
    Swal.fire({
        title: "Wrong Credentials!",
        text: "Check Email And Password!",
        icon: "warning"
      });
}
if(data==1){
    login_form.submit();
}
})
.catch(error => {
  console.error('There was a problem with your fetch operation:', error);
});




})