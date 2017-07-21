Ext.define('activos_scsj.model.opciones.Ubicacion', {
    extend: 'activos_scsj.model.Base',
    idProperty: 'id_ubicacion',
    fields: [
        {
            name: 'id_ubicacion',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_unidad',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_ubicacion',
            type: 'string',
            useNull: true
        },
        {
            name: 'nombre_unidad',
            type: 'auto'
        }
    ]
});