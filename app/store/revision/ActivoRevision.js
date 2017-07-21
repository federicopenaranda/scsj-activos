Ext.define('activos_scsj.store.revision.ActivoRevision', {
    extend: 'activos_scsj.store.Base',
    alias: 'store.revision.activorevision',
    requires: [
        'activos_scsj.model.revision.ActivoRevision'
    ],
    restPath: 'ActivoRevisionEspecial',
    // restPath: 'activorevision020205', para yii2
    storeId: 'ActivoRevisionEspecial',
    model: 'activos_scsj.model.revision.ActivoRevision'
});