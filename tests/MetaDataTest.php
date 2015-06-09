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

require_once dirname( __FILE__ ) . "/../source/MetaData.php";

class MetaDataTest extends PHPUnit_Framework_TestCase
{
    public function testGetFiles()
    {
        $metaData = new MetaData('moduleId');

        $this->assertSame(array(), $metaData->getFiles());

        $testArray = array(uniqid());
        $metaData->setFiles($testArray);

        $this->assertSame($testArray, $metaData->getFiles());
    } // function

    public function testGetModuleId_Constructor()
    {
        $metaData = new MetaData('moduleId');
        $this->assertSame('moduleId', $metaData->getModuleId());
    }

    public function testGetModuleId_Set()
    {
        $metaData = new MetaData('moduleId');
        $metaData->setModuleId('moduleId2');
        $this->assertSame('moduleId2', $metaData->getModuleId());
    }

    public function testGetExtensionsNotSet()
    {
        $metaData = new MetaData('moduleId');
        $this->assertSame(array(), $metaData->getExtensions());
    }

    public function testGetExtensions_Set()
    {
        $metaData = new MetaData('moduleId');
        $metaData->setExtensions(array('file' => 'extendPath'));
        $this->assertSame(array('file' => 'extendPath'), $metaData->getExtensions());
    }

    public function testGetContent_WithExtensionsAndFiles()
    {
        $expectedContent = "
            <?php
                \$sMetadataVersion = '1.1';
                \$aModule = array (
                  'id' => 'moduleId',
                  'title' => 'Title moduleId',
                  'description' => 'Description moduleId',
                  'thumbnail' => 'picture.png',
                  'version' => '1.0',
                  'author' => 'Author',
                  'extend' =>
                  array (
                    'file' => 'extendPath',
                  ),
                  'files' =>
                  array (
                    'foo' => 'bar', 'bar' => 'baz',
                  ),
                  'blocks' =>
                  array (
                  ),
                  'settings' =>
                  array (
                  ),
                  'templates' =>
                  array (
                  ),
                  'events' =>
                  array (
                  ),
                );
        ";

        $metaData = new MetaData('moduleId');
        $metaData->setExtensions( array('file' => 'extendPath') );
        $metaData->setFiles(array('foo' => 'bar', 'bar' => 'baz'));

        $this->assertEquals(preg_replace('/\s+/', '', $expectedContent), preg_replace('/\s+/', '',$metaData->getContent()));
    }

    public function testGetContent_WithoutExtensions()
    {
        $expectedContent = "
            <?php
                \$sMetadataVersion = '1.1';
                \$aModule = array (
                  'id' => 'moduleId',
                  'title' => 'Title moduleId',
                  'description' => 'Description moduleId',
                  'thumbnail' => 'picture.png',
                  'version' => '1.0',
                  'author' => 'Author',
                  'extend' =>
                  array (
                  ),
                  'files' =>
                  array (
                  ),
                  'blocks' =>
                  array (
                  ),
                  'settings' =>
                  array (
                  ),
                  'templates' =>
                  array (
                  ),
                  'events' =>
                  array (
                  ),
                );
        ";

        $metaData = new MetaData('moduleId');
        $this->assertEquals(preg_replace('/\s+/', '', $expectedContent), preg_replace('/\s+/', '',$metaData->getContent()));
    }

    public function testGetContent_WithExtensions()
    {
        $expectedContent = "
            <?php
                \$sMetadataVersion = '1.1';
                \$aModule = array (
                  'id' => 'moduleId',
                  'title' => 'Title moduleId',
                  'description' => 'Description moduleId',
                  'thumbnail' => 'picture.png',
                  'version' => '1.0',
                  'author' => 'Author',
                  'extend' =>
                  array (
                    'file' => 'extendPath',
                  ),
                  'files' =>
                  array (
                  ),
                  'blocks' =>
                  array (
                  ),
                  'settings' =>
                  array (
                  ),
                  'templates' =>
                  array (
                  ),
                  'events' =>
                  array (
                  ),
                );
        ";

        $metaData = new MetaData('moduleId');
        $metaData->setExtensions( array('file' => 'extendPath') );
        $this->assertEquals(preg_replace('/\s+/', '', $expectedContent), preg_replace('/\s+/', '',$metaData->getContent()));
    }
}