Ext.define('activos_scsj.store.activo.ActivoRevision', {
    extend: 'activos_scsj.store.Base',
    alias: 'store.activo.activorevision',
    requires: [
        'activos_scsj.model.activo.ActivoRevision'
    ],
    restPath: 'ActivoRevision020205',
    // restPath: 'activorevision020205', para yii2
    storeId: 'ActivoRevision',
    model: 'activos_scsj.model.activo.ActivoRevision'
});