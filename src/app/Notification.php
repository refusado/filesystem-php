<?php

namespace App;

class Notification
{
    private $firstMessage = null;
    private $secondMessage = null;
    private $firstType = null;
    private $secondType = null;
    
    public function __construct($fMessage = null, $fType = null, $sMessage = null, $sType = null)
    {
        if ($fMessage) {
            $this->firstMessage = $fMessage;
            $this->firstType    = $fType;
        }
        if ($sMessage) {
            $this->secondMessage = $sMessage;
            $this->secondType = $sType;
        }

        $this->notify();
    }

    private function notify()
    {
        echo "<div class='notice-container'>";
        if ($this->firstMessage) {
            echo "  <span class='" . $this->firstType . "'>";
            echo        $this->firstMessage;
            echo "  </span>";
        }
        if ($this->secondMessage) {
            echo "  <span class='" . $this->secondType . "'>";
            echo        $this->secondMessage;
            echo "  </span>";
        }
        echo "</div>";
    }
}