Ext.define('activos_scsj.model.activo.ActivoEntrega', {
    extend: 'activos_scsj.model.Base',
    idProperty: 'id_activo_entrega',
    fields: [
        {
            name: 'id_activo_entrega',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_activo',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_usuario_recibio',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_usuario_entrego',
            type: 'int',
            useNull: true
        },
        {
            name: 'fecha_activo_entrega',
            type: 'date',
            useNull: true
        },
        {
            name: 'estado_activo_entrega',
            type: 'int',
            useNull: true
        },
        {
            name: 'codigo_activo',
            type: 'auto'
        },
        {
            name: 'usuario_recibio',
            type: 'auto'
        },
        {
            name: 'usuario_entrego',
            type: 'auto'
        }
    ]
});