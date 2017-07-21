Ext.define('activos_scsj.model.activo.ActivoValor', {
    extend: 'activos_scsj.model.Base',
    idProperty: 'id_activo_valor',
    fields: [
        {
            name: 'id_activo_valor',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_activo',
            type: 'int',
            useNull: true
        },
        {
            name: 'valor_activo_valor',
            type: 'float',
            useNull: true
        },
        {
            name: 'estado_activo_valor',
            type: 'int',
            useNull: true
        },
        {
            name: 'fecha_valoracion_activo_valor',
            type: 'date',
            useNull: true
        }
    ]
});