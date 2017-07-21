Ext.define('activos_scsj.store.activo.ActivoEntrega', {
    extend: 'activos_scsj.store.Base',
    alias: 'store.activo.activoentrega',
    requires: [
        'activos_scsj.model.activo.ActivoEntrega'
    ],
    restPath: 'ActivoEntrega020103',
    // restPath: 'activoentrega020103', para yii2
    storeId: 'ActivoEntrega',
    model: 'activos_scsj.model.activo.ActivoEntrega'
});