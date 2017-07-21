Ext.define('activos_scsj.view.opciones.Ubicacion.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.opciones.ubicacion.edit.form',
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
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_unidad',
                            fieldLabel: 'Nombre Unidad',
                            displayField: 'nombre_unidad',
                            valueField: 'id_unidad',
                            store: {
                                type: 'opciones.unidad'
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
                            xtype: 'textfield',
                            name: 'nombre_ubicacion',
                            fieldLabel: 'Nombre Ubicacion'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});