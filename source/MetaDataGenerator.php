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

class MetaDataGenerator {

    /**
     * Path where to module folder
     *
     * @var string
     */
    private $_modulesDir = '';

    /**
     * Module entity
     *
     * @var oxModule
     */
    private $_module = null;


    /**
     * Constructor
     *
     * @param oxModule $module module
     * @param string $modulesDir string folder
     */
    function __construct(oxModule $module, $modulesDir)
    {
        $this->setModule($module);
        $this->setModulesDir($modulesDir);
    }

    /**
     * Module setter.
     *
     * @param oxModule $module module entity
     */
    public function setModule(oxModule $module)
    {
        $this->_module = $module;
    }

    /**
     * Returns module.
     *
     * @return oxModule
     */
    public function getModule()
    {
        return $this->_module;
    }

    /**
     * Module storage place folder setter.
     *
     * @param string $moduleDir path to folder
     */
    public function setModulesDir($moduleDir)
    {
        $this->_modulesDir = $moduleDir;
    }

    /**
     * Returns folder where modules stored.
     *
     * @return string
     */
    public function getModulesDir()
    {
        return $this->_modulesDir;
    }

    /**
     * Generates metadata.php file in file system.
     */
    public function generate()
    {
        $oMetaDataFile = new MetaData($this->getModule()->getId());
        $oMetaDataFile->setExtensions($this->getModule()->getExtensions());

        $oFile = new File($this->getMetaDataPath());
        $oFile->setContent($oMetaDataFile->getContent());
        $oFile->save();
    }

    /**
     * Returns metadata.php file path.
     *
     * @return string
     */
    public function getMetaDataPath()
    {
        return $this->getModulesDir() . $this->getModule()->getModulePath() . '/metadata.php';
    }
}