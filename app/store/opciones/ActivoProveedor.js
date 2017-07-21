Ext.define('activos_scsj.store.opciones.ActivoProveedor', {
    extend: 'activos_scsj.store.Base',
    alias: 'store.opciones.activoproveedor',
    requires: [
        'activos_scsj.model.opciones.ActivoProveedor'
    ],
    restPath: 'ActivoProveedor020104',
    // restPath: 'activoproveedor020104', para yii2
    storeId: 'ActivoProveedor',
    model: 'activos_scsj.model.opciones.ActivoProveedor'
});