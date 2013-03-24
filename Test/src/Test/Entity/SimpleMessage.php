<?php

namespace Test\Entity;

class SimpleMessage
{
    /** @var string Subject's message */
    public $subject;

    /** @var string Message's content */
    public $message;

    /** @var int Send message's copy to sender */
    public $copy;

    /**
     * @param string $subject
     * @return Subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $copy
     * @return Copy
     */
    public function setCopy($copy)
    {
        $this->copy = $copy;
        return $this;
    }

    /**
     * @return string
     */
    public function getCopy()
    {
        return $this->copy;
    }
}