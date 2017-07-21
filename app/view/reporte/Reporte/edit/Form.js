Ext.define('activos_scsj.view.reporte.Reporte.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.reporte.reporte.edit.form',
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
                            name: 'codigo_reporte',
                            fieldLabel: 'Código de Reporte'
                        },
                        {
                            xtype: 'textfield',
                            name: 'nombre_reporte',
                            fieldLabel: 'Nombre de Reporte'
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'combo',
                            name: 'estado_reporte',
                            fieldLabel: 'Estado de Reporte',
                            displayField: 'nombre',
                            valueField: 'valor',
                            store: new Ext.data.SimpleStore({
                                fields: ['nombre', 'valor'],
                                data: [['Habilitado', 1], ['Inhabilitado', 0]]
                            }),
                            editable: false,
                            forceSelection: true
                        },
                        {
                            xtype: 'combo',
                            name: 'tipo_reporte',
                            fieldLabel: 'Tipo de Reporte',
                            displayField: 'nombre',
                            valueField: 'valor',
                            store: new Ext.data.SimpleStore({
                                fields: ['nombre', 'valor'],
                                data: [['Vista', 'vista'], ['PDF', 'pdf'], ['Excel', 'excel']]
                            }),
                            editable: false,
                            forceSelection: true
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'textfield',
                            name: 'ruta_reporte',
                            fieldLabel: 'Ruta de Reporte'
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'textareafield',
                            name: 'descripcion_reporte',
                            fieldLabel: 'Descripción de Reporte',
                            allowBlank: true,
                            height: 90
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});