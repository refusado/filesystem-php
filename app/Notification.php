<?php

namespace App;

class Notification
{
    private $message = null;
    private $type = null;

    public function __construct($msg = null, $type = null, $second = null, $secondType = null)
    {
        $this->setMessage($msg);
        $this->setType($type);

        if ($msg) $this->notify($second, $secondType);
    }

    public function setMessage($msg)
    {
        $this->message = $msg;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getType()
    {
        return $this->type;
    }

    public function notify($secondMessage, $secondType)
    {
        echo "<div id='notice-container'>";
        echo "  <span class='" . $this->type . "'>";
        echo        $this->message;
        echo "  </span>";
        echo "</div>";

        if (!$secondType) return;
        echo "<div id='second-notice-container'>";
        echo "  <span class='" . $secondType . "'>";
        echo        $secondMessage;
        echo "  </span>";
        echo "</div>";
    }
}