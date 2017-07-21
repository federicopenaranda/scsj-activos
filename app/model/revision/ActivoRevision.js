Ext.define('activos_scsj.model.revision.ActivoRevision', {
    extend: 'activos_scsj.model.Base',
    idProperty: 'id_activo_revision',
    fields: [
        {
            name: 'id_activo_revision',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_revision',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_activo',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_usuario',
            type: 'int',
            useNull: true
        },
        {
            name: 'condicion_activo_revision',
            type: 'string',
            useNull: true
        },
        {
            name: 'fecha_activo_revision',
            type: 'date',
            dateFormat: 'Y-m-d',
            useNull: true
        },
        {
            name: 'fecha_creacion_activo_revision',
            type: 'string',
            useNull: true
        },
        {
            name: 'observacion_activo_revision',
            type: 'string',
            useNull: true
        },
        {
            name: 'estado_activo_revision',
            type: 'string',
            useNull: true
        },
        {
            name: 'codigo_activo',
            type: 'auto'
        },
        {
            name: 'descripcion_activo',
            type: 'auto'
        },
        {
            name: 'login_usuario',
            type: 'auto'
        },
        {
            name: 'fk_id_usuario_recibio',
            type: 'int',
            useNull: true
        }
    ]
});