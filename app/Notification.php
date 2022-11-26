<?php

namespace App;

class Notification
{
    private $message = null;
    private $type = null;

    public function __construct($msg = null, $type = null)
    {
        $this->setMessage($msg);
        $this->setType($type);

        if ($msg) $this->notify();
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

    public function notify()
    {
        echo "<div id='notice-container'><span ";
        if ($this->type == "error") {
            echo "style='border-color: red'";
        } else if ($this->type == "success") {   
            echo "style='border-color: green'";
        };
        echo ">" . $this->message . "</span></div>";
    }
}