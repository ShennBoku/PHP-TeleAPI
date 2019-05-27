# PHP-TeleAPI

PHP TeleAPI adalah sebuah class PHP yang dapat memudahkan anda dalam membuat bot telegram

### Instalasi

Untuk dapat menggunakan fungsi ini, pertama-tama upload script TeleAPI dan TeleHook ke web anda dan buat bot telegram melalui [BotFather Telegram](https://t.me/BotFather) lalu copy Token-nya dan paste-kan pada script TeleAPI.
```
$TeleAPI = new TeleAPI('BOT TOKEN ANDA');
```

### Pemasangan Webhook

Untuk mengatur webhook, anda hanya perlu mengakses url seperti dibawah ini:
```
https://api.telegram.org/bot(TOKEN)/setWebhook?url=https://example.com/TeleHook.php&max_connections=80
```
* ganti **_https://example.com/_** menjadi alamat domain anda dan **_(TOKEN)_** menjadi Token BOT anda

## Authors

* **Afdhalul Ichsan Yourdan** - *Initial work* - [ShennBoku](https://github.com/ShennBoku)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
