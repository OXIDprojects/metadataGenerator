<?php
/**
 * This file is part of OXID eSales metadata generator.
 *
 * OXID eSales metadata generator is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OXID eSales metadata generator is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with OXID eSales metadata generator.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      http://www.oxid-esales.com
 * @copyright (C) OXID eSales AG 2003-2014
 */

class File {

    /**
     * File path
     *
     * @var string
     */
    private $_filePath = '';

    /**
     * File Content
     *
     * @var null
     */
    private $_content = null;

    /**
     * File content setter
     *
     * @param null $content
     */
    public function setContent( $content )
    {
        $this->_content = $content;
    }

    /**
     * Returns file content
     *
     * @return null
     */
    public function getContent()
    {
        return $this->_content;
    }

    function __construct( $sFilePath )
    {
        $this->_filePath = $sFilePath;
    }

    /**
     * File path setter.
     *
     * @param string $sFilePath
     */
    public function setPath( $sFilePath )
    {
        $this->_filePath = $sFilePath;
    }

    /**
     * Returns path to file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->_filePath;
    }

    /**
     * Store file to file system.
     */
    public function save()
    {
        $file = fopen( $this->getPath(), "w" );
        flock( $file, LOCK_EX );
        fwrite( $file, $this->getContent() );
        flock( $file, LOCK_UN );
        fclose( $file );
    }
}