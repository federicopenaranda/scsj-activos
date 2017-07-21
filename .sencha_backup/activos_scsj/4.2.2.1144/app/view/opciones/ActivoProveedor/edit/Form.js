Ext.define('activos_scsj.view.opciones.ActivoProveedor.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.opciones.activoproveedor.edit.form',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'activos_scsj.ux.form.field.RemoteComboBox'
    ],
    bodyPadding: 5,
    initComponent: function() {
    	var storePrivilegios = Ext.data.StoreManager.lookup('usuario.Privilegio');
		storePrivilegios.load();

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
                            name: 'nombre_activo_proveedor',
                            fieldLabel: 'Nombre Activo Proveedor'
                        },
                        {
                            xtype: 'textfield',
                            name: 'nit_activo_proveedor',
                            fieldLabel: 'Nit Activo Proveedor'
                        },
						{
                            xtype: 'textareafield',
                            name: 'direccion_activo_proveedor',
                            fieldLabel: 'Direccion Activo Proveedor'
                        },
						{
                            xtype: 'textareafield',
                            name: 'observaciones_activo_proveedor',
                            fieldLabel: 'Observaciones Activo Proveedor'
                        },
                        {
                            xtype: 'textfield',
                            name: 'telefono1_activo_proveedor',
                            fieldLabel: 'Telefono1 Activo Proveedor'
                        },
						{
                            xtype: 'textfield',
                            name: 'telefono2_activo_proveedor',
                            fieldLabel: 'Telefono2 Activo Proveedor'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});
                
                

