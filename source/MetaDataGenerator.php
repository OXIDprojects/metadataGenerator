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
     * Returns the class files of the module.
     * @author jschuster <code@wbl-konzept.de>
     *
     * @return array with classes
     */
    protected function loadFilesOfModule()
    {
        $aClasses = $this->getPHPClassesOfFiles($this->getModulesDir() . $this->getModule()->getModulePath());

        return $aClasses;
    }


    /**
     * Iterates through every file in a folder and saves the result of the method getClassesOfFile in an array.
     * @author jschuster <code@wbl-konzept.de>
     * @param  string $sPath The module dir.
     *
     * @return array
     */
    function getPHPClassesOfFiles($sPath)
    {
        $oDirs = new RecursiveDirectoryIterator($sPath, FilesystemIterator::SKIP_DOTS);
        $oIterater = new RecursiveIteratorIterator($oDirs);
        $aClasses = array();
        $sModuleDir = $this->getModulesDir();

        foreach ($oIterater as $oFilePath) {
            $sFilePath = (string)$oFilePath;
            $sRelativeFilePath = str_replace($sModuleDir, '', $sFilePath);

            if ($aNames = $this->getClassesOfFile($sFilePath)) {
                foreach ($aNames as $sName) {
                    $aClasses[$sName] = $sRelativeFilePath;
                }
            }
        }

        return $aClasses;
    }


    /**
     * Returns the class names of a file.
     * @author jschuster <code@wbl-konzept.de>
     * @param string $sFilePath The path to a file.
     *
     * @return array
     */
    function getClassesOfFile($sFilePath)
    {
        $oContent = file_get_contents($sFilePath);
        $aClasses = array();
        $aTokens = token_get_all($oContent);

        if ($aTokens) {
            foreach ($aTokens as $iIndex => $aToken) {
                if (($aToken[0] === T_CLASS) && ($aTokens[$iIndex + 2][0] === T_STRING)) {
                    $aClasses[] = $aTokens[$iIndex + 2][1];

                }
            }
        }

        return $aClasses;
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
        $oMetaDataFile->setFiles($this->loadFilesOfModule());
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