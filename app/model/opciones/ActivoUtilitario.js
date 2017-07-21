Ext.define('activos_scsj.model.opciones.ActivoUtilitario', {
    extend: 'activos_scsj.model.Base',
    idProperty: 'id_activo_utilitario',
    fields: [
        {
            name: 'id_activo_utilitario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_activo_clasificacion',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_activo_utilitario',
            type: 'string',
            useNull: true
        },
        {
            name: 'codigo_activo_utilitario',
            type: 'string',
            useNull: true
        },
        {
            name: 'nombre_activo_clasificacion',
            type: 'auto'
        }
    ]
});