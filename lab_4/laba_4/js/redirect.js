// Set the initial time value to 2 seconds
var time = 2;

// Define a function to update the 'Label' element and handle redirection
function updateLabelAndRedirect() {
    document.getElementById('Label').innerHTML = time;

    if (time === 0) {
        document.getElementById('H1').innerHTML = "Redirecting...";
        window.location.href = "index.html";
    }

    // Decrement the time by 1 second
    time--;
}

// Call the updateLabelAndRedirect function every 1000 milliseconds (1 second)
setInterval(updateLabelAndRedirect, 1000);