pimcore.registerNS("pimcore.plugin.assetthumbnaillink");

pimcore.plugin.assetthumbnaillink = Class.create(pimcore.plugin.admin, {
    getClassName: function() {
        return "pimcore.plugin.assetthumbnaillink";
    },

    initialize: function() {
        pimcore.plugin.broker.registerPlugin(this);
    },
 
    pimcoreReady: function (params,broker){
        //alert("AssetThumbnailLink Plugin Ready!");


    },

    postOpenAsset: function(asset) {
        //alert('post open asset!');

        var self = this;
        var index = 10;

        if (asset.type == 'folder') {
            return;
        }


        asset.toolbar.insert(index, {
            text: '',
            itemId: 'assetthumbnaillink',
            iconCls: "pimcore_icon_assetthumbnaillink",
            tooltip: 'Get Thumbnail Link',
            scale: 'medium',
            handler: function(button) {

                Ext.Ajax.request({
                    url: "/plugin/AssetThumbnailLink/admin/get-data",
                    success: function(data) {
                        var response = JSON.parse(data.responseText);

                        Ext.create('Ext.Window', {
                            title: 'Get Thumbnail Link: '+response.key,
                            width: 400,
                            height: (100 + (response.count*52)),
                            plain: true,
                            layout: 'fit',
                            items: {
                                border: false,
                                html: response.html
                            }
                        }).show();

                    },
                    params: {
                        id: asset.id,
                        type: asset.type
                    }
                });
            }
        });
    }
});

var assetthumbnaillinkPlugin = new pimcore.plugin.assetthumbnaillink();

