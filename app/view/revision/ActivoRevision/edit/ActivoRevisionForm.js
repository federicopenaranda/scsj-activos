Ext.define('activos_scsj.view.revision.ActivoRevision.edit.ActivoRevisionForm', {
    extend: 'Ext.form.Panel',
    alias: 'widget.revision.activorevision.edit.activorevisionform',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'activos_scsj.ux.form.field.RemoteComboBox'
    ],
    initComponent: function () {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                allowBlank: false,
                labelAlign: 'top',
                flex: 1,
                margins: 10
            },
            items: [
                {
                    xtype: 'fieldset',
                    title: '<strong>Datos de la Revisión del Activo</strong>',
                    margin: 10,
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
                                    fieldLabel: 'Fecha de Revisión',
                                    name: 'fecha_activo_revision',
                                    format: 'Y-m-d',
                                    allowBlank: false
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textareafield',
                                    fieldLabel: 'Observaciones de la Revisión',
                                    name: 'observacion_activo_revision',
                                    allowBlank: false
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