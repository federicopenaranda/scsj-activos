Ext.define('activos_scsj.view.activo.ActivoRevision.edit.tab.ActivoRevision', {
    extend: 'Ext.form.Panel',
    alias: 'widget.activo.activorevision.edit.tab.activorevision',
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
                    title: '<strong>Información de Entidad</strong>',
                    defaults: {
                        layout: 'hbox',
                        margins: '0 10 0 10'
                    },
                    items: [
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'combo',
                                    name: 'condicion_activo_revision',
                                    fieldLabel: 'Estado',
                                    displayField: 'nombre',
                                    valueField: 'valor',
                                    store: new Ext.data.SimpleStore({
                                        fields: ['nombre', 'valor'],
                                        data: [['Bueno', 'bueno'], ['Regular', 'regular'],
                                                ['Malo', 'malo'], ['Baja', 'baja']]
                                    }),
                                    editable: false,
                                    forceSelection: true,
                                    allowBlank: false
                                },
                                {
                                    xtype: 'datefield',
                                    name: 'fecha_activo_revision',
                                    fieldLabel: 'Fecha de Revisión',
                                    format: 'Y-m-d',
                                    submitFormat: 'Y-m-d'
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textareafield',
                                    name: 'observacion_activo_revision',
                                    fieldLabel: 'Observaciones',
                                    height: 80
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