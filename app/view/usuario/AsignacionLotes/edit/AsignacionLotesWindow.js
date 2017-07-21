Ext.define('activos_scsj.view.usuario.AsignacionLotes.edit.AsignacionLotesWindow', {
    extend: 'Ext.window.Window',
    alias: 'widget.usuario.asignacionlotes.edit.asignacionloteswindow',
    requires: [
        'activos_scsj.view.usuario.AsignacionLotes.edit.Form'
    ],
    iconCls: 'icon_user',
    width: 600,
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
                    xtype: 'usuario.asignacionlotes.edit.form'
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