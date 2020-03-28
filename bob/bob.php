<?php

class Bob {

    private const CASE_YELLING = 1;

    private const CASE_QUESTION = 2;

    private const CASE_YELLING_QUESTION = 3;

    private const CASE_ANYTHING = 4;

    private const CASE_NOT_VALID = 0;

    /**
     * @param string $assertion
     * @return string
     */
    public function respondTo( string $assertion ): string {

        $type = $this->calculateAssertionType(trim($assertion));

        return $this->getResponse($type);
    }

    private function calculateAssertionType( string $assertion ): int {
        if( empty( $assertion) ) {
            return self::CASE_ANYTHING;
        }

        if( $this->isQuestion($assertion) && $this->isYelling($assertion)) {
            return self::CASE_YELLING_QUESTION;
        }

        if( $this->isQuestion($assertion) ) {
            return self::CASE_QUESTION;
        }

        if( $this->isYelling($assertion) ){
            return self::CASE_YELLING;
        }

        return self::CASE_NOT_VALID;
    }

    private function isYelling(string $assertion): bool {
        return mb_strtoupper($assertion) === $assertion && strtolower($assertion) !== $assertion;
    }

    private function isQuestion(string $assertion): bool {
        return '?' === substr($assertion, -1);
    }

    private function getResponse( int $type ): string {
        switch ($type){
            case self::CASE_YELLING:
                return 'Whoa, chill out!';
            case self::CASE_QUESTION:
                return 'Sure.';
            case self::CASE_YELLING_QUESTION:
                return 'Calm down, I know what I\'m doing!';
            case self::CASE_ANYTHING:
                return 'Fine. Be that way!';
        }

        return 'Whatever.';
    }
}