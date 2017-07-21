Ext.define('activos_scsj.store.usuario.Usuario', {
    extend: 'activos_scsj.store.Base',
    alias: 'store.usuario.usuario',
    requires: [
        'activos_scsj.model.usuario.Usuario'
    ],
    restPath: 'Usuario000101',
    // restPath: 'usuario000101', para yii2
    storeId: 'Usuario',
    model: 'activos_scsj.model.usuario.Usuario'
});