const searchForm = document.querySelector("#search-form");
const searchFormInput = searchForm.querySelector("input");
const micBtn = document.querySelector("#mic-btn");
const micIcon = micBtn.querySelector("i");
const info = document.querySelector(".info");

// Speech Recognition API
const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

if (SpeechRecognition) {
    console.log("Your Browser supports speech Recognition");

    const recognition = new SpeechRecognition();
    recognition.continuous = false; // Dừng nhận diện sau mỗi câu
    recognition.interimResults = false; // Chỉ nhận kết quả cuối cùng
  

    // Event: mic button click
    micBtn.addEventListener("click", () => {
        if (micIcon.classList.contains("fa-microphone-slash")) {
            recognition.start();
        } else {
            recognition.stop();
        }
    });

    // Event: start recognition
    recognition.addEventListener("start", () => {
        micIcon.classList.replace("fa-microphone-slash", "fa-microphone");
        searchFormInput.focus();
        console.log("Voice activated, SPEAK");
    });

    // Event: end recognition
    recognition.addEventListener("end", () => {
        micIcon.classList.replace("fa-microphone", "fa-microphone-slash");
        console.log("Speech recognition service disconnected");
    });

    // Event: result of speech recognition
    recognition.addEventListener("result", (event) => {
        const transcript = event.results[0][0].transcript.trim().toLowerCase();
        console.log("Recognized Text:", transcript);

        if (transcript === "stop recording") {
            recognition.stop();
        } else if (transcript === "reset input") {
            searchFormInput.value = "";
        } else if (transcript === "go") {
            searchForm.submit();
        } else {
            searchFormInput.value = transcript;
            searchForm.submit();
        }
    });

    // Restart recognition after stopping (optional)
    recognition.addEventListener("end", () => {
        if (micIcon.classList.contains("fa-microphone")) {
            recognition.start();
        }
    });
} else {
    console.log("Your Browser does not support speech Recognition");
    info.textContent = "Your Browser does not support Speech Recognition";
}
