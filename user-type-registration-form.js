function showFields() {
    var userSelect = document.getElementById("user_type");
    var organizationFields = document.getElementById("organization_fields");
    var staffFields = document.getElementById("staff_fields");

    if (userSelect.value === "organizer") {
        organizationFields.style.display = "block";
        staffFields.style.display = "none";
    } else if (userSelect.value === "staff") {
        organizationFields.style.display = "none";
        staffFields.style.display = "block";
    } else {
        organizationFields.style.display = "none";
        staffFields.style.display = "none";
    }
}