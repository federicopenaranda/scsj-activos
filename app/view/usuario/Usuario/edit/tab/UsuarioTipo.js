Ext.define('activos_scsj.view.usuario.Usuario.edit.tab.UsuarioTipo', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.usuario.usuario.edit.tab.usuariotipo',
    layout: 'form',
    requires: [
        'Ext.form.Panel',
        'Ext.tip.QuickTipManager',
        'activos_scsj.store.usuario.UsuarioTipo',
        'Ext.ux.form.ItemSelector'
        ],
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
                
        var storeUsuarioTipo = Ext.data.StoreManager.lookup('usuario.UsuarioTipo');
        storeUsuarioTipo.load();

        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'itemselector',
                    itemId: 'usuario_tipo_usuario_00_01_02',
                    name: 'usuario_tipo_usuario_00_01_02',
                    anchor: '100%',
                    store: storeUsuarioTipo,
                    displayField: 'nombre_usuario_tipo',
                    valueField: 'id_usuario_tipo',
                    allowBlank: true,
                    msgTarget: 'side',
                    fromTitle: 'Tipos Disponibles',
                    toTitle: 'Tipos Seleccionados',
                    buttons: [ 'add', 'remove' ],
                    delimiter: null
                }
            ]
        });
        me.callParent(arguments);
    }
});