Ext.define('activos_scsj.view.opciones.Revision.edit.Window', {
    extend: 'Ext.window.Window',
    alias: 'widget.opciones.revision.edit.window',
    requires: [
        'activos_scsj.view.opciones.Revision.edit.Form'
    ],
    iconCls: 'icon_user',
    width: 600,
    modal: true,
    resizable: true,
    draggable: true,
    constrainHeader: true,
    layout: 'fit',
    initComponent: function() {
    	var storePrivilegios = Ext.data.StoreManager.lookup('usuario.Privilegio');
		storePrivilegios.load();

        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    // include form
                    xtype: 'opciones.revision.edit.form'
                }
            ],
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'bottom',
                    ui: 'footer',
                    items: [
                        {
                            xtype: 'button',
                            itemId: 'cancel',
                            text: 'Cancelar',
                            iconCls: 'icon_delete'
                        },
                        '->',
                        {
                            xtype: 'button',
                            itemId: 'save',
                            text: 'Guardar',
                            iconCls: 'icon_save'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});
                
                

