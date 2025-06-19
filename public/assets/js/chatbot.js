// This script is to include the gemini package, the reason we used url
// is because we don't have a bundler and the browser won't know where is the package installed if we used npm
import { GoogleGenAI } from "https://cdn.jsdelivr.net/npm/@google/genai@latest/+esm";
const ai = new GoogleGenAI({ apiKey: "AIzaSyDnDIuWTaT3VO3i5HkoDqu7Z-VlsGWKOXc" });
    
const form = document.getElementById("text-form");
const textInput = document.getElementById("text-input");
const chatElement = document.querySelector(".chat-container");
const toggleCards = document.getElementById("toggle");
let isVisible = true;
let input;
let isTyping = false;

document.querySelectorAll('.suggestion-cards .message').forEach(card => {
    card.addEventListener('click', function() {
        const text = this.textContent;
        toggleCards.style.display = "none";
        addingMessage("Me", text, false);
        typingIndicator();
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
    typingIndicator();
    const response = await callingGemini(input);
    addingMessage("WhatNext AI", response, true);
});
    
    
function addingMessage(sender, text, isLeft) {
    const newMessage = document.createElement("div");
    if(isVisible) {
        toggleCards.style.display = "none";
    }
    if(isLeft && isTyping) {
    newMessage.className = 'left-message-container';
    chatElement.lastChild.remove();
    isTyping = false;
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
};

function typingIndicator() {
    isTyping = true;
    const typingIndicator = document.createElement("div");
    typingIndicator.className = "left-message-container";
    typingIndicator.innerHTML = `<div class="typing-indicator">
                                    <div class="dot-flashing"></div>
                                    </div>`;
    chatElement.appendChild(typingIndicator);
};


    
async function callingGemini(text) {
    
    const response = await ai.models.generateContent({
        model: "gemini-2.0-flash",
        config: {
        systemInstruction: "Your name is WhatNext assistant"+ 
                        "You're a Major advisor. Be concise, friendly, " +
                        "and focus on practical career advice. keep responses under 250 words unless complex questions require more",
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