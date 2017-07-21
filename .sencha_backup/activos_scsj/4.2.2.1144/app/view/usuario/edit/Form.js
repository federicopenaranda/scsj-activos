Ext.define('activos_scsj.view.usuario.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.usuario.edit.form',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'activos_scsj.ux.form.field.RemoteComboBox',
        'Ext.ux.form.ItemSelector'
    ],
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                allowBlank: true,
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            items: [
                {
                    xtype: 'tabpanel',
                    bodyPadding: 5,
                    // set to false to disable lazy render of non-active tabs...IMPORTANT!!!
                    deferredRender: false,
                    items: [
                        {
                            xtype: 'usuario.edit.tab.usuario',
                            title: 'Info. de Usuario'
                        },
                        {
                            xtype: 'usuario.edit.tab.sistema',
                            title: 'Info. de Sistema'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});