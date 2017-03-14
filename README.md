AssetThumbnailLink Plugin
=============================

Developer info: [Pimcore at basilicom](http://basilicom.de/en/pimcore)


## Synopsis

This plugin adds a new button 'Get Thumbnail Links' in the asset detail view.
By clicking this button a window opens where the user is able to copy
and paste absolute URLs to specific thumbnails of the asset.

## Installation

Add the "basilicom-pimcore-plugin/asset-thumbnail-link" to the composer.json in the 
toplevel directory of your pimcore installation.
Then enable and install the plugin in Pimcore Extension Manager (under Extras > Extensions)

Example:

    {
        "require": {
            "basilicom-pimcore-plugin/asset-thumbnail-link": ">=1.0.0"
        }
    }

Installing the plugin a extension-asset-thumbnail-link.xml is created 
in /website/var/config.

Edit this file and add the thumbnail formats you want to be available
for users.

## License

GNU General Public License version 3 (GPLv3)