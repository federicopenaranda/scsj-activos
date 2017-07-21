Ext.define('activos_scsj.model.activo.Activo', {
    extend: 'activos_scsj.model.Base',
    idProperty: 'id_activo',
    fields: [
        {
            name: 'id_activo',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_proveedor',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_activo_tipo',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_activo_clasificacion',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_activo_utilitario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_unidad',
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
            name: 'codigo_activo',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_activo',
            type: 'string',
            useNull: true
        },
        {
            name: 'cantidad_activo',
            type: 'float',
            useNull: true
        },
        {
            name: 'piezas_activo',
            type: 'float',
            useNull: true
        },
        {
            name: 'fecha_adquisicion_activo',
            type: 'date',
            useNull: true
        },
        {
            name: 'fecha_baja_activo',
            type: 'date',
            useNull: true
        },
        {
            name: 'precio_adquisicion_activo',
            type: 'float',
            useNull: true
        },
        {
            name: 'garantia_meses_activo',
            type: 'int',
            useNull: true
        },
        {
            name: 'archivo_foto_activo',
            type: 'string',
            useNull: true
        },
        /*
         * Campos de tablas foraneas
         */
        {
            name: 'activo_entrega_02_01_03',
            type: 'auto'
        },
        {
            name: 'activo_ubicacion_02_01_03',
            type: 'auto'
        },
        {
            name: 'nombre_activo_clasificacion',
            type: 'auto'
        },
        {
            name: 'nombre_activo_tipo',
            type: 'auto'
        },
        {
            name: 'nombre_activo_proveedor',
            type: 'auto'
        }
    ]
});