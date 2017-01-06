<?php

namespace Mna\Exception;

/**
 * Interface IException - an interface to ensure that exception methods are implemented properly.
 *
 * @author James Anslow <return.404@gmail.com>
 */
interface IException
{
    public function __construct($message = null, $code = 0);

    public function getMessage();

    public function getCode();

    public function getFile();

    public function getLine();

    public function getTrace();

    public function getTraceAsString();

    public function __toString();
}
