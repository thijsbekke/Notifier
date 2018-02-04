# Notifier
An PHP Client for different notifier services


```PHP 
require_once __DIR__ . '/vendor/autoload.php'; 

//Notificeer de group
$noti = new \Notifier\Clients\Pushover("<my user/group key");
$noti->message("Whoop whoop");
$noti->image('tests/assets/rabbit.jpg');
$noti->sound('incoming');
$noti->send();
```

