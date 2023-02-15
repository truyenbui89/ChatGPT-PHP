<!DOCTYPE html>
<html>
<head>
	<title>ChatGPT Example</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			padding: 20px;
		}
		#chatbox {
			height: 300px;
			overflow: auto;
			border: 1px solid #ccc;
			padding: 10px;
			margin-bottom: 10px;
		}
		input[type="text"] {
			padding: 10px;
			font-size: 16px;
			border: 1px solid #ccc;
			width: 100%;
		}
		input[type="submit"] {
			padding: 10px 20px;
			font-size: 16px;
			background-color: #337ab7;
			color: #fff;
			border: none;
			cursor: pointer;
		}
		input[type="submit"]:hover {
			background-color: #286090;
		}
	</style>
</head>
<body>
	<h1>ChatGPT Example</h1>
	<div id="chatbox"></div>
	<form id="chatform" onsubmit="sendMessage(); return false;">
		<input type="text" id="message" placeholder="Type your message here...">
		<input type="submit" value="Send">
	</form>

	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script>
		const API_KEY = "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";
		const API_URL = "https://api.openai.com/v1/engine/davinci-codex/completions";
		const chatbox = document.getElementById("chatbox");
		const messageInput = document.getElementById("message");

		function sendMessage() {
			const message = messageInput.value;
			if (message) {
				chatbox.innerHTML += "<p>You: " + message + "</p>";
				messageInput.value = "";
				axios.post(API_URL, {
					prompt: "Conversation with ChatGPT:\nUser: " + message + "\nChatGPT:",
					max_tokens: 60,
					temperature: 0.7,
					api_key: API_KEY
				}).then(response => {
					const chatGPTMessage = response.data.choices[0].text.trim();
					chatbox.innerHTML += "<p>ChatGPT: " + chatGPTMessage + "</p>";
					chatbox.scrollTop = chatbox.scrollHeight;
				}).catch(error => {
					console.log(error);
				});
			}
		}
	</script>
</body>
</html>
