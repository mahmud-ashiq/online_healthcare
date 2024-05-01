
function validateForm() {

    var fname = document.getElementById("fname").value;
    var specialChars = /[!@#$%^&*(),.?":{}|<>]/;
    if (specialChars.test(fname))
     {
        document.getElementById("fnameError").innerHTML = "Please enter a valid first name ";
        return false;
    }
    var lname = document.getElementById("lname").value;
    
    if (specialChars.test(lname))
     {
        document.getElementById("lnameError").innerHTML = "Please enter a valid last name ";
        return false;
    }
    
    var gender = document.querySelector('input[name="gender"]:checked');
    if (!gender) {
        document.getElementById("genderError").innerHTML = "Gender must be selected";
        return false;
    }
    
    var cat = document.getElementById("cat").value;
    if (cat == "") {
      document.getElementById("catError").innerHTML = "category must be filled";
      return false;
    }

    
  
 
}
