Ext.define('activos_scsj.view.revision.ActivoRevision.edit.tab.Activos', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.revision.ativorevision.edit.tab.activos',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'revision.activorevision.activolista',
                    title: 'Revisión de Activos',
                    iconCls: 'icon_activo',
                    store: Ext.create( 'activos_scsj.store.revision.ActivoRevision', {
                        pageSize: 10/*,
                        remoteFilter: false*/
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});