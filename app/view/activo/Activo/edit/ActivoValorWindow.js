Ext.define('activos_scsj.view.activo.Activo.edit.ActivoValorWindow', {
    extend: 'Ext.window.Window',
    alias: 'widget.activo.activo.edit.activovalorwindow',
    requires: [
        'activos_scsj.view.activo.Activo.edit.ActivoValorForm'
    ],
    iconCls: 'icon_activo',
    width: 450,
    height: 300,
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
                    // include form
                    xtype: 'activo.activo.edit.activovalorform'
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