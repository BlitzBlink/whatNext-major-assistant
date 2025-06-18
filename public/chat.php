<?php
$page = 'chatbot';
include_once('../templates/header.php');
?>


        <link rel="stylesheet" href="assets/css/chatbot.css">
   
 
        <main>
            <section id="heading">
                <h2>Chat with <span id="colored-text">WhatNext </span>Assistant</h2>
                <p>Ask me anything about ... major</p>
            </section>
            <section id="chatting">
                <div id="container">
                    <div id="toggle">
                        <h3>Where should we begin?</h3>
                        <div class="suggestion-cards">
                            <div class="message card"><p>What skills do I need?</p></div>
                            <div class="message card"><p>What Jobs can I get after graduation?</p></div>
                            <div class="message card"><p>What is the average annual salary for this major?</p></div>
                        </div>
                    </div>
                    <div class="chat-container">
                    </div>
                    <div>
                        <form id="text-form">
                            <input type="text" placeholder="Ask me anything about the major" id="text-input">
                            <input type="image" src="../public/assets/images/icon-send.svg" id="send-icon">
                        </form>
                    </div>
                </div>
            </section>
        </main>



<script type="module">
    // THis script is to include the gemini package, the reason we used url
    // is because we don't have a bundler and the browser won't know where is the package installed if we used npm
    import { GoogleGenAI } from "https://cdn.jsdelivr.net/npm/@google/genai@latest/+esm";
    const ai = new GoogleGenAI({ apiKey: "AIzaSyDnDIuWTaT3VO3i5HkoDqu7Z-VlsGWKOXc" });
    
    const form = document.getElementById("text-form");
    const textInput = document.getElementById("text-input");
    const chatElement = document.querySelector(".chat-container");
    const toggleCards = document.getElementById("toggle");
    let isVisible = true;
    let input;

    document.querySelectorAll('.suggestion-cards .message').forEach(card => {
    card.addEventListener('click', function() {
        console.log(document.getElementById("toggle"));
        const text = this.textContent;
        toggleCards.style.display = "none";
        addingMessage("Me", text, false);
        callingGemini(text).then(response => {
            addingMessage("WhatNext AI", response, true);
        });
    });
});
    
    form.addEventListener('submit', async e =>  {
        e.preventDefault();
        input = textInput.value.trim();
        textInput.value = "";
        addingMessage("Me" , input, false);
        const response = await callingGemini(input);
        addingMessage("WhatNext AI", response, true);
    });
    
    
    function addingMessage(sender, text, isLeft) {
        const newMessage = document.createElement("div");
        if(isVisible) {
            toggleCards.style.display = "none";
        }
        if(isLeft) {
        newMessage.className = 'left-message-container';
        }
        else {
            newMessage.className = 'right-message-container';
        }
        newMessage.innerHTML = `
            <p class="label">${sender}</p>
            <div class="message">
                <p>${text}</p>
            </div>`;
        chatElement.appendChild(newMessage);
    
        newMessage.scrollIntoView({
            behavior: 'smooth',  
            block: 'end'         
        });
    }
    
    async function callingGemini(text) {
        
        const response = await ai.models.generateContent({
            model: "gemini-2.0-flash",
            systemInstruction: {
                parts: [{
                    text: "Your name is WhatNext assistant"+ 
                            "You're a college advisor. Be concise, friendly, " +
                            "and focus on practical career advice. Keep responses " +
                            "under 150 words unless complex questions require more."
                }]
            },
            contents: `${text}`,
        });
  
  return response.text
    .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
    .replace(/\*(.*?)\*/g, '<em>$1</em>')
    .replace(/\n\*(.*?)(?=\n)/g, '<li>$1</li>')
    .replace(/\n- (.*?)(?=\n)/g, '<li>$1</li>')
    .replace(/\n\n/g, '</p><p>')
    .replace(/\n/g, '<br>');
};
</script>


<?php include_once('../templates/footer.php'); ?>