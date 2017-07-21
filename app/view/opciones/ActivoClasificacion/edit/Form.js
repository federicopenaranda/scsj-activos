Ext.define('activos_scsj.view.opciones.ActivoClasificacion.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.opciones.activoclasificacion.edit.form',
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
                            xtype: 'textfield',
                            name: 'nombre_activo_clasificacion',
                            fieldLabel: 'Nombre de Clasificación'
                        },
                        {
                            xtype: 'numberfield',
                            name: 'coeficiente_depreciacion_activo_clasificacion',
                            fieldLabel: 'Coeficiente de Depreciación',
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
                            xtype: 'numberfield',
                            name: 'anos_vida_util_activo_clasificacion',
                            fieldLabel: 'Años de Vida Útil'
                        },
                        {
                            xtype: 'textfield',
                            name: 'codigo_activo_clasificacion',
                            fieldLabel: 'Código de Clasificación'
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'textareafield',
                            name: 'descripcion_activo_clasificacion',
                            fieldLabel: 'Descripcion de Clasificación'
                        }

                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});