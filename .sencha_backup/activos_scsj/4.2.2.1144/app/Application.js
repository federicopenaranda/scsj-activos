Ext.define('activos_scsj.Application', {
    name: 'activos_scsj',

    extend: 'Ext.app.Application',
    
    globals: {
        globalTipoUsuario: '',
        globalNombreUsuario: '',
        globalGestionActual: 0,
        //globalServerPath: 'http://200.105.158.70:8080/activos_scsj/yii/index.php/'
        globalServerPath: 'http://192.168.1.110:8080/activos_scsj/yii/index.php/'
    },

    requires: [
        'Ext.data.Store',
        'Ext.layout.container.Form',
        'Ext.form.field.HtmlEditor',
        'Ext.form.field.File',
        'Ext.form.FieldSet',
        'Ext.grid.column.Date',
        'Ext.grid.column.Template',
        'Ext.tab.Panel',
        'Ext.util.History',
        'Ext.data.proxy.JsonP',
        'Ext.grid.column.Boolean',
        'Ext.form.field.ComboBox',
        'Ext.form.field.Date',
        //'activos_scsj.overrides.grid.RowEditor',
        'activos_scsj.domain.Proxy',
        'activos_scsj.ux.form.field.plugin.ClearTrigger',
        'Ext.ux.form.ItemSelector',
        'Ext.ux.window.Notification',
        'activos_scsj.packages.Download.DescargaArchivo',
        'Ext.form.Label'
    ],

    views: [
        'Viewport',
        'usuario.TipoUsuario.Lista',
        'usuario.UsuarioPrivilegio.edit.Form',
        'usuario.UsuarioPrivilegio.edit.Window',
        'usuario.UsuarioPrivilegio.Lista',
        'usuario.edit.tab.Sistema',
        'usuario.edit.tab.Usuario',
        'usuario.edit.Form',
        'usuario.edit.Window',
        'usuario.Lista',
        'opciones.ActivoClasificacion.Lista',
        'opciones.ActivoClasificacion.edit.Form',
        'opciones.ActivoClasificacion.edit.Window',
        'opciones.ActivoEstado.Lista',
        'opciones.ActivoProveedor.Lista',
        'opciones.ActivoProveedor.edit.Form',
        'opciones.ActivoProveedor.edit.Window',
        'opciones.ActivoTipo.Lista',
        'opciones.Area.Lista',
        'opciones.Cargo.Lista',
        'opciones.Departamento.Lista',
        'opciones.Revision.Lista',
        'opciones.Revision.edit.Form',
        'opciones.Revision.edit.Window',
        'opciones.Unidad.Lista'
    ],

    controllers: [
        'App',
        'usuario.PrivilegiosUsuario',
        'usuario.TipoUsuario',
        'usuario.Usuario',
        'opciones.ActivoClasificacion',
        'opciones.ActivoEstado',
        'opciones.ActivoProveedor',
        'opciones.ActivoTipo',
        'opciones.Area',
        'opciones.Cargo',
        'opciones.Departamento',
        'opciones.Revision',
        'opciones.Unidad',
        'usuario.UsuarioPrivilegio'
    ],

    stores: [
        'opciones.Activo',
        'opciones.ActivoClasificacion',
        'opciones.ActivoEntrega',
        'opciones.ActivoEstado',
        'opciones.ActivoProveedor',
        'opciones.ActivoRevision',
        'opciones.ActivoTipo',
        'opciones.Area',
        'opciones.Cargo',
        'opciones.Departamento',
        'opciones.Revision',
        'opciones.Unidad',
        'privilegio.Privilegio',
        'usuario.Usuario',
        'usuario.UsuarioPrivilegios',
        'usuario.UsuarioTipo',
        'usuario.UsuarioTipoPrivilegio',
        'usuario.UsuarioTipoUsuario',
        'sistema.LogSistema'
    ],
    
    
    /**
     * launch is called immediately upon availability of our app
     */
    launch: function(args) {
        // "this" = Ext.app.Application
        var me = this;
        // init Ext.util.History on app launch; if there is a hash in the url,
        // our controller will load the appropriate content
        /*Ext.util.History.init(function() {
            var hash = document.location.hash;
            me.getAppController().fireEvent('tokenchange', hash.replace('#', ''));
        })*/
        // add change handler for Ext.util.History; when a change in the token
        // occurs, this will fire our controller's event to load the appropriate content
        /*Ext.util.History.on('change', function(token) {
            me.getAppController().fireEvent('tokenchange', token);
        });*/
        
        var storePrivilegios = Ext.data.StoreManager.lookup('privilegio.Privilegio');
        storePrivilegios.load();
        
        var tmpUsuario = [];
        
        // Se obtiene el ID, tipo y nombre de usuario
        Ext.data.JsonP.request ({
            url: activos_scsj.app.globals.globalServerPath + 'Permisos/tipousuario',
            success: function( response, options ) {
                tmpUsuario = response.registros[0];

                activos_scsj.app.globals.globalTipoUsuario = tmpUsuario.nombre_usuario_tipo;
                activos_scsj.app.globals.globalNombreUsuario = tmpUsuario.login_usuario;
                
                Ext.globalEvents.fireEvent( 'beforeviewportrender' );
            },
            failure: function( response, options ) {
                Ext.Msg.alert( 'Atenci&oacute;n', 'Un error ocurri&oacute; durante su petici&oacute;n. Por favor intente nuevamente.' );
            }
        });
    }
});
