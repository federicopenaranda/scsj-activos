Ext.define('activos_scsj.store.Base', {
    extend: 'Ext.data.Store',
    requires: [
        'activos_scsj.proxy.JSON'
    ],
    serverPath: 'http://192.168.1.110:8080/activos_scsj/yii/index.php/',
    //serverPath: 'http://200.105.158.70:8080/activos_scsj/yii/index.php/',
    restPath: null,
    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
                storeId: 'Base',
                remoteSort: true,
                remoteFilter: true,
                remoteGroup: true,
                proxy: {
                    type: 'basejson',
                    url: me.restPath,
                    api: {
                        create: me.serverPath + me.restPath + '/create',
                        read: me.serverPath + me.restPath,
                        update: me.serverPath + me.restPath + '/update',
                        destroy: me.serverPath + me.restPath + '/delete'
                    }
                }
            }, cfg)]);
    }
});