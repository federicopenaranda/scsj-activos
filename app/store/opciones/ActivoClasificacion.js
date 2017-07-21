Ext.define('activos_scsj.store.opciones.ActivoClasificacion', {
    extend: 'activos_scsj.store.Base',
    alias: 'store.opciones.activoclasificacion',
    requires: [
        'activos_scsj.model.opciones.ActivoClasificacion'
    ],
    restPath: 'ActivoClasificacion020104',
    // restPath: 'activoclasificacion020104', para yii2
    storeId: 'ActivoClasificacion',
    model: 'activos_scsj.model.opciones.ActivoClasificacion'
});