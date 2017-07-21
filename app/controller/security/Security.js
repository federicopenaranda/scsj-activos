Ext.define('activos_scsj.controller.security.Security', {
    extend: 'activos_scsj.controller.Base',
    requires: [
        'activos_scsj.security.crypto.SHA1'
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'menu[xtype=layout.menu] menuitem#logout': {
                    click: this.doLogout
                }
            },
            global: {
                //beforeviewportrender: this.processLoggedIn
            },
            store: {},
            proxy: {} 
        });
    },

    doLogout: function( button, e, eOpts ) {
        Ext.Msg.confirm({
            title: 'Atención',
            msg: '¿Esta seguro que quiere salir del sistema de Activos SCSJ?',
            icon: Ext.Msg.QUESTION,
            buttonText: {
                yes: 'Salir',
                no: 'Cancelar'
            },
            fn: function(buttonId, text, opt) 
            {
                if (buttonId === 'yes') {
                    Ext.data.JsonP.request({
                        url: activos_scsj.app.globals.globalServerPath + 'Usuario000101/logout',
                        success: function( response, options ) {
                            window.location.href = './index.php';
                        },
                        failure: function( response, options ) {
                            Ext.Msg.alert( 'Atención', 'Un error ocurrió al ingresar. Por favor intenta nuevamente.' );
                        }
                    });
                }
            }
        });
    }
});