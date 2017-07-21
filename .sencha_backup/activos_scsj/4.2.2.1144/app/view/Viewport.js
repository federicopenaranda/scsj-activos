Ext.define('activos_scsj.view.Viewport', {
    extend: 'Ext.container.Viewport',
    requires:[
        'Ext.layout.container.Border',
        'activos_scsj.view.layout.North',
        'activos_scsj.view.layout.West',
        'activos_scsj.view.layout.Center'
    ],
    layout: {
        type: 'border'
    },
    items: [
        {xtype: 'layout.north'},
        {xtype: 'layout.west'},
        {xtype: 'layout.center'}
    ]
});
