Ext.define('activos_scsj.view.activo.Activo.edit.tab.ActivoEntrega', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.activo.activo.edit.tab.activoentrega',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'activo.activo.activoentregalista',
                    title: 'Entrega de Activo',
                    iconCls: 'icon_activo',
                    store: Ext.create( 'activos_scsj.store.activo.ActivoEntrega', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});