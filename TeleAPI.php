<?php
/*
.---------------------------------------------------------------------------.
|  Software: PHP TeleAPI - PHP Telegram Class                               |
|   Version: 2.1                                                            |
|   Release: March 29, 2019 (23:17 WIB)                                     |
|    Update: May 12, 2019 (01:33 WIB)                                       |
|                                                                           |
|      Copyright © 2019, Afdhalul Ichsan Yourdan. All Rights Reserved.      |
| ------------------------------------------------------------------------- |
| Hubungi Saya:                                                             |
| - Facebook - Afdhalul Ichsan Yourdan - https://facebook.com/shennboku     |
| - Instagram - ShennBoku - https://instagram.com/shennboku                 |
| - WhatsApp - 0878 7954 2355 - 0822 1158 2471                              |
'---------------------------------------------------------------------------'
*/

class TeleAPI {
    private $token;
    
    public function __construct($token)
    {
        $this->token = $token;
    }
    
    private function stream($command,$value)
    {
        $context = stream_context_create([
            'http' => [
                'header' => [
                    'Content-type: application/x-www-form-urlencoded'
                ],
                'method' => 'POST',
                'content' => http_build_query($value)
            ]
        ]);
        return file_get_contents('https://api.telegram.org/bot'.$this->token.'/'.$command, false, $context);
    }
    
    private function curl($command,$value)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.telegram.org/bot'.$this->token.'/'.$command);
        curl_setopt($ch, CURLOPT_POST, count($value));
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($value));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $chresult = curl_exec($ch);
        curl_close ($ch);
        return $chresult;
    }
    
    /* Result Beauty Hook
        {
        "timestamp": "25-03-2019 16:25:40",
        "from": {
            "id": "123XXX",
            "name": "Afdhalul Ichsan Yourdan",
            "username": "ShennBoku" },
        "chat": {
            "id": "822115",
            "text": "Halo, ini contoh text :)",
            "type": "private" // Private or Group }
        }
    */
    public function beautyHook($json)
    {
        date_default_timezone_set('Asia/Jakarta');
        $val = $json['message'];
        $beautify = ['timestamp' => date('Y-m-d H:i:s', $val['date']),
            'from' => ['id' => $val['from']['id'],'name' => $val['from']['first_name'].' '.$val['from']['last_name'],'username' => $val['from']['username']],
            'chat' => ['id' => $val['chat']['id'],'text' => $val['text'],'type' => $val['chat']['type']]
        ];
        return $beautify;
    }
    
    /*
      Anda dapat melihat semua metode di:
      https://core.telegram.org/bots/api#available-methods
      
      function dibawah akan mengeluarkan result (true / false) dan data (message id bila sukses)
    */
    
    public function sendMessage($cid,$msg)
    {
        if(is_callable('curl_init')) {
            $out = $this->curl('sendMessage',['chat_id' => $cid,'text' => $msg]);
            if(!$out) $out = $this->stream('sendMessage',['chat_id' => $cid,'text' => $msg]);
        } else {
            $out = $this->stream('sendMessage',['chat_id' => $cid,'text' => $msg]);
        }
        $json = json_decode($out, true);
        return ['result' => $json['ok'],'data' => $json['description'].$json['result']['message_id']];
    }
    
    public function sendPhoto($cid,$pic,$msg)
    {
        if(is_callable('curl_init')) {
            $out = $this->curl('sendPhoto',['chat_id' => $cid,'photo' => $pic,'caption' => $msg]);
            if(!$out) $out = $this->stream('sendPhoto',['chat_id' => $cid,'photo' => $pic,'caption' => $msg]);  
        } else {
            $out = $this->stream('sendPhoto',['chat_id' => $cid,'photo' => $pic,'caption' => $msg]);
        }
        $json = json_decode($out, true);
        return ['result' => $json['ok'],'data' => $json['description'].$json['result']['message_id']];
    }
    
    public function sendAudio($cid,$audio,$msg)
    {
        if(is_callable('curl_init')) {
            $out = $this->curl('sendAudio',['chat_id' => $cid,'audio' => $audio,'caption' => $msg]);
            if(!$out) $out = $this->stream('sendAudio',['chat_id' => $cid,'audio' => $audio,'caption' => $msg]);  
        } else {
            $out = $this->stream('sendAudio',['chat_id' => $cid,'audio' => $audio,'caption' => $msg]);
        }
        $json = json_decode($out, true);
        return ['result' => $json['ok'],'data' => $json['description'].$json['result']['message_id']];
    }
    
    public function sendDocument($cid,$doc,$thumb,$msg)
    {
        if(is_callable('curl_init')) {
            $out = $this->curl('sendDocument',['chat_id' => $cid,'document' => $doc,'thumb' => $thumb,'caption' => $msg]);
            if(!$out) $out = $this->stream('sendDocument',['chat_id' => $cid,'document' => $doc,'thumb' => $thumb,'caption' => $msg]);
        } else {
            $out = $this->stream('sendDocument',['chat_id' => $cid,'document' => $doc,'thumb' => $thumb,'caption' => $msg]);
        }
        $json = json_decode($out, true);
        return ['result' => $json['ok'],'data' => $json['description'].$json['result']['message_id']];
    }
    
    public function sendVideo($cid,$vid,$thumb,$msg)
    {
        if(is_callable('curl_init')) {
            $out = $this->curl('sendVideo',['chat_id' => $cid,'video' => $vid,'thumb' => $thumb,'caption' => $msg]);
            if(!$out) $out = $this->stream('sendVideo',['chat_id' => $cid,'video' => $vid,'thumb' => $thumb,'caption' => $msg]);
        } else {
            $out = $this->stream('sendVideo',['chat_id' => $cid,'video' => $vid,'thumb' => $thumb,'caption' => $msg]);
        }
        $json = json_decode($out, true);
        return ['result' => $json['ok'],'data' => $json['description'].$json['result']['message_id']];
    }
    
    public function sendAnimation($cid,$animation,$thumb,$msg)
    {
        if(is_callable('curl_init')) {
            $out = $this->curl('sendAnimation',['chat_id' => $cid,'animation' => $animation,'thumb' => $thumb,'caption' => $msg]);
            if(!$out) $out = $this->stream('sendAnimation',['chat_id' => $cid,'animation' => $animation,'thumb' => $thumb,'caption' => $msg]);
        } else {
            $out = $this->stream('sendAnimation',['chat_id' => $cid,'animation' => $animation,'thumb' => $thumb,'caption' => $msg]);
        }
        $json = json_decode($out, true);
        return ['result' => $json['ok'],'data' => $json['description'].$json['result']['message_id']];
    }
    
    public function sendVoice($cid,$audio,$msg)
    {
        if(is_callable('curl_init')) {
            $out = $this->curl('sendVoice',['chat_id' => $cid,'voice' => $audio,'caption' => $msg]);
            if(!$out) $out = $this->stream('sendVoice',['chat_id' => $cid,'voice' => $audio,'caption' => $msg]);
        } else {
            $out = $this->stream('sendVoice',['chat_id' => $cid,'voice' => $audio,'caption' => $msg]);
        }
        $json = json_decode($out, true);
        return ['result' => $json['ok'],'data' => $json['description'].$json['result']['message_id']];
    }
    
    public function sendVideoNote($cid,$vidnote,$thumb)
    {
        if(is_callable('curl_init')) {
            $out = $this->curl('sendVideoNote',['chat_id' => $cid,'video_note' => $vidnote,'thumb' => $thumb]);
            if(!$out) $out = $this->stream('sendVideoNote',['chat_id' => $cid,'video_note' => $vidnote,'thumb' => $thumb]);
        } else {
            $out = $this->stream('sendVideoNote',['chat_id' => $cid,'video_note' => $vidnote,'thumb' => $thumb]);
        }
        $json = json_decode($out, true);
        return ['result' => $json['ok'],'data' => $json['description'].$json['result']['message_id']];
    }
    
    public function sendMediaGroup($cid,$media)
    {
        if(is_callable('curl_init')) {
            $out = $this->curl('sendMediaGroup',['chat_id' => $cid,'media' => $media]);
            if(!$out) $out = $this->stream('sendMediaGroup',['chat_id' => $cid,'media' => $media]); 
        } else {
            $out = $this->stream('sendMediaGroup',['chat_id' => $cid,'media' => $media]);
        }
        $json = json_decode($out, true);
        return ['result' => $json['ok'],'data' => $json['description'].$json['result']['message_id']];
    }
    
    public function sendLocation($cid,$lat,$long)
    {
        if(is_callable('curl_init')) {
            $out = $this->curl('sendLocation',['chat_id' => $cid,'latitude' => $lat,'longitude' => $long]);
            if(!$out) $out = $this->stream('sendLocation',['chat_id' => $cid,'latitude' => $lat,'longitude' => $long]);
        } else {
            $out = $this->stream('sendLocation',['chat_id' => $cid,'latitude' => $lat,'longitude' => $long]);
        }
        $json = json_decode($out, true);
        return ['result' => $json['ok'],'data' => $json['description'].$json['result']['message_id']];
    }
    
    public function sendContact($cid,$phone,$fname,$lname)
    {
        if(is_callable('curl_init')) {
            $out = $this->curl('sendContact',['chat_id' => $cid,'phone_number' => $phone,'first_name' => $fname,'last_name' => $lname]);
            if(!$out) $out = $this->stream('sendContact',['chat_id' => $cid,'phone_number' => $phone,'first_name' => $fname,'last_name' => $lname]);
        } else {
            $out = $this->stream('sendContact',['chat_id' => $cid,'phone_number' => $phone,'first_name' => $fname,'last_name' => $lname]);
        }
        $json = json_decode($out, true);
        return ['result' => $json['ok'],'data' => $json['description'].$json['result']['message_id']];
    }
    
}