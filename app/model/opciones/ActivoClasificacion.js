Ext.define('activos_scsj.model.opciones.ActivoClasificacion', {
    extend: 'activos_scsj.model.Base',
    idProperty: 'id_activo_clasificacion',
    fields: [
        {
            name: 'id_activo_clasificacion',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_activo_clasificacion',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_activo_clasificacion',
            type: 'string',
            useNull: true
        },
        {
            name: 'coeficiente_depreciacion_activo_clasificacion',
            type: 'float',
            useNull: true
        },
        {
            name: 'anos_vida_util_activo_clasificacion',
            type: 'int',
            useNull: true
        },
        {
            name: 'codigo_activo_clasificacion',
            type: 'string',
            useNull: true
        }
    ]
});