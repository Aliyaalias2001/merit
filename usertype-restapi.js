document.getElementById('registration-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission

    // Get form data
var username = document.getElementsByName('username')[0].value;
var password = document.getElementsByName('password')[0].value;
var confirmPassword = document.getElementsByName('confirm_password')[0].value;
var userType = document.getElementsByName('user_type')[0].value;

console.log('User Type:', userType); // Add this line

    if (username && password && confirmPassword && password === confirmPassword) {
        // Send user registration request to the API
        var userData = {
            username: username,
            password: password,
            user_type: userType
        };

        var userDataJson = JSON.stringify(userData);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost:8080/merit/restapi-users.php');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onload = function() {
            if (xhr.status === 200) {
                var responseData = JSON.parse(xhr.responseText);
                if (responseData.message) {
                    console.log('Registration response:', responseData.message);

                    if (responseData.user_id) {
                        var userId = responseData.user_id;

                        if (userType === 'organizer') {
                            // Prepare organizer data
                            var orgName = document.getElementById('org_name').value;
                            var orgPhone = document.getElementById('org_phone').value;
                            var orgEmail = document.getElementById('org_email').value;

                            var organizerData = {
                                org_name: orgName,
                                org_phone: orgPhone,
                                org_email: orgEmail,
                                user_id: userId
                            };

                            var organizerDataJson = JSON.stringify(organizerData);

                            // Create a new organizer using the API
                            var xhr2 = new XMLHttpRequest();
                            xhr2.open('POST', 'http://localhost:8080/merit/restapi-organizer.php');
                            xhr2.setRequestHeader('Content-Type', 'application/json');
                            xhr2.onload = function() {
                                if (xhr2.status === 200) {
                                    var responseData2 = JSON.parse(xhr2.responseText);
                                    if (responseData2.message) {
                                        console.log('Organizer creation response:', responseData2.message);
                                    } else {
                                        console.log('Invalid API response');
                                    }
                                }
                            };
                            xhr2.send(organizerDataJson);
                        }
                    }
                } else {
                    console.log('Invalid API response');
                }
            }
        };
        xhr.send(userDataJson);
    } else {
        console.log('Error: Passwords do not match');
    }
});