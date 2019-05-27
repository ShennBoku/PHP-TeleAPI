<?php
// Contoh script webhook untuk mendapatkan pesan

require_once 'TeleAPI.php';
$TeleAPI = new TeleAPI(''); // Isi Bot Token anda!

$webhook = json_decode(file_get_contents("php://input"), true);
$beautify = $TeleAPI->beautyHook($json_result);
$from = $beautify['from'];
$chat = $beautify['chat'];

if(isset($beautify['chat']['text'])) {
    $message = "Timestamp: ".$beautify['timestamp']."\nFrom ID: ".$from['id']."\nFrom Name: ".$from['name']."\nFrom Username: ".$from['username']."\n";
    $message2 = "Chat Id: ".$chat['id']."\nChat Text: ".$chat['text']."\nChat Type: ".$chat['type'];
    $TeleAPI->sendMessage($chat['id'],$message.$message2);
}
