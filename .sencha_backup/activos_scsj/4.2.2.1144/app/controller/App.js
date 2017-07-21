Ext.define('activos_scsj.controller.App', {
    extend: 'activos_scsj.controller.Base',
    views: [
        'Viewport',
        'layout.Menu',
        'layout.Center',
        'layout.Landing'
    ],
    refs: [
        {
            ref: 'Viewport',
            selector: '[xtype=viewport]'
        },
        {
            ref: 'Menu',
            selector: '[xtype=layout.menu]'
        },
        {
            ref: 'CenterRegion',
            selector: '[xtype=layout.center]'
        }
    ],
    init: function() {
        this.listen({
            controller: {
                  '#App': { tokenchange: this.dispatch }
                //, '#opciones.[MODULO]': {tokenchange: this.dispatch}
            },
            component: {
                'menu[xtype=layout.menu] menuitem': {
                    click: this.addHistory
                }
            },
            global: {
                //aftervalidateloggedin: this.setupApplication
                beforeviewportrender: this.setupApplication
            },
            store: {},
            proxy: {
                '#basejson': {
                    requestcomplete: this.handleRESTResponse
                }
            }
        });
    },
    
    
    /**
     * Entry point for our application. Will render the viewport, and do any other setup required for our application
     */
    setupApplication: function() {
        var me = this;
        // create the viewport, effectively creating the view for our application
        Ext.create('activos_scsj.view.Viewport');
        // init Ext.util.History on app launch; if there is a hash in the url,
        // our controller will load the appropriate content
        Ext.util.History.init(function() {
            var hash = document.location.hash;
            me.fireEvent('tokenchange', hash.replace('#', ''));
        })
        // add change handler for Ext.util.History; when a change in the token
        // occurs, this will fire our controller's event to load the appropriate content
        Ext.util.History.on('change', function(token) {
            me.fireEvent('tokenchange', token);
        });
    },
            
 
    /**
     * Add history token to Ext.util.History
     * @param {Ext.menu.Item} item
     * @param {Object} e
     * @params {Object} opts
     */
    addHistory: function( item, e, opts ) {
        var me = this,
            token = item.itemId;
        Ext.util.History.add( token );
        me.fireEvent( 'tokenchange', token );
    },
    /**
     * Handles token change and directs creation of content in center region
     * @param {String} token
     */
    dispatch: function( token ) {
        var me = this,
            config;
        // switch on token to determine which content to create
        switch( token ) {

            case 'opciones/Unidad':
                config = {
                    xtype: 'opciones.unidad.lista',
                    title: 'Administraci&oacute;n de Unidades',
                    iconCls: 'icon_color',
                    store: Ext.create( 'activos_scsj.store.opciones.Unidad', {
                        pageSize: 10
                    })
                };
                break;

            case 'opciones/Area':
                config = {
                    xtype: 'opciones.area.lista',
                    title: 'Administraci&oacute;n de &Aacute;reas',
                    iconCls: 'icon_color',
                    store: Ext.create( 'activos_scsj.store.opciones.Area', {
                        pageSize: 10
                    })
                };
                break;

            case 'opciones/Departamento':
                config = {
                    xtype: 'opciones.departamento.lista',
                    title: 'Administraci&oacute;n de Departamentos',
                    iconCls: 'icon_color',
                    store: Ext.create( 'activos_scsj.store.opciones.Departamento', {
                        pageSize: 10
                    })
                };
                break;

            case 'opciones/Cargo':
                config = {
                    xtype: 'opciones.cargo.lista',
                    title: 'Administraci&oacute;n de Cargos',
                    iconCls: 'icon_color',
                    store: Ext.create( 'activos_scsj.store.opciones.Cargo', {
                        pageSize: 10
                    })
                };
                break;

            case 'opciones/ActivoEstado':
                config = {
                    xtype: 'opciones.activoestado.lista',
                    title: 'Administraci&oacute;n de Estados de Activo',
                    iconCls: 'icon_color',
                    store: Ext.create( 'activos_scsj.store.opciones.ActivoEstado', {
                        pageSize: 10
                    })
                };
                break;

            case 'opciones/Revision':
                config = {
                    xtype: 'opciones.revision.lista',
                    title: 'Administraci&oacute;n de Revisiones',
                    iconCls: 'icon_color',
                    store: Ext.create( 'activos_scsj.store.opciones.Revision', {
                        pageSize: 10
                    })
                };
                break;

            case 'opciones/ActivoProveedor':
                config = {
                    xtype: 'opciones.activoproveedor.lista',
                    title: 'Administraci&oacute;n de Proveedores',
                    iconCls: 'icon_color',
                    store: Ext.create( 'activos_scsj.store.opciones.ActivoProveedor', {
                        pageSize: 10
                    })
                };
                break;

            case 'opciones/ActivoTipo':
                config = {
                    xtype: 'opciones.activotipo.lista',
                    title: 'Administraci&oacute;n de Tipos de Activo',
                    iconCls: 'icon_color',
                    store: Ext.create( 'activos_scsj.store.opciones.ActivoTipo', {
                        pageSize: 10
                    })
                };
                break;

            case 'opciones/ActivoClasificacion':
                config = {
                    xtype: 'opciones.activoclasificacion.lista',
                    title: 'Administraci&oacute;n de Clasificaciones de Activo',
                    iconCls: 'icon_color',
                    store: Ext.create( 'activos_scsj.store.opciones.ActivoClasificacion', {
                        pageSize: 10
                    })
                };
                break;
            
            default: 
                config = {
                    xtype: 'layout.landing'
                };
                break;
        }
        me.updateCenterRegion( config );
    },
    /**
     * Updates center region of app with passed configuration
     * @param {Object} config
     */
    updateCenterRegion: function( config ) {
        var me = this,
            center = me.getCenterRegion();

        // remove all existing content
        center.removeAll( true );
        // add new content
        center.add( config );
    },
            
    /**
     * After a REST response is completed, this method will marshall the response data and inform 
     * other methods with relevant data
     * @param {Object} request
     * @param {Boolean} success The actual success of the AJAX request. For success of {@link Ext.data.Operation}, 
     * see success property of request.operation
     */
    handleRESTResponse: function(request, success) {
        var me = this,
            rawData = request.proxy.reader.rawData;
        // in all cases, let's hide the body mask
        Ext.getBody().unmask();
        
        // if proxy success
        if (success) {
            // if operation success
            if (request.operation.wasSuccessful()) {

                if ( (typeof rawData.meta) !== "undefined" )
                {
                    Ext.create('widget.uxNotification', {
                        title: 'Notificaci&oacute;n',
                        position: 'tr',
                        manager: 'sismanager1',
                        iconCls: 'ux-notification-icon-information',
                        autoCloseDelay: 4000,
                        spacing: 25,
                        padding: 10,
                        html: rawData.meta.msg
                    }).show();
                    
                    if ( (typeof rawData.meta.sesion) !== "undefined" )
                    {
                        if ( rawData.meta.sesion === "false" )
                        {
                            window.location.href = './index.php';
                        }
                    }
                }
                
            }
            // if operation failure
            else {

                if ( (typeof rawData.meta) !== "undefined")
                {
                    Ext.create('widget.uxNotification', {
                        title: 'Notificaci&oacute;n',
                        position: 'tr',
                        manager: 'sismanager2',
                        iconCls: 'ux-notification-icon-information',
                        autoCloseDelay: 4000,
                        spacing: 25,
                        padding: 10,
                        html: rawData.meta.msg
                    }).show();
                }
            }
        }
        // otherwise, major failure...
        else {
            Ext.create('widget.uxNotification', {
                title: 'Error',
                position: 'tr',
                manager: 'sismanager3',
                iconCls: 'ux-notification-icon-information',
                autoCloseDelay: 4000,
                spacing: 25,
                padding: 10,
                html: 'Error al conectar al servidor.'
            }).show();
        }
    }
});


/*window.onbeforeunload = function() {
    return "¿Esta seguro que desea salir del sistema?. Cualquier dato que no guard&oacute; se perder&aacute;.";
}.bind(this);*/