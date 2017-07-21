Ext.define('activos_scsj.view.layout.Center', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.layout.center',
    region: 'center',
    title: 'Activos SCSJ',
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            
        });
        me.callParent(arguments);
    }
});