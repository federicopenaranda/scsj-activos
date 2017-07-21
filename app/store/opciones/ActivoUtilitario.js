Ext.define('activos_scsj.store.opciones.ActivoUtilitario', {
    extend: 'activos_scsj.store.Base',
    alias: 'store.opciones.activoutilitario',
    requires: [
        'activos_scsj.model.opciones.ActivoUtilitario'
    ],
    restPath: 'ActivoUtilitario020104',
    // restPath: 'activoutilitario020104', para yii2
    storeId: 'ActivoUtilitario',
    model: 'activos_scsj.model.opciones.ActivoUtilitario'
});