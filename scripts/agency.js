const register_form=document.getElementById("cars_form");
const edit_form=document.getElementById("edit_form");

function validateIndianCarNumberPlate(numberPlate) {
    const regex = /[A-Z]{2}[0-9]{2}[A-Z]{2}[0-9]{4}/;
    return regex.test(numberPlate);
}
function getcars(){
    // Create a new FormData object
const formData = new FormData();
// Append data to the FormData object
formData.append('action', 'getcars');
    fetch('/tjcars/controllers/agency-helper.php', {
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
      document.getElementById("my_cars").innerHTML=data;
      actions();
      })
      .catch(error => {
        console.error('There was a problem with your fetch operation:', error);
      });
}
function actions(){
    document.querySelectorAll('.remove').forEach((elem)=>{
        elem.addEventListener('click',function(){
            let car_id=this.dataset.carid;
            Swal.fire({
                title: "Are you sure to Remove the vehicle?",
                showDenyButton: true,
                icon: "warning",
                confirmButtonText: "Remove",
                denyButtonText: `Close`
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    const formData = new FormData();
                    // Append data to the FormData object
                    formData.append('action', 'removecar');
                    formData.append('car_id', car_id);
                        fetch('/tjcars/controllers/agency-helper.php', {
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
                          if(data=='1'){
                          Swal.fire("Removed!", "", "success");
                          getcars();
                          actions();
                          }
                          else{
                            Swal.fire("Error in Removing!", "", "warning");
                          }
                          })
                          .catch(error => {
                            console.error('There was a problem with your fetch operation:', error);
                          });

                } else if (result.isDenied) {
                  Swal.fire("Not Removed", "", "info");
                }
              });
        })
    })

    document.querySelectorAll('.edit').forEach((elem)=>{
        elem.addEventListener('click',function(){
let car_id=this.dataset.carid;
let vehicle_no=this.dataset.vehicle_no;
let seating=this.dataset.seating;
let price=this.dataset.price;
let model=this.dataset.model;
document.getElementById("model2").value=model;
document.getElementById("vehicle_no2").value=vehicle_no;
document.getElementById("seating2").value=seating;
document.getElementById("price2").value=price;
document.getElementById("car_id2").value=car_id;
})
    })
}
register_form.addEventListener("submit",(e)=>{
e.preventDefault();
const model=document.getElementById("model").value.trim();
const vehicle_no=document.getElementById("vehicle_no").value.trim().toString().toUpperCase();
const seating=document.getElementById("seating").value.trim();
const price=document.getElementById("price").value.trim();
if(!validateIndianCarNumberPlate(vehicle_no) || seating<4 || seating>7 || price<100 || price>10000 || model.replaceAll(" ","").length<4){
    Swal.fire({
        title: "Wrong Details!",
        icon: "warning"
      });
      return;
}

// Create a new FormData object
const formData = new FormData();
// Append data to the FormData object
formData.append('model', model);
formData.append('vehicle_no', vehicle_no);
formData.append('seating', seating);
formData.append('price', price);
formData.append('action', "addcar");
fetch('/tjcars/controllers/agency-helper.php', {
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
        title: "Vehicle Already Exist!",
        icon: "warning"
      });
}
if(data==1){
    getcars();
    register_form.reset();
    document.getElementById("close_modal1").click();
    Swal.fire({
        title: "Vehicle Registered Successfully!",
        text: "Success!",
        icon: "success"
      }).then(()=>{
      })
}
})
.catch(error => {
  console.error('There was a problem with your fetch operation:', error);
});

})

edit_form.addEventListener("submit",(e)=>{
    e.preventDefault();
    const model=document.getElementById("model2").value.trim();
    const vehicle_no=document.getElementById("vehicle_no2").value.trim().toString().toUpperCase();
    const seating=document.getElementById("seating2").value.trim();
    const price=document.getElementById("price2").value.trim();
    const car_id=document.getElementById("car_id2").value.trim();
    console.log(car_id);
    if(!validateIndianCarNumberPlate(vehicle_no) || seating<4 || seating>7 || price<100 || price>10000 || model.replaceAll(" ","").length<4){
        Swal.fire({
            title: "Wrong Details!",
            icon: "warning"
          });
          return;
    }
    
    // Create a new FormData object
    const formData = new FormData();
    // Append data to the FormData object
    formData.append('model', model);
    formData.append('vehicle_no', vehicle_no);
    formData.append('seating', seating);
    formData.append('price', price);
    formData.append('car_id', car_id);
    formData.append('action', "editcar");
    fetch('/tjcars/controllers/agency-helper.php', {
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
    console.log(data);
    if(data==0){
        Swal.fire({
            title: "Vehicle Already Exist!",
            icon: "warning"
          });
    }
    if(data==1){
        getcars();
        edit_form.reset();
        document.getElementById("close_modal2").click();
        Swal.fire({
            title: "Vehicle Edited Successfully!",
            text: "Success!",
            icon: "success"
          }).then(()=>{
          })
    }
    })
    .catch(error => {
      console.error('There was a problem with your fetch operation:', error);
    });
    
    })
    
actions();

