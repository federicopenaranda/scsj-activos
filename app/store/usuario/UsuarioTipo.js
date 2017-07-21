Ext.define('activos_scsj.store.usuario.UsuarioTipo', {
    extend: 'activos_scsj.store.Base',
    alias: 'store.usuario.usuariotipo',
    requires: [
        'activos_scsj.model.usuario.UsuarioTipo'
    ],
    restPath: 'UsuarioTipo000201',
    // restPath: 'usuariotipo000201', para yii2
    storeId: 'UsuarioTipo',
    model: 'activos_scsj.model.usuario.UsuarioTipo'
});