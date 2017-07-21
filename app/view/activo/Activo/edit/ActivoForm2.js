Ext.define('activos_scsj.view.activo.Activo.edit.ActivoForm2', {
    extend: 'Ext.form.Panel',
    alias: 'widget.activo.activo.edit.activoform2',
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
            items: [
                {
                    xtype: 'fieldcontainer',
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
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_activo_clasificacion',
                            itemId: 'activo_clasificacion',
                            fieldLabel: 'Clasificación',
                            displayField: 'nombre_activo_clasificacion',
                            valueField: 'id_activo_clasificacion',
                            store: {
                                type: 'opciones.activoclasificacion'
                            },
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        },
                        {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_activo_utilitario',
                            itemId: 'activo_utilitario',
                            disabled: true,
                            fieldLabel: 'Utilitario',
                            displayField: 'nombre_activo_utilitario',
                            valueField: 'id_activo_utilitario',
                            store: {
                                type: 'opciones.activoutilitario'
                            },
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