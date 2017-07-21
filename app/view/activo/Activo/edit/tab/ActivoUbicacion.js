Ext.define('activos_scsj.view.activo.Activo.edit.tab.ActivoUbicacion', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.activo.activo.edit.tab.activoubicacion',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'activo.activo.activoubicacionlista',
                    title: 'Ubicación de Activo',
                    iconCls: 'icon_activo',
                    store: Ext.create( 'activos_scsj.store.activo.ActivoUbicacion', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});