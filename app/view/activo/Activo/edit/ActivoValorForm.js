Ext.define('activos_scsj.view.activo.Activo.edit.ActivoValorForm', {
    extend: 'Ext.form.Panel',
    alias: 'widget.activo.activo.edit.activovalorform',
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
                allowBlank: true,
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            defaults: {
                layout: 'hbox'
            },
            items: [
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'numberfield',
                            name: 'valor_activo_valor',
                            fieldLabel: 'Valor del Activo:',
                            allowBlank: false,
                            allowDecimals: true,
                            decimalSeparator: '.',
                            decimalPrecision: 2
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'datefield',
                            name: 'fecha_valoracion_activo_valor',
                            fieldLabel: 'Fecha de Valoración',
                            format: 'Y-m-d',
                            submitFormat: 'Y-m-d'
                        },
                        {
                            xtype: 'combo',
                            name: 'estado_activo_valor',
                            fieldLabel: 'Estado:',
                            displayField: 'nombre',
                            valueField: 'valor',
                            store: new Ext.data.SimpleStore({
                                fields: ['nombre', 'valor'],
                                data: [['Habilitado', 1], ['Inhabilitado', 0]]
                            }),
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});