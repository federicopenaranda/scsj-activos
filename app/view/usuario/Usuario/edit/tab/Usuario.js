Ext.define('activos_scsj.view.usuario.Usuario.edit.tab.Usuario', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.usuario.usuario.edit.tab.usuario',
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
                    title: '<strong>Información de Usuario</strong>',
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
                                    fieldLabel: 'Primer Nombre:',
                                    name: 'primer_nombre_usuario',
                                    allowBlank: false
                                },
                                {
                                    xtype: 'textfield',
                                    fieldLabel: 'Segundo Nombre:',
                                    name: 'segundo_nombre_usuario',
                                    allowBlank: true
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textfield',
                                    fieldLabel: 'Apellido Paterno:',
                                    name: 'apellido_paterno_usuario',
                                    allowBlank: false
                                },
                                {
                                    xtype: 'textfield',
                                    fieldLabel: 'Apellido Materno:',
                                    name: 'apellido_materno_usuario',
                                    allowBlank: true
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    name: 'sexo_usuario',
                                    xtype: 'combo',
                                    fieldLabel: 'Sexo:',
                                    store: new Ext.data.SimpleStore({
                                        fields: ['nombre', 'valor'],
                                        data: [['Femenino', 'f'], ['Masculino', 'm']]
                                    }),
                                    triggerAction: 'all',
                                    valueField: 'valor',
                                    displayField: 'nombre',
                                    queryMode: 'local',
                                    forceSelection: true,
                                    editable: false,
                                    allowBlank: false
                                },
                                {
                                    xtype: 'textfield',
                                    fieldLabel: 'Teléfono de Usuario:',
                                    name: 'telefono_usuario'
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textfield',
                                    fieldLabel: 'Celular:',
                                    name: 'celular_usuario'
                                },
                                {
                                    xtype: 'textfield',
                                    fieldLabel: 'Correo:',
                                    name: 'correo_usuario',
                                    vtype: 'email',
                                    msgTarget: 'side'
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textareafield',
                                    name: 'direccion_usuario',
                                    fieldLabel: 'Dirección',
                                    height: 100
                                },
                                {
                                    xtype: 'textareafield',
                                    name: 'observaciones_usuario',
                                    fieldLabel: 'Observaciones',
                                    height: 100
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