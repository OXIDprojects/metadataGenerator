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

require_once dirname( __FILE__ ) . "/../source/MetaDataGenerator.php";

class MetaDataGeneratorTest extends PHPUnit_Framework_TestCase
{
    public function testGetMetaDataPath_Constructor()
    {
        $module = $this->getMock('oxModule', array('getModulePath'));

        $module->expects($this->any())
            ->method('getModulePath')
            ->will($this->returnValue('modulePath'));

        $generator = new MetaDataGenerator($module, 'modules/' );
        $this->assertSame('modules/modulePath/metadata.php', $generator->getMetaDataPath());
    }

    public function testGetMetaDataPath_Set()
    {
        $module = $this->getMock('oxModule', array('getModulePath'));

        $module->expects($this->any())
            ->method('getModulePath')
            ->will($this->returnValue('modulePath'));

        $generator = new MetaDataGenerator($module, 'modules/' );
        $generator->setModulesDir('otherDir/');
        $this->assertSame('otherDir/modulePath/metadata.php', $generator->getMetaDataPath());
    }

    public function testGetModulesDir_Set()
    {
        $module = $this->getMock('oxModule');

        $metaData = new MetaDataGenerator($module, 'modules/');
        $metaData->setModulesDir('folder/');

        $this->assertSame('folder/', $metaData->getModulesDir());
    }

    public function testGetModule_Set()
    {
        $module = $this->getMock('oxModule');
        $metaData = new MetaDataGenerator($module, 'modules/');
        unset($module);

        $module2 = $this->getMock('oxModule');
        $metaData->setModule($module2);
        $this->assertSame($module2, $metaData->getModule());
    }
}