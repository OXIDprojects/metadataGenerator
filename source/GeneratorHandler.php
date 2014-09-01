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


/**
 * Main script class which runs generation
 */
class GeneratorHandler
{
    /**
     * Main generator function, executes metadata generation.
     */
    public function run()
    {
        $moduleList = new oxModuleList();
        $modules = $moduleList->getModulesFromDir(oxRegistry::getConfig()->getModulesDir());

        echo "Generation started. \n";
        $generated = array();

        foreach( $modules as $module ){
            if( !$module->hasMetadata() ) {
                $generated[] = $module->getId();
                $generator = new MetaDataGenerator($module, oxRegistry::getConfig()->getModulesDir());
                $generator->generate();
            }
        }

        if (count($generated)){
            echo "Generated for: " . implode(', ', $generated) . ". Finished. \n";
        }else {
            echo "0 files generated. Most likely all metadata.php files exist.\n";
        }
    }
}