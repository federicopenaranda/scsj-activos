Ext.define('activos_scsj.controller.reporte.REP001', {
    extend: 'activos_scsj.controller.Base',
    ruta: '',
    stores: [
        'reporte.Reporte'
    ],
    views: [
        'reporte.REP001.edit.Form',
        'reporte.REP001.edit.Window'
    ],
    refs: [
        {
            ref: 'REP001Form',
            selector: '[xtype=reporte.rep001.edit.form]'
        },
        {
            ref: 'REP001Window',
            selector: '[xtype=reporte.rep001.edit.window]'
        }
    ],
    init: function() {
        this.listen({
            controller: {
                '#reporte.Reporte': {
                    REP001: this.showEditWindow
                }
            },
            component: {
                'window[xtype=reporte.rep001.edit.window] button#save': {
                    click: this.save
                },
                'window[xtype=reporte.rep001.edit.window] button#cancel': {
                    click: this.close
                }},
            global: {},
            store: {},
            proxy: {}
        });
    },


    close: function ( button, e, eOpts ) {
        var win = button.up('window');
        win.close();
    },


    save: function(button, e, eOpts) {
        var me = this,
                win = button.up('window'),
                form = win.down('form'),
                values = form.getValues(),
                obj, src;

        obj = {
            url: activos_scsj.app.globals.globalServerPath + me.ruta,
            params: {
                fecha_min: values.fecha_min,
                fecha_max: values.fecha_max
            }
        };

        src = obj.url + (obj.params ? '?' + Ext.urlEncode(obj.params) : '');

        Ext.core.DomHelper.append(document.body, {
            tag : 'iframe',
            id : 'downloadIframe',
            frameBorder : 0,
            width : 0,
            height : 0,
            css : 'display:none;visibility:hidden;height:0px;',
            src : src
        });
            
        
        /*fd.load({
            url: activos_scsj.app.globals.globalServerPath + me.ruta,
            params: {
                fecha_min: values.fecha_min,
                fecha_max: values.fecha_max
            }
        });*/
        
        win.close();
    },


    showEditWindow: function(ruta) {
        var me = this,
                win = me.getREP001Window();

        me.ruta = ruta;

        if (!win) {
            win = Ext.widget('reporte.rep001.edit.window', {
                title: 'Parámetros de Reporte'
            });
        }

        win.show();
        win.doComponentLayout();
    }
});