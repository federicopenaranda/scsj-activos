Ext.define('activos_scsj.store.opciones.Ubicacion', {
    extend: 'activos_scsj.store.Base',
    alias: 'store.opciones.ubicacion',
    requires: [
        'activos_scsj.model.opciones.Ubicacion'
    ],
    restPath: 'Ubicacion020104',
    // restPath: 'ubicacion020104', para yii2
    storeId: 'Ubicacion',
    model: 'activos_scsj.model.opciones.Ubicacion'
});