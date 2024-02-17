"use script";

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("card2").style.display = "none"; // Hides the resulted business card
    document.getElementById("return").style.display = "none"; // Hides the return button
    document.getElementById("errorMessage").style.display = "none"; // Hides the error message

    document.getElementById("print").addEventListener("click", function() { // On_Click_Listener for the "Skriv Ut" button
        if(!(document.getElementById("company").value == "" || //Checks if any of the input fields are empty
        document.getElementById("lastName").value == "" ||
        document.getElementById("firstName").value == "" ||
        document.getElementById("title").value == "" ||
        document.getElementById("telephone").value == "" ||
        document.getElementById("email").value == "")) {
            document.getElementById("card1").style.display = "none"; // Hides card1
            document.getElementById("card2").style.display = "block"; // Shows card2
            document.getElementById("return").style.display = "block"; // Shows the return button
            document.getElementById("errorMessage").style.display = "none"; // Hides the errorMessage

            // Set background color of card2
            document.getElementById("card2").style.backgroundColor = document.getElementById("backgroundColor").value;
            // Set text color of card2
            document.getElementById("card2").style.color = document.getElementById("textColor").value;
            // Set text font of card2
            document.getElementById("card2").style.fontFamily = document.getElementById("font").value;

            // Set text values
            document.getElementById("companyText").innerHTML = document.getElementById("company").value;
            document.getElementById("nameText").innerHTML = document.getElementById("firstName").value + " " + document.getElementById("lastName").value;
            document.getElementById("titleText").innerHTML = document.getElementById("title").value;
            document.getElementById("telephoneText").innerHTML = "Tfn " + document.getElementById("telephone").value;
            document.getElementById("emailText").innerHTML = "E-post: " + document.getElementById("email").value;

            // Resets input fields
            document.getElementById("company").value = "";
            document.getElementById("lastName").value = "";
            document.getElementById("firstName").value = "";
            document.getElementById("title").value = "";
            document.getElementById("telephone").value = "";
            document.getElementById("email").value = "";
        }

        else {
            document.getElementById("errorMessage").style.display = "block";
        }
        
    });

    document.getElementById("reset").addEventListener("click", function() {
        reset();
    });

    document.getElementById("return").addEventListener("click", function() {
        reset();
    });
})

function reset() {
    document.getElementById("card1").style.display = "block"; // Shows "card1"
    document.getElementById("card2").style.display = "none"; // Hides "card2"
    document.getElementById("errorMessage").style.display = "none" // Hides the errorMessage
    document.getElementById("return").style.display = "none"; // Hides the return button

    // Resets all input fields
    document.getElementById("company").value = "";
    document.getElementById("lastName").value = "";
    document.getElementById("firstName").value = "";
    document.getElementById("title").value = "";
    document.getElementById("telephone").value = "";
    document.getElementById("email").value = "";

    // Resets all select fields
    document.getElementById("backgroundColor").value = "lightblue";
    document.getElementById("textColor").value = "black";
    document.getElementById("font").value = "verdana";
}