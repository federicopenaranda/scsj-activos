Ext.define('activos_scsj.view.layout.West', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.layout.west',
    collapsible: true,
    requires: [
        'activos_scsj.view.layout.Menu'
    ],
    region: 'west',
    title: 'Men&uacute;',
    split: true,
    bodyPadding: 5,
    //minWidth: 175,
    width: 175,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
             items: [
                {
                    xtype: 'layout.menu'
                }
             ]
        });
        me.callParent(arguments);
    }
});