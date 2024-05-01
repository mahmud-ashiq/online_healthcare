<?php
//include '../models/mydb.php';
$name = $email = $password = $phonenumber = $gender = $address = $nationselect = $license = $dob = "";
$haserror = $nameError = $emailError = $passwordError = $phonenumberError = $addressError = $licenseError = $nationselectError = $genderError = $dobError = "";

if (isset($_REQUEST['Submit'])) {
    $password = $_REQUEST['Password'];

    if (strlen($_REQUEST['Name']) < 4) {
        $nameError = " Name should be atleast 4 characeters";
        $haserror = 1;
    } else {
        $name = $_REQUEST['Name'];
    }
    if (!empty($_REQUEST['Email'])) {
        if (!preg_match('/aiub.edu/', $_REQUEST["Email"])) {
            $emailError = "Please enter a valid email address with aiub.edu";
            $haserror = 1;

        } else {
            $email = $_REQUEST['Email'];
        }

    } else {
        $emailError = "Email is Required";
        $haserror = 1;
    }

    if (strlen($password) > 6 || preg_match('/(A-Z)/', $password)) {

        $password = $_REQUEST['Password'];

    } else {
        $passwordError = " Password must be at least 6 characters and an uppercase";
        $haserror = 1;
    }
    if (is_numeric($_REQUEST['PhoneNumber'])) {
        $phonenumber = $_REQUEST['PhoneNumber'];
    } else {
        $phonenumberError = "Phone Number invalid";
        $haserror = 1;

    }
    if (!empty($_REQUEST["Address"])) {
        $address = $_REQUEST['Address'];
    } else {
        $addressError = "Enter an address";
        $haserror = 1;
    }
    if (!empty($_REQUEST['License'])) {
        $license = $_REQUEST['License'];
    } else {
        $licenseError = "Enter a License address";
        $haserror = 1;
    }

    if (!empty($_REQUEST["Nationality"])) {
        $nationselect = $_REQUEST['Nationality'];
        #echo $_REQUEST['Nationality'];
    } else {
        $nationselectError = "Select nation";
        $haserror = 1;
    }
    if (!empty($_REQUEST["DOB"])) {
        $dob = $_REQUEST['DOB'];

    } else {
        $dobError = "Select Date of Birth";
        $haserror = 1;
    }
    if (!empty($_REQUEST["Gender"])) {
        $nationselect = $_REQUEST['Gender'];

    } else {
        $nationselectError = "Select gender";
        $haserror = 1;
    }



    if ($haserror != 1) {
        $mydb = new Model();
        $conobj = $mydb->OpenCon();
        $result = $mydb->AddStudent($conobj, "ma_register", $_REQUEST["Name"], $_REQUEST["Email"], $_REQUEST["Password"], $_REQUEST["PhoneNumber"], $nationselect, $gender);
        if ($result === TRUE) {
            echo "Successfully Added";
        } else {
            echo "Please complete the validation ";
        }


    }
}
?>