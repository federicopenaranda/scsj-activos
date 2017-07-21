Ext.define('activos_scsj.view.usuario.AsignacionLotes.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.usuario.asignacionlotes.edit.form',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'activos_scsj.ux.form.field.RemoteComboBox',
        'activos_scsj.view.usuario.AsignacionLotes.Lista'
    ],
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
                    xtype: 'tabpanel',
                    bodyPadding: 5,
                    // set to false to disable lazy render of non-active tabs...IMPORTANT!!!
                    deferredRender: false,
                    items: [
                        {
                            xtype: 'usuario.asignacionlotes.edit.tab.asignacion',
                            title: 'Datos de Asignación'
                        },
                        {
                            xtype: 'usuario.asignacionlotes.edit.tab.activo',
                            title: 'Activos'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});