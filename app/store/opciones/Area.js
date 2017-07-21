Ext.define('activos_scsj.store.opciones.Area', {
    extend: 'activos_scsj.store.Base',
    alias: 'store.opciones.area',
    requires: [
        'activos_scsj.model.opciones.Area'
    ],
    restPath: 'Area010004',
    // restPath: 'area010004', para yii2
    storeId: 'Area',
    model: 'activos_scsj.model.opciones.Area'
});