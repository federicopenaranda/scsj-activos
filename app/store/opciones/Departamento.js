Ext.define('activos_scsj.store.opciones.Departamento', {
    extend: 'activos_scsj.store.Base',
    alias: 'store.opciones.departamento',
    requires: [
        'activos_scsj.model.opciones.Departamento'
    ],
    restPath: 'Departamento010004',
    // restPath: 'departamento010004', para yii2
    storeId: 'Departamento',
    model: 'activos_scsj.model.opciones.Departamento'
});