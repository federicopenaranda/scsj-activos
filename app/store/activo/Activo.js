Ext.define('activos_scsj.store.activo.Activo', {
    extend: 'activos_scsj.store.Base',
    alias: 'store.activo.activo',
    requires: [
        'activos_scsj.model.activo.Activo'
    ],
    restPath: 'Activo020101',
    // restPath: 'activo020101', para yii2
    storeId: 'Activo',
    model: 'activos_scsj.model.activo.Activo'
});