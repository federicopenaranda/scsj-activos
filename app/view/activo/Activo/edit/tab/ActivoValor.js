Ext.define('activos_scsj.view.activo.Activo.edit.tab.ActivoValor', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.activo.activo.edit.tab.activovalor',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'activo.activo.activovalorlista',
                    title: 'Valor de Activo',
                    iconCls: 'icon_activo',
                    store: Ext.create( 'activos_scsj.store.activo.ActivoValor', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});