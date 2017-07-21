Ext.define('activos_scsj.Application', {
    name: 'activos_scsj',

    extend: 'Ext.app.Application',
    
    globals: {
        globalTipoUsuario: '',
        globalNombreUsuario: '',
        globalPrivilegios: [],
        globalPrivilegiosCargados: false,
        globalMenuCargado: false,
        //globalServerPath: 'http://200.105.158.70:8080/activos_scsj/yii/index.php/'
        //globalServerPath: 'http://192.168.1.110:8080/activos_scsj/yii/index.php/'
        globalServerPath: 'http://190.181.18.240/activos_scsj/yii/index.php/'
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
        //'activos_scsj.packages.Download.FileDownload',
        'Ext.form.Label',
        'activos_scsj.model.revision.ActivoRevision',
        'Ext.grid.column.Action'
    ],

    views: [
        'Viewport',
        
        /* INICIO: Activo */
        'activo.Activo.Lista',
        'activo.Activo.edit.ActivoForm',
        'activo.Activo.edit.ActivoForm2',
        'activo.Activo.edit.Form',
        'activo.Activo.edit.Window',
        'activo.Activo.edit.tab.Info',
        'activo.Activo.edit.tab.Info2',
        'activo.Activo.search.Form',
        'activo.Activo.search.Window',
        /* FIN: Activo */

        /* INICIO: ActivoEntrega */
        'activo.Activo.ActivoEntregaLista',
        'activo.Activo.edit.ActivoEntregaForm',
        'activo.Activo.edit.ActivoEntregaWindow',
        'activo.Activo.edit.tab.ActivoEntrega',
        /* FIN: ActivoEntrega */

        /* INICIO: ActivoValor */
        'activo.Activo.ActivoValorLista',
        'activo.Activo.edit.ActivoValorForm',
        'activo.Activo.edit.ActivoValorWindow',
        'activo.Activo.edit.tab.ActivoValor',
        /* FIN: ActivoValor */

        /* INICIO: ActivoUbicacion */
        'activo.Activo.ActivoUbicacionLista',
        'activo.Activo.edit.tab.ActivoUbicacion',
        /* FIN: ActivoUbicacion */

        /* INICIO: ActivoRevision */
        'activo.ActivoRevision.Lista',
        'activo.ActivoRevision.edit.Form',
        'activo.ActivoRevision.edit.Window',
        'activo.ActivoRevision.edit.tab.ActivoRevision',
        'activo.ActivoRevision.edit.ActivoRevisionWindow',
        /* FIN: ActivoRevision */
        
        /* INICIO: ActivoRevision */
        'revision.ActivoRevision.Lista',
        'revision.ActivoRevision.ActivoLista',
        'revision.ActivoRevision.edit.Form',
        'revision.ActivoRevision.edit.Window',
        'revision.ActivoRevision.edit.tab.Info',
        'revision.ActivoRevision.edit.tab.Activos',
        'revision.ActivoRevision.edit.ActivoRevisionWindow',
        'revision.ActivoRevision.edit.ActivoRevisionForm',
        /* FIN: ActivoRevision */
        
        /* INICIO: Usuario */
        'usuario.Usuario.Lista',
        'usuario.Usuario.edit.Form',
        'usuario.Usuario.edit.Window',
        'usuario.Usuario.edit.tab.Usuario',
        'usuario.Usuario.edit.tab.Sistema',
        'usuario.Usuario.edit.tab.Unidad',
        'usuario.Usuario.edit.tab.UsuarioTipo',
        'usuario.Usuario.edit.tab.Departamento',
        /* FIN: Usuario */

        'usuario.AsignacionLotes.Lista',
        'usuario.AsignacionLotes.edit.Form',
        'usuario.AsignacionLotes.edit.Window',
        'usuario.AsignacionLotes.edit.tab.Asignacion',
        'usuario.AsignacionLotes.edit.tab.Activo',
        // FIN USUARIO
        
        /* INICIO: Reporte */
        'reporte.Reporte.Lista',
        'reporte.Reporte.edit.Form',
        'reporte.Reporte.edit.Window',
        /* FIN: Reporte */

        /* INICIO: REP001 */
        'reporte.REP001.edit.Form',
        'reporte.REP001.edit.Window',
        /* FIN: REP001 */
        
        
        /* INICIO: Opciones */
	'opciones.ActivoClasificacion.Lista',
	'opciones.ActivoClasificacion.edit.Form',
	'opciones.ActivoClasificacion.edit.Window',
	'opciones.ActivoProveedor.Lista',
	'opciones.ActivoProveedor.edit.Form',
	'opciones.ActivoProveedor.edit.Window',
	'opciones.ActivoUtilitario.Lista',
	'opciones.Area.Lista',
	'opciones.Cargo.Lista',
	'opciones.Departamento.Lista',
	'opciones.Unidad.Lista',
	'opciones.UsuarioPrivilegio.Lista',
	'opciones.UsuarioPrivilegio.edit.Form',
	'opciones.UsuarioPrivilegio.edit.Window',
	'opciones.Ubicacion.Lista',
	'opciones.Ubicacion.edit.Form',
	'opciones.Ubicacion.edit.Window',
        /* FIN: Opciones */

        /* INICIO: Revision */
    	'revision.Revision.Lista',
	'revision.Revision.edit.Form',
	'revision.Revision.edit.Window'
        /* FIN: Revision */
    ],

    controllers: [
        'App',
        'security.Security',
        /*'usuario.UsuarioTipo',*/
        'usuario.Usuario',
        'activo.Activo',
        'activo.ActivoEntrega',
        'activo.ActivoValor',
        'activo.ActivoRevision',
        'activo.ActivoUbicacion',
        
        // OPCIONES
        'opciones.ActivoClasificacion',
        'opciones.ActivoProveedor',
        'opciones.Area',
        'opciones.Cargo',
        'opciones.Departamento',
        'opciones.Unidad',
        'opciones.UsuarioPrivilegio',
        'opciones.Ubicacion',
        'opciones.ActivoUtilitario',
        // FIN OPCIONES
        
        /* INICIO: Revision */
    	'revision.Revision',
        'revision.ActivoRevision',
        /* FIN: Revision */

        
        // REPORTE
        'reporte.Reporte',
        'reporte.REP001'
        // FIN REPORTE
    ],

    stores: [
        'privilegio.Privilegio',
        'usuario.Usuario',
        'usuario.UsuarioTipo',

        // OPCIONES
        'opciones.ActivoClasificacion',
        'opciones.ActivoProveedor',
        'opciones.Area',
        'opciones.Cargo',
        'opciones.Departamento',
        'opciones.Unidad',
        'opciones.UsuarioPrivilegio',
        'opciones.Ubicacion',
        'opciones.ActivoUtilitario',
        // FIN OPCIONES
        
        /* INICIO: Revision */
    	'revision.Revision',
        /* FIN: Revision */
        
        'activo.Activo',
        'activo.ActivoEntrega',
        'activo.ActivoValor',
        'activo.ActivoRevision',
        'activo.ActivoUbicacion',

        // REPORTE
        'reporte.Reporte'
        // FIN REPORTE
    ],
    
    

    launch: function(args) {
        // "this" = Ext.app.Application
        var me = this,
            storePrivilegios = Ext.data.StoreManager.lookup('privilegio.Privilegio');
    
        storePrivilegios.load( function (records, operation, success ) {
                activos_scsj.app.globals.globalPrivilegiosCargados = true;
        });
        
        // init Ext.util.History on app launch; if there is a hash in the url,
        // our controller will load the appropriate content
        Ext.util.History.init(function() {
            var hash = document.location.hash;
            me.getAppController().fireEvent('tokenchange', hash.replace('#', ''));
        });
        
        // add change handler for Ext.util.History; when a change in the token
        // occurs, this will fire our controller's event to load the appropriate content
        Ext.util.History.on('change', function(token) {
            me.getAppController().fireEvent('tokenchange', token);
        });
        
        
        Ext.getBody().mask('Cargando Privilegios ...');

        
        var tmpUsuario = [];

        // Se obtiene el ID, tipo y nombre de usuario
        Ext.data.JsonP.request ({
            url: activos_scsj.app.globals.globalServerPath + 'Permisos/tipousuario',
            success: function( response, options ) {
                tmpUsuario = response.registros[0];

                activos_scsj.app.globals.globalTipoUsuario = tmpUsuario.nombre_usuario_tipo;
                activos_scsj.app.globals.globalNombreUsuario = tmpUsuario.login_usuario;
            },
            failure: function( response, options ) {
                Ext.Msg.alert( 'Atenci&oacute;n', 'Un error ocurri&oacute; durante su petici&oacute;n. Por favor intente nuevamente.' );
            }
        });
    }
});
