Ext.define('activos_scsj.view.revision.ActivoRevision.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.revision.activorevision.edit.form',
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
                margins: 5
            },
            items: [
                {
                    xtype: 'tabpanel',
                    bodyPadding: 5,
                    deferredRender: true,
                    items: [
                        {
                            xtype: 'revision.activorevision.edit.tab.info',
                            title: 'Filtros de Activos'
                        },
                        {
                            xtype: 'revision.ativorevision.edit.tab.activos',
                            title: 'Activos a Revisar'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});