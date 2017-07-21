Ext.define('activos_scsj.store.activo.ActivoValor', {
    extend: 'activos_scsj.store.Base',
    alias: 'store.activo.activovalor',
    requires: [
        'activos_scsj.model.activo.ActivoValor'
    ],
    restPath: 'ActivoValor020103',
    // restPath: 'activovalor020103', para yii2
    storeId: 'ActivoValor',
    model: 'activos_scsj.model.activo.ActivoValor'
});