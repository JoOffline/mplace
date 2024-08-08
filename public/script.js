document.addEventListener('DOMContentLoaded', function() {
    const text = "Welcome";
    let index = 0;
    const speed = 200; // Typing speed in milliseconds
    const eraseSpeed = 100; // Erasing speed in milliseconds
    const delayBetweenTypingAndErasing = 1000; // Delay before starting to erase
    const delayBeforeRestarting = 500; // Delay before restarting typing after erasing
    const typedText = document.getElementById('typed-text');
    let isErasing = false;

    function typeWriter() {
        if (!isErasing && index < text.length) {
            typedText.innerHTML += text.charAt(index);
            index++;
            setTimeout(typeWriter, speed);
        } else if (isErasing && index > 0) {
            typedText.innerHTML = text.substring(0, index - 1);
            index--;
            setTimeout(typeWriter, eraseSpeed);
        } else if (!isErasing && index === text.length) {
            setTimeout(() => {
                isErasing = true;
                typeWriter();
            }, delayBetweenTypingAndErasing);
        } else if (isErasing && index === 0) {
            isErasing = false;
            setTimeout(typeWriter, delayBeforeRestarting);
        }
    }

    typeWriter();
});
