Ext.define('activos_scsj.view.activo.Activo.search.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.activo.activo.search.form',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.FieldSet',
        'Ext.form.field.Date',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'Ext.slider.Multi',
        'activos_scsj.ux.form.field.RemoteComboBox',
        'activos_scsj.ux.form.field.plugin.ClearTrigger'
    ],
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            items: [
                {
                    xtype: 'fieldset',
                    title: 'Criterios de Búsqueda',
                    collapsible: true,
                    items: [
                        {
                            xtype: 'fieldcontainer',
                            layout: 'hbox',
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
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true,
                                    allowBlank: false
                                },
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_activo_clasificacion',
                                    itemId: 'activo_clasificacion',
                                    fieldLabel: 'Rubro',
                                    displayField: 'nombre_activo_clasificacion',
                                    valueField: 'id_activo_clasificacion',
                                    store: {
                                        type: 'opciones.activoclasificacion'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true,
                                    allowBlank: false
                                },
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_activo_utilitario',
                                    itemId: 'activo_utilitario',
                                    fieldLabel: 'Utilitario',
                                    displayField: 'nombre_activo_utilitario',
                                    valueField: 'id_activo_utilitario',
                                    store: {
                                        type: 'opciones.activoutilitario'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true,
                                    allowBlank: false
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            layout: 'hbox',
                            items: [
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_unidad',
                                    fieldLabel: 'Unidad',
                                    displayField: 'nombre_unidad',
                                    valueField: 'id_unidad',
                                    store: {
                                        type: 'opciones.unidad'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true,
                                    allowBlank: false
                                },
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_area',
                                    fieldLabel: 'Área',
                                    displayField: 'nombre_area',
                                    valueField: 'id_area',
                                    store: {
                                        type: 'opciones.area'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true,
                                    allowBlank: false
                                },
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_departamento',
                                    fieldLabel: 'Departamento',
                                    displayField: 'nombre_departamento',
                                    valueField: 'id_departamento',
                                    store: {
                                        type: 'opciones.departamento'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true,
                                    allowBlank: false
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            layout: 'hbox',
                            items: [
                                {
                                    xtype: 'textfield',
                                    name: 'codigo_activo',
                                    fieldLabel: 'Código'
                                },
                                {
                                    xtype: 'textfield',
                                    name: 'descripcion_activo',
                                    fieldLabel: 'Descripción'
                                },
                                {
                                    xtype: 'datefield',
                                    name: 'fecha_adquisicion_activo',
                                    format: 'Y-m-d',
                                    submitFormat: 'Y-m-d',
                                    fieldLabel: 'Fecha Adq.'
                                }
                            ]
                        }
                    ]
                }
            ]
        });
        me.callParent( arguments );
    }
});