// Define a function to play a sound
function playSound(soundFile, volume) {
    const audio = new Audio(soundFile);
    audio.volume = volume;  // Set the volume (range: 0.0 to 1.0)
    audio.play();
}

// Add event listeners to navbar links
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', () => {
        playSound("sound/pop-268648.mp3", 1); // Replace with your sound file
    });
});
