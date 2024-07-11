document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        showChatBot();
    }, 3000);

    function showChatBot() {
        var chatBotContainer = document.createElement("div");
        chatBotContainer.id = "chat-bot-container";
        chatBotContainer.style.position = "fixed";
        chatBotContainer.style.bottom = "20px";
        chatBotContainer.style.left = "20px";
        chatBotContainer.style.background = "#ffffff";
        chatBotContainer.style.border = "1px solid #ccc";
        chatBotContainer.style.padding = "10px";
        chatBotContainer.style.boxShadow = "0 0 10px rgba(0, 0, 0, 0.1)";
        chatBotContainer.style.zIndex = "9999";

        var closeButton = document.createElement("span");
        closeButton.textContent = "✖";
        closeButton.style.position = "absolute";
        closeButton.style.top = "5px";
        closeButton.style.right = "5px";
        closeButton.style.cursor = "pointer";
        closeButton.addEventListener("click", closeChatBot);
        chatBotContainer.appendChild(closeButton);

        var chatBotMessage = document.createElement("div");
        chatBotMessage.textContent = "Привет! Чем я могу помочь?";
        chatBotContainer.appendChild(chatBotMessage);

        var userQuestionInput = document.createElement("input");
        userQuestionInput.type = "text";
        userQuestionInput.placeholder = "Задайте свой вопрос";
        chatBotContainer.appendChild(userQuestionInput);

        var sendButton = document.createElement("button");
        sendButton.textContent = "Отправить";
        sendButton.addEventListener("click", function () {
            handleUserQuestion(userQuestionInput.value);
        });
        chatBotContainer.appendChild(sendButton);

        var chatBotAnswers = document.createElement("div");
        chatBotAnswers.id = "chat-bot-answers";
        chatBotContainer.appendChild(chatBotAnswers);

        var clearButton = document.createElement("button");
        clearButton.textContent = "Очистить диалог";
        clearButton.addEventListener("click", clearDialog);
        chatBotContainer.appendChild(clearButton);

        document.body.appendChild(chatBotContainer);
    }

    function handleUserQuestion(userQuestion) {
        var chatBotContainer = document.getElementById("chat-bot-container");

        clearDialog();

        var userMessage = document.createElement("div");
        userMessage.textContent = "Вы: " + userQuestion;
        chatBotContainer.appendChild(userMessage);

        fetch(`get_faq.php?question=${encodeURIComponent(userQuestion.toLowerCase())}`)
            .then(response => response.json())
            .then(data => {
                var botMessage = document.createElement("div");
                botMessage.textContent = "Бот: " + data.answer;
                chatBotContainer.appendChild(botMessage);
            })
            .catch(error => {
                var botMessage = document.createElement("div");
                botMessage.textContent = "Бот: Произошла ошибка. Пожалуйста, попробуйте позже.";
                chatBotContainer.appendChild(botMessage);
                console.error('Error:', error);
            });

        userQuestionInput.value = "";
    }

    function clearDialog() {
        var chatBotContainer = document.getElementById("chat-bot-container");
        var messages = chatBotContainer.querySelectorAll(":scope > div");
        messages.forEach(function (message) {
            if (message.textContent.includes("Вы:") || message.textContent.includes("Бот:")) {
                message.remove();
            }
        });
    }

    function closeChatBot() {
        var chatBotContainer = document.getElementById("chat-bot-container");
        chatBotContainer.style.display = "none";
    }
});
