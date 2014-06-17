metadataGenerator
=================

OXID eSales legacy module metadata.php file generator.

## Description

OXID eSales legacy module metadata.php file generator.
Tool generates metadata.php in module folder if there are no such file.
It generates files with protocol version 1.1. In metadata array will be included all keys (parameters).
If module is active scripts fills "extend" part.

## Version support

Tool support this shop versions:
 * 5.0.x / 4.7.x
 * 5.1.x / 4.8.x

## Installation and usage

 * Copy script folder metadataGenerator near the shop (copy of the shop, ensure that you have backup)
 * Set the full path to the shop in config.php file
 * Run the script main.php (from console or browser).
 * Check generated metadata.php files. Change title, description other properties.
 More information: http://wiki.oxidforge.org/Features/Extension_metadata_file