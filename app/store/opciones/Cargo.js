Ext.define('activos_scsj.store.opciones.Cargo', {
    extend: 'activos_scsj.store.Base',
    alias: 'store.opciones.cargo',
    requires: [
        'activos_scsj.model.opciones.Cargo'
    ],
    restPath: 'Cargo010004',
    // restPath: 'cargo010004', para yii2
    storeId: 'Cargo',
    model: 'activos_scsj.model.opciones.Cargo'
});