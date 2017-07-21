Ext.define('activos_scsj.view.opciones.Revision.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.opciones.revision.edit.form',
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
                            xtype: 'datefield',
                            name: 'fecha_inicio_revision',
                            fieldLabel: 'Fecha Inicio Revision',
                            format: 'Y-m-d',
                            submitFormat: 'Y-m-d'
                        },
						{
                            xtype: 'datefield',
                            name: 'fecha_fin_revision',
                            fieldLabel: 'Fecha Fin Revision',
                            format: 'Y-m-d',
                            submitFormat: 'Y-m-d'
                        },
						{
                            xtype: 'textareafield',
                            name: 'observaciones_revision',
                            fieldLabel: 'Observaciones Revision'
                        },
						{
                            xtype: 'textareafield',
                            name: 'descripcion_revision',
                            fieldLabel: 'Descripcion Revision'
                        },
						{
                            xtype: 'combo',
                            name: 'estado_revision',
                            fieldLabel: 'Estado:',
                            displayField: 'nombre',
                            valueField: 'valor',
                            store: LocalStoreEstado,
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
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
                
                

