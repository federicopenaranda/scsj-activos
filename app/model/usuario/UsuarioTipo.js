Ext.define('activos_scsj.model.usuario.UsuarioTipo', {
    extend: 'activos_scsj.model.Base',
    idProperty: 'id_usuario_tipo',
    fields: [
        {
            name: 'id_usuario_tipo',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_usuario_tipo',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_usuario_tipo',
            type: 'string',
            useNull: true
        },
        /*
         * Campos de tablas foraneas
         */
        {
            name: 'usuariotipoprivilegio',
            type: 'auto'
        },
        {
            name: 'usuarioprivilegio',
            type: 'auto'
        }
    ]
});