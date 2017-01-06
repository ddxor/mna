<?php

namespace Mna\Exception;

abstract class BaseException extends \Exception implements IException
{
    CONST ROLLBAR_ACCESS_TOKEN = '1bf08349f0694732816ba0a93dda3891';
    CONST DEFAULT_CODE = 0;
    CONST ERROR_CODE_MEMBER_FUNCTION = 1;
    CONST ERROR_CODE_COLLECTION = 2;

    protected static $customCode;
    protected $message;
    protected $file;
    protected $line;
    protected $code;

    public function __construct($message = null, $code = 0)
    {
        $this->code = $code;
        $this->message = $message;

        /**
         * If $code is the default code and a child class has late static binded a custom code; make that late static
         * binded one take precedent.
         */
        if ($this->code == self::DEFAULT_CODE && static::$customCode) {
            $this->code = static::$customCode;
        }

        if (!$message) {
            throw new $this('Unknown ' . get_class($this));
        }

        parent::__construct($this->message, $this->code);

        $this->_reportToRollbar();
    }

    /**
     * Send an exception notification to the rollbar.com service for universal, hassle free exception tracking.
     *
     * @author James Anslow <return.404@gmail.com>
     */
    protected function _reportToRollbar()
    {
        \Rollbar::init(
            [
                'access_token' => self::ROLLBAR_ACCESS_TOKEN,
            ]
        );

        \Rollbar::report_exception($this);
    }

    public function __toString()
    {
        return get_class($this) . $this->message . ' in ' . $this->file . '(' . $this->line . ')\n'
            . $this->getTraceAsString();
    }
}
