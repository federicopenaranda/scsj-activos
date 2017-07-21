Ext.define('activos_scsj.store.opciones.UsuarioPrivilegio', {
    extend: 'activos_scsj.store.Base',
    alias: 'store.opciones.usuarioprivilegio',
    requires: [
        'activos_scsj.model.opciones.UsuarioPrivilegio'
    ],
    restPath: 'UsuarioPrivilegio000004',
    // restPath: 'usuarioprivilegio000004', para yii2
    storeId: 'UsuarioPrivilegio',
    model: 'activos_scsj.model.opciones.UsuarioPrivilegio'
});