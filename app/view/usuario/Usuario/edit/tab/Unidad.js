Ext.define('activos_scsj.view.usuario.Usuario.edit.tab.Unidad', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.usuario.usuario.edit.tab.unidad',
    layout: 'form',
    requires: [
        'Ext.form.Panel',
        'Ext.tip.QuickTipManager',
        'activos_scsj.store.opciones.Unidad',
        'Ext.ux.form.ItemSelector'
        ],
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
                
        var storeUnidad = Ext.data.StoreManager.lookup('opciones.Unidad');
        storeUnidad.load();

        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'itemselector',
                    itemId: 'usuario_unidad_00_01_02',
                    name: 'usuario_unidad_00_01_02',
                    anchor: '100%',
                    store: storeUnidad,
                    displayField: 'nombre_unidad',
                    valueField: 'id_unidad',
                    allowBlank: true,
                    msgTarget: 'side',
                    fromTitle: 'Unidades Disponibles',
                    toTitle: 'Unidades Seleccionadas',
                    buttons: [ 'add', 'remove' ],
                    delimiter: null
                }
            ]
        });
        me.callParent(arguments);
    }
});