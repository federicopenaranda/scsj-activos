Ext.define('activos_scsj.model.activo.ActivoUbicacion', {
    extend: 'activos_scsj.model.Base',
    idProperty: 'id_activo_ubicacion',
    fields: [
        {
            name: 'id_activo_ubicacion',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_ubicacion',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_activo',
            type: 'int',
            useNull: true
        },
        {
            name: 'estado_activo_ubicacion',
            type: 'int',
            useNull: true
        },
        {
            name: 'codigo_activo',
            type: 'auto'
        },
        {
            name: 'nombre_ubicacion',
            type: 'auto'
        }
    ]
});