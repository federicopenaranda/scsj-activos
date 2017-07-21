Ext.define('activos_scsj.view.usuario.AsignacionLotes.edit.Window', {
    extend: 'Ext.window.Window',
    alias: 'widget.usuario.asignacionlotes.edit.window',
    iconCls: 'icon_user',
    width: 800,
    height: 350,
    modal: true,
    resizable: true,
    draggable: true,
    constrainHeader: true,
    layout: 'fit',
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'usuario.asignacionlotes.lista'
                }
            ]
        });
        me.callParent(arguments);
    }
});