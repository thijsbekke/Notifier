<?php
/**
 * Created by PhpStorm.
 * User: Thijs
 * Date: 10-12-2017
 * Time: 19:39
 */

namespace Notifier\Clients;

class Pushover
{

    const LOWEST = -2;
    const LOW = -1;
    const DEFAULT = 0;
    const HIGH = 1;

    private $token = 'aphifcn3xhstj35c9t79pdegpqf7c9';
    private $user = '';
    private $options = [];

    public function __construct($user)
    {
        if (empty($user)) {
            throw new \InvalidArgumentException('Key is empty');
        }

        $this->user = $user;
    }

    public function message($message)
    {
        $this->options['message'] = $message;
    }

    public function image($image)
    {
        $mime = mime_content_type($image);
        if(substr($mime, 0, 5) != 'image') {
            return;
        }

        if(!empty($image)) {
            $this->options['attachment'] = curl_file_create($image, $mime,'attachment');
        }
    }

    private function getMessage()
    {
        if (!isset($this->options['message'])) {
            return 'All hail Thijs!';
        }
        return $this->options['message'];
    }

    public function device($devices)
    {
        $this->options['device'] = implode(',', $devices);
    }

    public function title($title)
    {
        $this->options['title'] = $title;
    }

    public function url($url, $title)
    {
        $this->options['url'] = $url;
        $this->options['url_title'] = $title;

    }

    public function priority($priority)
    {

        if ($priority == 2) {
            throw new \InvalidArgumentException('Priority 2 is not supported');
        }
        $this->options['priority'] = $priority;
    }


    public function datetime(\DateTime $dateTime)
    {
        $this->options['timestamp'] = $dateTime->getTimestamp();
    }

    public function sound($sound)
    {
        $this->options['sound'] = $sound;
    }


    public function send()
    {
        $this->options['token'] = $this->token;
        $this->options['user'] = $this->user;
        $this->options['message'] = $this->getMessage();

        curl_setopt_array($ch = curl_init(), [
                CURLOPT_URL => "https://api.pushover.net/1/messages.json",
                CURLOPT_POSTFIELDS => $this->options,
            ]
        );
        curl_exec($ch);
        curl_close($ch);
    }


}

