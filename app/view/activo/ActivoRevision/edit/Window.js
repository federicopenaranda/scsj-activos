Ext.define('activos_scsj.view.activo.ActivoRevision.edit.Window', {
    extend: 'Ext.window.Window',
    alias: 'widget.activo.activorevision.edit.window',
    iconCls: 'icon_user',
    width: 800,
    height: 350,
    modal: true,
    resizable: true,
    draggable: true,
    constrainHeader: true,
    layout: 'fit',
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'activo.activorevision.lista'
                }
            ]
        });
        me.callParent(arguments);
    }
});