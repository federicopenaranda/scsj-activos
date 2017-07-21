Ext.define('activos_scsj.view.layout.North', {
    extend: 'Ext.panel.Panel',
    // alias allows us to define a custom xtype for this component, which we can use as a shortcut
    // for adding this component as a child of another
    alias: 'widget.layout.north',
    region: 'north',
    bodyPadding: 5,
    html: '<table><tr><td><img id="logo" src="./resources/images/logo2.png" /></td><td><h2>Activos SCSJ</h2></td></tr></table>',
    cls: 'header',
    items: [
        {

        }
    ],
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            
        });
        me.callParent(arguments);
    }
});