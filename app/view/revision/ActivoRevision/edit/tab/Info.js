Ext.define('activos_scsj.view.revision.ActivoRevision.edit.tab.Info', {
    extend: 'Ext.form.Panel',
    alias: 'widget.revision.activorevision.edit.tab.info',
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
            items: [
                {
                    xtype: 'fieldset',
                    title: '<strong>Filtro de Activos a Revisar</strong>',
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
                                    itemId: 'fk_id_unidad',
                                    fieldLabel: 'Unidad',
                                    displayField: 'nombre_unidad',
                                    valueField: 'id_unidad',
                                    store: {
                                        type: 'opciones.unidad'
                                    },
                                    editable: true,
                                    forceSelection: true,
                                    allowBlank: false,
                                    typeAhead: true,
                                    triggerAction: 'all',
                                    minChars : 1,
                                    totalProperty : 'total',
                                    pageSize : 10,
                                    listeners: {
                                        beforequery: function( queryPlan, eOpts ) {
                                            var nQuery = [];
                                            var tmpQuery = {
                                                nombre_unidad: queryPlan.query
                                            };
                                            nQuery.push(tmpQuery); // push this to the array
                                            queryPlan.query = Ext.encode(nQuery);
                                        }
                                    }
                                },
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_area',
                                    itemId: 'fk_id_area',
                                    fieldLabel: 'Área',
                                    displayField: 'nombre_area',
                                    valueField: 'id_area',
                                    store: {
                                        type: 'opciones.area'
                                    },
                                    editable: true,
                                    forceSelection: true,
                                    allowBlank: false,
                                    typeAhead: true,
                                    triggerAction: 'all',
                                    minChars : 1,
                                    totalProperty : 'total',
                                    pageSize : 10,
                                    listeners: {
                                        beforequery: function( queryPlan, eOpts ) {
                                            var nQuery = [];
                                            var tmpQuery = {
                                                nombre_area: queryPlan.query
                                            };
                                            nQuery.push(tmpQuery); // push this to the array
                                            queryPlan.query = Ext.encode(nQuery);
                                        }
                                    }
                                },
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_departamento',
                                    itemId: 'fk_id_departamento',
                                    fieldLabel: 'Departamento',
                                    displayField: 'nombre_departamento',
                                    valueField: 'id_departamento',
                                    store: {
                                        type: 'opciones.departamento'
                                    },
                                    editable: true,
                                    forceSelection: true,
                                    allowBlank: false,
                                    typeAhead: true,
                                    triggerAction: 'all',
                                    minChars : 1,
                                    totalProperty : 'total',
                                    pageSize : 10,
                                    listeners: {
                                        beforequery: function( queryPlan, eOpts ) {
                                            var nQuery = [];
                                            var tmpQuery = {
                                                nombre_departamento: queryPlan.query
                                            };
                                            nQuery.push(tmpQuery); // push this to the array
                                            queryPlan.query = Ext.encode(nQuery);
                                        }
                                    }
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_ubicacion',
                                    itemId: 'fk_id_ubicacion',
                                    fieldLabel: 'Ubicacion',
                                    displayField: 'nombre_ubicacion',
                                    valueField: 'id_ubicacion',
                                    store: {
                                        type: 'opciones.ubicacion'
                                    },
                                    editable: true,
                                    forceSelection: true,
                                    allowBlank: false,
                                    typeAhead: true,
                                    triggerAction: 'all',
                                    minChars : 1,
                                    totalProperty : 'total',
                                    pageSize : 10/*,
                                    listeners: {
                                        beforequery: function( queryPlan, eOpts ) {
                                            var nQuery = [];
                                            var tmpQuery = {
                                                nombre_ubicacion: queryPlan.query
                                            };
                                            nQuery.push(tmpQuery); // push this to the array
                                            queryPlan.query = Ext.encode(nQuery);
                                        }
                                    }*/
                                }
                            ]
                        }
                    ]
                },
                {
                    xtype: 'label',
                    html: '<strong>Advertencia: El usuario seleccionado a continuación se le asignará automáticamente todos los activos que se revisarán en esta ventana, si no desea que suceda eso deje el campo en blanco.</strong>'
                },
                {
                    xtype: 'fieldset',
                    title: '<strong>Asignación de Activos a Usuario</strong>',
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
                                    name: 'fk_id_usuario_recibio',
                                    itemId: 'fk_id_usuario_recibio',
                                    fieldLabel: 'Usuario',
                                    displayField: 'login_usuario',
                                    valueField: 'id_usuario',
                                    displayTpl: Ext.create('Ext.XTemplate',
                                                '<tpl for=".">',
                                                    '{primer_nombre_usuario} {segundo_nombre_usuario} {apellido_paterno_usuario} {apellido_materno_usuario} ({login_usuario})',
                                                '</tpl>'),
                                    tpl: '<tpl for="."><div class="x-boundlist-item" >{primer_nombre_usuario} {segundo_nombre_usuario} {apellido_paterno_usuario} {apellido_materno_usuario} ({login_usuario})</div></tpl>',
                                    store: {
                                        type: 'usuario.usuario'
                                    },
                                    editable: true,
                                    forceSelection: true,
                                    allowBlank: true,
                                    typeAhead: true,
                                    triggerAction: 'all',
                                    minChars : 1,
                                    totalProperty : 'total',
                                    pageSize : 10,
                                    listeners: {
                                        beforequery: function( queryPlan, eOpts ) {
                                            var nQuery = [];
                                            var tmpQuery = {
                                                login_usuario: queryPlan.query
                                            };
                                            nQuery.push(tmpQuery); // push this to the array
                                            queryPlan.query = Ext.encode(nQuery);
                                        }
                                    }
                                }
                            ]
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});