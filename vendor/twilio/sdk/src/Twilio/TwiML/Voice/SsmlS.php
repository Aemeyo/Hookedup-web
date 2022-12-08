<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\TwiML\Voice;

use Twilio\TwiML\TwiML;

class SsmlS extends TwiML {
    /**
     * SsmlS constructor.
     *
     * @param string $words Words to speak
     */
    public function __construct($words) {
        parent::__construct('s', $words);
    }
}