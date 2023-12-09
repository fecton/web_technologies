function linearProgress(progress) {
    return progress; // Simple linear progress function
}

function moveLogo() {
    const element = document.getElementById("logo");
    const startY = -100; // Starting y-coordinate
    const endY = 0; // Ending y-coordinate
    const duration = 2000; // Animation duration (2 seconds)
    const startTime = new Date().getTime(); // Start time of the animation

    function animate() {
        const currentTime = new Date().getTime() - startTime; // Current time
        const progress = currentTime / duration; // Calculate the animation progress

        const newPosition = (endY - startY) * linearProgress(progress) + startY; // Calculate the new position

        element.style.top = newPosition + "px"; // Update the element's position

        if (progress < 1) {
            // If the animation is not yet complete, continue animating
            setTimeout(animate, 40); // Request the next frame in 40 milliseconds
        }
    }

    // Start the animation
    animate();
}
