Ext.define('activos_scsj.store.reporte.Reporte', {
    extend: 'activos_scsj.store.Base',
    alias: 'store.reporte.reporte',
    requires: [
        'activos_scsj.model.reporte.Reporte'
    ],
    restPath: 'Reporte030004',
    // restPath: 'reporte030004', para yii2
    storeId: 'Reporte',
    model: 'activos_scsj.model.reporte.Reporte'
});