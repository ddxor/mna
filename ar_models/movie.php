<?php

namespace Mna\ActiveRecord;

use Mna\Exception\MemberFunctionException;

class Movie extends Base
{
    protected $_title;
    protected $_runtime;
    protected $_releaseDate;

    /** Overriding base _jsonPropertiesMap to add support for title, runtime and releaseDate parameters. */
    protected $_jsonPropertiesMap = [
        'title' => 'getTitle',
        'runtime' => 'getRuntime',
        'releaseDate' => 'getReleaseDate',
    ];

    /**
     * Convenience function to access protected property _title.
     *
     * @author  James Anslow <return.404@gmail.com>
     * @return  string the title of the movie, or null if this movie has no title.
     */
    public function getTitle(): string
    {
        return $this->_title;
    }

    /**
     * Sets the _title property of this object according to the given parameter $name.
     *
     * @author  James Anslow <return.404@gmail.com>
     * @param   string $title the title property which will be set.
     * @return  object $this so that we can chain setters.
     */
    public function setTitle(string $title): object
    {
        $this->_title = $title;

        return $this;
    }

    /**
     * Convenience function to access protected property _runtime.
     *
     * @author  James Anslow <return.404@gmail.com>
     * @return  integer the runtime of the movie, or null if this movie has no runtime.
     */
    public function getRuntime(): integer
    {
        return $this->_runtime;
    }

    /**
     * Sets the _runtime property of this object according to the given parameter $runtime.
     *
     * @author  James Anslow <return.404@gmail.com>
     * @param   integer $runtime the runtime property which will be set.
     * @return  object $this so that we can chain setters.
     */
    public function setRuntime(integer $runtime): object
    {
        $this->_runtime = $runtime;

        return $this;
    }

    /**
     * Convenience function to access protected property _releaseDate.
     *
     * @author  James Anslow <return.404@gmail.com>
     * @param   mixed $stringFormat the format of the returned releaseDate string. null will return the default format.
     * @return  string the release date of the movie, or an empty string if this movie has no release date.
     */
    public function getReleaseDate($stringFormat = 'd/n/Y'): string
    {
        $releaseDate = '';

        if ($this->_releaseDate && $this->_releaseDate instanceof DateTime) {
            $releaseDate = $this->_releaseDate->format($stringFormat);
        }

        return $releaseDate;
    }

    /**
     * Sets the _releaseDate property of this object.
     *
     * @author  James Anslow <return.404@gmail.com>
     * @param   mixed $releaseDate - the releaseDate to set as a date string, timestamp or DateTime object.
     * @return  Object $this so that we can chain setters.
     * @throws  MemberFunctionException
     */
    public function setReleaseDate($releaseDate): object
    {
        if (!$releaseDate) {
            throw new MemberFunctionException('Called setReleaseDate but passed no $releaseDate param');
        }

        if (is_int($releaseDate)) {
            $this->_releaseDate = new DateTime('@' . $releaseDate);
        }

        if (is_string($releaseDate)) {
            $strReleaseDate = strtotime($releaseDate);

            if ($strReleaseDate) {
                $this->_releaseDate = new DateTime('@' . $strReleaseDate);
            }
        }

        if ($releaseDate instanceof DateTime) {
            $this->_releaseDate = $releaseDate;
        }

        return $this;
    }
}
