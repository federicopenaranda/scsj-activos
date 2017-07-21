Ext.define('activos_scsj.view.activo.Activo.edit.ActivoForm', {
    extend: 'Ext.form.Panel',
    alias: 'widget.activo.activo.edit.activoform',
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
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            defaults: {
                layout: 'hbox',
                margins: '0 10 0 10'
            },
            tbar: [
                {
                    xtype: 'checkbox',
                    itemId: 'activos_creacion_lotes',
                    boxLabel: '¿Creación de Activos en Lotes?'
                }
            ],
            items: [
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_proveedor',
                            fieldLabel: 'Proveedor',
                            displayField: 'nombre_activo_proveedor',
                            valueField: 'id_activo_proveedor',
                            store: {
                                type: 'opciones.activoproveedor'
                            },
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        },
                        {
                            xtype: 'filefield',
                            name: 'archivo_foto_activo',
                            fieldLabel: 'Foto de Archivo',
                            labelWidth: 50,
                            msgTarget: 'side',
                            labelAlign: 'top',
                            allowBlank: true,
                            anchor: '100%',
                            buttonConfig: {
                                iconCls: 'icon_picture',
                                text: ''
                            }
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'numberfield',
                            name: 'piezas_activo',
                            fieldLabel: 'Cantidad de Piezas',
                            allowBlank: false,
                            allowDecimals: true,
                            decimalSeparator: '.',
                            decimalPrecision: 2
                        },
                        {
                            xtype: 'datefield',
                            name: 'fecha_adquisicion_activo',
                            fieldLabel: 'Fecha de Adquisición',
                            format: 'Y-m-d',
                            submitFormat: 'Y-m-d',
                            allowBlank: false
                        },
                        {
                            xtype: 'numberfield',
                            name: 'cantidad_activo',
                            itemId: 'cantidad_activo',
                            disabled: true,
                            value: 1,
                            fieldLabel: 'Cantidad de Activos',
                            allowBlank: true,
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
                            name: 'precio_adquisicion_activo',
                            fieldLabel: 'Precio de Adquisición',
                            allowBlank: false,
                            allowDecimals: true,
                            decimalSeparator: '.',
                            decimalPrecision: 2
                        },
                        {
                            xtype: 'numberfield',
                            name: 'garantia_meses_activo',
                            fieldLabel: 'Meses de Garantia',
                            allowBlank: true
                        },
                        {
                            xtype: 'datefield',
                            name: 'fecha_baja_activo',
                            fieldLabel: 'Fecha de Baja',
                            format: 'Y-m-d',
                            submitFormat: 'Y-m-d',
                            allowBlank: true
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'textareafield',
                            name: 'descripcion_activo',
                            fieldLabel: 'Descripcion del Activo',
                            height: 80,
                            allowBlank: true
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});