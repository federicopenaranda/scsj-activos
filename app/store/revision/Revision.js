Ext.define('activos_scsj.store.revision.Revision', {
    extend: 'activos_scsj.store.Base',
    alias: 'store.revision.revision',
    requires: [
        'activos_scsj.model.revision.Revision'
    ],
    restPath: 'Revision020204',
    // restPath: 'revision020204', para yii2
    storeId: 'Revision',
    model: 'activos_scsj.model.revision.Revision'
});