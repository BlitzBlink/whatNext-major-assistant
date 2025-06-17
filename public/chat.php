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
                <div class="container">
                    <div class="chat-container">
                    </div>
                    <div>
                        <form id="text-form">
                            <input type="text" placeholder="Ask me anything about the major" id="text-input">
                            <input type="image" src="/public/assets/images/icon-send.svg" id="send-icon">
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
    let input;
    
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