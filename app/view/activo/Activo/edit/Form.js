Ext.define('activos_scsj.view.activo.Activo.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.activo.activo.edit.form',
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
                    deferredRender: false,
                    items: [
                        {
                            xtype: 'activo.activo.edit.tab.info',
                            title: 'Info de Activo'
                        },
                        {
                            xtype: 'activo.activo.edit.tab.info2',
                            title: 'Info de Activo (Pertenencia)'
                        },
                        {
                            xtype: 'activo.activo.edit.tab.activovalor',
                            title: 'Valor de Activo'
                        },
                        {
                            xtype: 'activo.activo.edit.tab.activoentrega',
                            title: 'Entrega de Activo'
                        },
                        {
                            xtype: 'activo.activo.edit.tab.activoubicacion',
                            title: 'Ubicación de Activo'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});