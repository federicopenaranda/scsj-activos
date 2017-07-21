Ext.define('activos_scsj.view.usuario.Usuario.edit.tab.Departamento', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.usuario.usuario.edit.tab.departamento',
    bodyPadding: 0,
    margin: 5,
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
                    xtype: 'fieldset',
                    title: '<strong>Información de Área y Departamento</strong>',
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
                                    name: 'fk_id_area',
                                    fieldLabel: 'Área:',
                                    displayField: 'nombre_area',
                                    valueField: 'id_area',
                                    store: {
                                        type: 'opciones.area'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true
                                },
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_departamento',
                                    fieldLabel: 'Departamento:',
                                    displayField: 'nombre_departamento',
                                    valueField: 'id_departamento',
                                    store: {
                                        type: 'opciones.departamento'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_cargo',
                                    fieldLabel: 'Cargo:',
                                    displayField: 'nombre_cargo',
                                    valueField: 'id_cargo',
                                    store: {
                                        type: 'opciones.cargo'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true
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