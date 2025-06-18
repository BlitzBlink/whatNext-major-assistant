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



<script type="module" src="assets/js/chatbot.js"></script>


<?php include_once('../templates/footer.php'); ?>