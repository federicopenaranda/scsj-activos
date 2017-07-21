Ext.define('activos_scsj.view.usuario.AsignacionLotes.edit.tab.Asignacion', {
    extend: 'Ext.form.Panel',
    alias: 'widget.usuario.asignacionlotes.edit.tab.asignacion',
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
                    title: '<strong>Información de Asignación</strong>',
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
                                    name: 'fecha_activo_entrega',
                                    fieldLabel: 'Fecha de Entrega',
                                    format: 'Y-m-d',
                                    submitFormat: 'Y-m-d'
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



/*    extend: 'Ext.panel.Panel',
    alias: 'widget.activo.activorevision.edit.tab.activorevision',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'activo.activorevision.edit.activorevisionform',
                    title: 'Administración de Revisiones',
                    iconCls: 'icon_gear',
                    store: Ext.create( 'activos_scsj.store.activo.ActivoRevision', {
                        pageSize: 10
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});*/