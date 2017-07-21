Ext.define('activos_scsj.view.usuario.Usuario.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.usuario.usuario.edit.form',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'activos_scsj.ux.form.field.RemoteComboBox',
        'Ext.ux.form.ItemSelector'
    ],
    initComponent: function() {
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
                    xtype: 'tabpanel',
                    bodyPadding: 5,
                    // set to false to disable lazy render of non-active tabs...IMPORTANT!!!
                    deferredRender: false,
                    items: [
                        {
                            xtype: 'usuario.usuario.edit.tab.usuario',
                            title: 'Info. de Usuario'
                        },
                        {
                            xtype: 'usuario.usuario.edit.tab.sistema',
                            title: 'Info. de Sistema'
                        },
                        {
                            xtype: 'usuario.usuario.edit.tab.usuariotipo',
                            title: 'Tipo de Usuario'
                        },
                        {
                            xtype: 'usuario.usuario.edit.tab.unidad',
                            title: 'Unidades Asignadas'
                        },
                        {
                            xtype: 'usuario.usuario.edit.tab.departamento',
                            title: 'Área y Departamento'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});