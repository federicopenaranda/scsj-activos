Ext.define('activos_scsj.view.revision.ActivoRevision.edit.ActivoRevisionWindow', {
    extend: 'Ext.window.Window',
    alias: 'widget.revision.activorevision.edit.activorevisionwindow',
    requires: [
        'activos_scsj.view.revision.ActivoRevision.edit.ActivoRevisionForm'
    ],
    iconCls: 'icon_user',
    width: 650,
    height: 400,
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
                    xtype: 'revision.activorevision.edit.activorevisionform'
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