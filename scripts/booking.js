const booking_form=document.getElementById("booking_form");
booking_form.addEventListener("submit",(e)=>{
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
    fetch('/tjcars/controllers/booking-helper.php', {
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
        booking_form.reset();
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