Ext.define('activos_scsj.model.opciones.Unidad', {
    extend: 'activos_scsj.model.Base',
    idProperty: 'id_unidad',
    fields: [
        {
            name: 'id_unidad',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_unidad',
            type: 'string',
            useNull: true
        },
        {
            name: 'codigo_unidad',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_unidad',
            type: 'string',
            useNull: true
        }
    ]
});