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
}