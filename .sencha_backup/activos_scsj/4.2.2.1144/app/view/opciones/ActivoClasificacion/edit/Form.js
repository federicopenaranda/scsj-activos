Ext.define('activos_scsj.view.opciones.ActivoClasificacion.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.opciones.activoclasificacion.edit.form',
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
                            name: 'nombre_activo_clasificacion',
                            fieldLabel: 'Nombre Activo Clasificacion'
                        },
						{
                            xtype: 'textareafield',
                            name: 'descripcion_activo_clasificacion',
                            fieldLabel: 'Descripcion Activo Clasificacion'
                        },
                 		{
                            xtype: 'numberfield',
                            name: 'coeficiente_depreciacion_activo_clasificacion',
                            fieldLabel: 'Coeficiente Depreciacion Activo Clasificacion'
                        }, 
                 		{
                            xtype: 'numberfield',
                            name: 'anos_vida_util_activo_clasificacion',
                            fieldLabel: 'Anos Vida Util Activo Clasificacion'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});
                
                

