Ext.define('activos_scsj.view.activo.Activo.edit.ActivoEntregaWindow', {
    extend: 'Ext.window.Window',
    alias: 'widget.activo.activo.edit.activoentregawindow',
    requires: [
        'activos_scsj.view.activo.Activo.edit.ActivoEntregaForm'
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
                    xtype: 'activo.activo.edit.activoentregaform'
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