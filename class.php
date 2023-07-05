<?php

class TelegramBot {
    private $apiUrl;
    private $botToken;

    public function __construct($botToken) {
        $this->botToken = $botToken;
        $this->apiUrl = 'https://api.telegram.org/bot' . $botToken . '/';
    }

    public function sendMessage($chatId, $text, $options = array()) {
        $data = array(
            'chat_id' => $chatId,
            'text' => $text
        );

        $data = array_merge($data, $options);

        $this->sendRequest('sendMessage', $data);
    }

    public function editMessageText($chatId, $messageId, $text, $options = array()) {
        $data = array(
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'text' => $text
        );

        $data = array_merge($data, $options);

        $this->sendRequest('editMessageText', $data);
    }

    public function sendPhoto($chatId, $photo, $options = array()) {
        $data = array(
            'chat_id' => $chatId,
            'photo' => $photo
        );

        $data = array_merge($data, $options);

        $this->sendRequest('sendPhoto', $data);
    }

    public function sendAudio($chatId, $audio, $options = array()) {
        $data = array(
            'chat_id' => $chatId,
            'audio' => $audio
        );

        $data = array_merge($data, $options);

        $this->sendRequest('sendAudio', $data);
    }

    public function sendDocument($chatId, $document, $options = array()) {
        $data = array(
            'chat_id' => $chatId,
            'document' => $document
        );

        $data = array_merge($data, $options);

        $this->sendRequest('sendDocument', $data);
    }


    // Diğer API özelliklerini buraya ekleyebilirsiniz

    // ...

    public function sendRequest($method, $data = array()) {
        $url = $this->apiUrl . $method;
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type: multipart/form-data',
                'content' => $data
            )
        );

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        return json_decode($result, true);
    }
}

// Kullanım örneği:
$botToken = 'your_bot_token';
$telegramBot = new TelegramBot($botToken);

// Örnek mesaj gönderimi
$chatId = 'your_chat_id';
$message = 'Merhaba, Dünya!';
$telegramBot->sendMessage($chatId, $message);

// Mesaj düzenleme
$messageId = 'your_message_id';
$newMessage = 'Yeni mesaj metni';
$telegramBot->editMessageText($chatId, $messageId, $newMessage);

// Build komutu gönderme
$projectName = 'my_project';
$version = '1.0.0';
$telegramBot->sendBuildCommand($chatId, $projectName, $version);

// Diğer API özelliklerini kullanmak için sınıfın ilgili metodlarını çağırabilirsiniz
// Örneğin: $telegramBot->sendPhoto(), $telegramBot->sendAudio(), vb.
