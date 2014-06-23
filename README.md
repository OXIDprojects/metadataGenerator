metadataGenerator
=================

## Description

The script "metadataGenerator" helps you to generate the file metadata.php (necessary in modules for OXID eShop series >= 4.7) for OXID eShop legacy modules. This tool will generate a metadata.php in the /module/ folder if there's no such file yet. All keys (parameters) will be included using the metadata protocol version 1.1. If the legacy module is active in your OXID eShop installation, this script will generate the "extend" part in metadata.php.

## Version support

The following OXID eShop versions are supported:
 * 5.0.x / 4.7.x
 * 5.1.x / 4.8.x

## Installation and usage

 * Backup your OXID eShop installation
 * Best, use your development environment for generating the metadata.php
 * Copy the folder /metadataGenerator/ to the same directory level where your OXID eShop installation runs
 * Set the full server path (for example '/var/www/myShop/') to the shop in config.php file
 * Run the script main.php (from console or browser)
 * Check the generated metadata.php files. Change the title, the description or other properties if needed
 Please find more information about possible keys (parameters) in metadata.php here: http://wiki.oxidforge.org/Features/Extension_metadata_file
