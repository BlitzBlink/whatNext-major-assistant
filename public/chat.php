<?php
$page = 'chatbot';
include_once('../templates/header.php');
include_once('../src/config/db.php');
$majorID = $_GET['major_id'];
$query = "SELECT name FROM Major WHERE major_id = $majorID;";
$result = mysqli_query($conn, $query);
$major = mysqli_fetch_assoc($result);
$account_id = $_SESSION['account_id'] ?? null;
if(!$account_id) header("Location: /whatnext/public/login.php");
?>


        <link rel="stylesheet" href="assets/css/chatbot.css">
   
 
        <main>
            <section id="heading">
                <h2>Chat with <span id="colored-text">WhatNext </span>Assistant</h2>
                <p>Ask me anything about <?php echo $major['name']; ?> major</p>
            </section>
            <section id="chatting">
                <div id="container">
                    <div id="toggle">
                        <h3>Where should we begin?</h3>
                        <div class="suggestion-cards">
                            <div class="message card"><p>What skills do I need in <?php echo $major['name']; ?>?</p></div>
                            <div class="message card"><p>What Jobs can I get after graduation in <?php echo $major['name']; ?>?</p></div>
                            <div class="message card"><p>What is the average annual salary for <?php echo $major['name']; ?> major?</p></div>
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