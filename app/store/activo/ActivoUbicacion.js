Ext.define('activos_scsj.store.activo.ActivoUbicacion', {
    extend: 'activos_scsj.store.Base',
    alias: 'store.activo.activoubicacion',
    requires: [
        'activos_scsj.model.activo.ActivoUbicacion'
    ],
    restPath: 'ActivoUbicacion020103',
    // restPath: 'activoubicacion020103', para yii2
    storeId: 'ActivoUbicacion',
    model: 'activos_scsj.model.activo.ActivoUbicacion'
});