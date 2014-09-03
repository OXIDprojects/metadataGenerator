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

class MetaData {

    /**
     * Module extensions
     *
     * @var array
     */
    private $_extensions = array();

    /**
     * Files array.
     *
     * @var array
     */
    private $_files = array();

    /**
     * Module id
     *
     * @var string
     */
    private $_moduleId = '';

    /**
     * Returns the files array.
     *
     * @return array
     */
    public function getFiles()
    {
        return $this->_files;
    }

    /**
     * Sets the files array.
     *
     * @param array $files
     * @return void
     */
    public function setFiles(array $files)
    {
        $this->_files = $files;
    }

    /**
     * Module id setter
     *
     * @param string $moduleId
     */
    public function setModuleId( $moduleId )
    {
        $this->_moduleId = $moduleId;
    }

    /**
     * Module id getter
     *
     * @return string
     */
    public function getModuleId()
    {
        return $this->_moduleId;
    }

    /**
     * Module extensions setter
     *
     * @param array $extensions
     */
    public function setExtensions( $extensions )
    {
        $this->_extensions = $extensions;
    }

    /**
     * Module extensions getter
     *
     * @return array
     */
    public function getExtensions()
    {
        return $this->_extensions;
    }

    /**
     * Constructor
     *
     * @param string $moduleId module id
     */
    public function __construct( $moduleId )
    {
        $this->setModuleId( $moduleId );
    }

    /**
     * Create and returns meta data file content
     *
     * @return string
     */
    public function getContent()
    {
        $content = "<?php \n";
        $content .= "\$sMetadataVersion = '1.1'; \n";

        $metaDataInfo = array(
            'id'           => $this->getModuleId(),
            'title'        => 'Title ' . $this->getModuleId(),
            'description'  => 'Description ' . $this->getModuleId(),
            'thumbnail'    => 'picture.png',
            'version'      => '1.0',
            'author'       => 'Author',
            'extend'       => $this->getExtensions(),
            'files'        => $this->getFiles(),
            'blocks'       => array(),
            'settings'     => array(),
            'templates'    => array(),
            'events'       => array()
        );

        $content .= "\$aModule = " . var_export($metaDataInfo, true) . ";";

        return $content;
    }
} 