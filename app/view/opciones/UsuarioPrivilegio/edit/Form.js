Ext.define('activos_scsj.view.opciones.UsuarioPrivilegio.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.opciones.usuarioprivilegio.edit.form',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'activos_scsj.ux.form.field.RemoteComboBox'
    ],
    bodyPadding: 5,
    initComponent: function() {
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
                        	name: 'nombre_privilegio_usuario_privilegio',
                        	fieldLabel: 'Nombre Privilegio Usuario Privilegio'
                    	},
						{
                        	xtype: 'textfield',
                        	name: 'accion_usuario_privilegio',
                        	fieldLabel: 'Accion Usuario Privilegio'
                    	},
						{
                        	xtype: 'textfield',
                        	name: 'opciones_usuario_privilegio',
                        	fieldLabel: 'Opciones Usuario Privilegio'
						}
					]
				}, 
				{
                  xtype: 'fieldcontainer',
                    items: [
						{
                        	xtype: 'textfield',
                        	name: 'funcion_usuario_privilegio',
                        	fieldLabel: 'Funcion Usuario Privilegio'
                    	},
						{
                        	xtype: 'textfield',
                        	name: 'descripcion_usuario_privilegio',
                        	fieldLabel: 'Descripcion Usuario Privilegio'
						}
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});