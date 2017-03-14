<?php

/**
 * Created by PhpStorm.
 * User: mona
 * Date: 18/08/16
 * Time: 12:22
 */

use Pimcore\Controller\Action\Admin;
use AssetThumbnailLink\Plugin;

class AssetThumbnailLink_AdminController extends Admin
{
    public function getDataAction()
    {
        $this->disableViewAutoRender();

        $assetId = $this->getParam("id");

        $asset = \Pimcore\Model\Asset::getById($assetId);

        $config = new \Zend_Config_Xml(Plugin::getConfigName());
        $thumbnails = $config->thumbnails->thumbnail->toArray();

        $html = '<div style="padding:4px 8px;"><form><i>Hint: Choose thumbnail format below, then Copy/Paste Link!</i><br><br>';

        foreach ($thumbnails as $thumbnailName) {

            $thumb = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$asset->getThumbnail($thumbnailName);

            $html .= '<label for="thumb'.$thumbnailName.'"><div><b>'.$thumbnailName.'</b></div></label>';
            $html .= '<input id="thumb'.$thumbnailName.'" style="width:380px" onClick="this.select();" value="'.$thumb.'"><br><br>';
        }

        $html .= '</form></div>';

        try {

            $this->_helper->json([
                "success" => true,
                "html" => $html,
                "count" => count($thumbnails),
                "key" => $asset->getKey()
            ]);

        } catch (\Exception $e) {
            \Logger::err($e->getMessage());

            $this->_helper->json([
                "success" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
