Ext.define('activos_scsj.view.activo.Activo.edit.tab.Info2', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.activo.activo.edit.tab.info2',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'activo.activo.edit.activoform2',
                    title: 'Administración de Activos',
                    iconCls: 'icon_gear'/*,
                    store: Ext.create( 'activos_scsj.store.activo.Activo', {
                        pageSize: 10
                    })*/
                }
            ]
        });
        me.callParent(arguments);
    }
});