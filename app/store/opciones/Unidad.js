Ext.define('activos_scsj.store.opciones.Unidad', {
    extend: 'activos_scsj.store.Base',
    alias: 'store.opciones.unidad',
    requires: [
        'activos_scsj.model.opciones.Unidad'
    ],
    restPath: 'Unidad010004',
    // restPath: 'unidad010004', para yii2
    storeId: 'Unidad',
    model: 'activos_scsj.model.opciones.Unidad'
});