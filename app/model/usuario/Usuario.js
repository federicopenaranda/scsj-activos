Ext.define('activos_scsj.model.usuario.Usuario', {
    extend: 'activos_scsj.model.Base',
    idProperty: 'id_usuario',
    fields: [
        {
            name: 'id_usuario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_area',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_departamento',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_cargo',
            type: 'int',
            useNull: true
        },
        {
            name: 'primer_nombre_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'segundo_nombre_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'apellido_paterno_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'apellido_materno_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'login_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'contrasena_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'sexo_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'telefono_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'celular_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'correo_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'direccion_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'imagen_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'observaciones_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'fecha_creacion_usuario',
            type: 'auto'
        },
        /*
         * Campos de tablas foraneas
         */
        {
            name: 'usuario_tipo_usuario_00_01_02',
            type: 'auto'
        },
        {
            name: 'usuario_unidad_00_01_02',
            type: 'auto'
        }
    ]
});