Ext.define('activos_scsj.model.activo.ActivoRevision', {
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
            type: 'int'
        },
        {
            name: 'fk_id_activo',
            type: 'int'
        },
        {
            name: 'fk_id_usuario',
            type: 'int'
        },
        {
            name: 'fecha_activo_revision',
            type: 'date',
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
            name: 'codigo_ubicacion',
            type: 'auto'
        },
        {
            name: 'login_usuario',
            type: 'auto'
        }
    ]
});