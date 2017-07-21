Ext.define('activos_scsj.view.reporte.REP001.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.reporte.rep001.edit.form',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'activos_scsj.ux.form.field.RemoteComboBox'
    ],
    bodyPadding: 5,
    initComponent: function () {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                allowBlank: false,
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            defaults: {
                layout: 'hbox',
                margins: '0 10 0 10'
            },
            items: [
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'datefield',
                            name: 'fecha_min',
                            fieldLabel: 'Fecha de Inicio',
                            format: 'Y-m-d',
                            submitFormat: 'Y-m-d'
                        },
                        {
                            xtype: 'datefield',
                            name: 'fecha_max',
                            fieldLabel: 'Fecha de Fin',
                            format: 'Y-m-d',
                            submitFormat: 'Y-m-d'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});