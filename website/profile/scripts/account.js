function validateProfileForm() {
    var fname = document.forms["profileForm"]["fname"].value;
    var lname = document.forms["profileForm"]["lname"].value;
    var phonenumber = document.forms["profileForm"]["phonenumber"].value;
    var phoneRegex = /^[0-9]{10}$/;

    if (fname === "" || lname === "" || phonenumber === "") {
        alert("All fields must be filled out");
        return false;
    }

    if (!phoneRegex.test(phonenumber)) {
        alert("Phone number must be 10 digits and contain only numbers");
        return false;
    }

    return true;
}

function validateAddressForm() {
    var street1 = document.forms["addressForm"]["street1"].value;
    var district = document.forms["addressForm"]["district"].value;
    var postalcode = document.forms["addressForm"]["postalcode"].value;
    var phoneRegex = /^[0-9]{10}$/;
    var postalcodeRegex = /^[0-9]+$/;

    if (street1 === "" || district === "" || postalcode === "") {
        alert("All fields must be filled out");
        return false;
    }

    if (!postalcodeRegex.test(postalcode)) {
        alert("Postal code must contain only numbers");
        return false;
    }

    return true;
}