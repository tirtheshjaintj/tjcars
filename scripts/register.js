const register_form=document.getElementById("register_form");
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
function validateEmail(email) {
  return emailRegex.test(email);
}
register_form.addEventListener("submit",(e)=>{
    e.preventDefault();
const name=document.getElementById("name").value.trim();
const email=document.getElementById("email").value.trim();
const password=document.getElementById("password").value.trim();
const type=document.getElementById("type").value.trim();
if(!validateEmail(email) || password.trim().length<8 || (type!="user"  && type!="agency")){
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
formData.append('name', name);
formData.append('type', type);
formData.append('password', password);
fetch('/tjcars/controllers/register-helper.php', {
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
if(data==0){
    Swal.fire({
        title: "User Already Exist!",
        icon: "warning"
      });
}
if(data==1){
    Swal.fire({
        title: "Registered Successfully!",
        text: "Success!",
        icon: "success"
      }).then(()=>{
        register_form.submit();
      })
}
})
.catch(error => {
  console.error('There was a problem with your fetch operation:', error);
});

})