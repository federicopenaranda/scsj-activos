Ext.define('activos_scsj.view.usuario.edit.tab.Sistema', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.usuario.edit.tab.sistema',
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
                    title: '<strong>Informaci&oacute;n de Sistema</strong>',
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
                                    fieldLabel: 'Login de Usuario:',
                                    name: 'login_usuario',
                                    allowBlank: false
                                },
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_tipo_usuario',
                                    fieldLabel: 'Tipo de Usuario:',
                                    displayField: 'nombre_tipo_usuario',
                                    valueField: 'id_tipo_usuario',
                                    store: {
                                        type: 'opciones.tipousuario'
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
                            items: [
                                {
                                    xtype: 'textfield',
                                    id: 'passwrod1',
                                    itemId: 'password1',
                                    fieldLabel: 'Contraseña de Usuario (1):',
                                    name: 'password_usuario',
                                    inputType: 'password',
                                    enableKeyEvents: true,
                                    allowBlank: false,
                                    listeners: {
                                        keyup: function(field) {
                                            var pwd1 = field.getValue();
                                            var pwd2 = Ext.getCmp('password2').getValue();
                                            var cmp = Ext.getCmp('comparacion_password');
                                            if ( pwd1 !== '' && pwd2 !== '' )
                                            {
                                                if (pwd1 === pwd2)
                                                {
                                                    cmp.setText('Contrase&ntilde;as Id&eacute;nticas');
                                                    cmp.removeCls('pwd_distintas');
                                                    cmp.addCls('pwd_identicas');
                                                }
                                                else
                                                {
                                                    cmp.setText('Contrase&ntilde;as Distintas');
                                                    cmp.removeCls('pwd_identicas');
                                                    cmp.addCls('pwd_distintas');
                                                }
                                            }
                                        }
                                    }
                                },
                                {
                                    xtype: 'textfield',
                                    id: 'password2',
                                    itemId: 'password2',
                                    fieldLabel: 'Contrase&ntilde;a de Usuario (2):',
                                    name: 'password_usuario2',
                                    inputType: 'password',
                                    enableKeyEvents: true,
                                    allowBlank: false,
                                    listeners: {
                                        keyup: function(field) {
                                            var pwd1 = Ext.getCmp('password1').getValue();
                                            var pwd2 = field.getValue();
                                            var cmp = Ext.getCmp('comparacion_password');
                                            if ( pwd1 !== '' && pwd2 !== '' )
                                            {
                                                if (pwd1 === pwd2)
                                                {
                                                    cmp.setText('Contrase&ntilde;as Id&eacute;nticas');
                                                    cmp.removeCls('pwd_distintas');
                                                    cmp.addCls('pwd_identicas');
                                                }
                                                else
                                                {
                                                    cmp.setText('Contrase&ntilde;as Distintas');
                                                    cmp.removeCls('pwd_identicas');
                                                    cmp.addCls('pwd_distintas');
                                                }
                                            }
                                        }
                                    }
                                }
                            ]
                        }
                    ]
                },
                {
                    xtype: 'label',
                    id: 'comparacion_password',
                    itemId: 'comparacion_password'
                }
            ]
        });
        me.callParent(arguments);
    }
});