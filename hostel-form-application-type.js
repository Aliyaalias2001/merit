 // get the select element for the application type
 var applicationTypeSelect = document.getElementById("application-type");

 // get the hospital letter label and input elements
 var uniformedNumberLabel = document.getElementById("uniformed-number-label");
 var uniformedNumberInput = document.getElementById("uniformed-number");
 
 // add an event listener to the select element for changes
 applicationTypeSelect.addEventListener("change", function() {
   // get the selected value
   var selectedValue = applicationTypeSelect.value;
   
   // if the selected value is "health-problem", show the uniformed number label and input, otherwise hide them
   if (selectedValue === "uniformed-troops") {
     uniformedNumberLabel.style.display = "block";
     uniformedNumberInput.style.display = "block";
   } else {
     uniformedNumberLabel.style.display = "none";
     uniformedNumberInput.style.display = "none";
   }
 });
 
 
                 // get the select element for the application type
 var applicationTypeSelect = document.getElementById("application-type");
 
 // get the hospital letter label and input elements
 var hospitalLetterLabel = document.getElementById("hospital-letter-label");
 var hospitalLetterInput = document.getElementById("hospital-letter");
 
 // add an event listener to the select element for changes
 applicationTypeSelect.addEventListener("change", function() {
   // get the selected value
   var selectedValue = applicationTypeSelect.value;
   
   // if the selected value is "health-problem", show the hospital letter label and input, otherwise hide them
   if (selectedValue === "health-problem") {
     hospitalLetterLabel.style.display = "block";
     hospitalLetterInput.style.display = "block";
   } else {
     hospitalLetterLabel.style.display = "none";
     hospitalLetterInput.style.display = "none";
   }
 });