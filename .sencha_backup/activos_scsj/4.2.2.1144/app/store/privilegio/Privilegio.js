Ext.define('activos_scsj.store.privilegio.Privilegio', {
    extend: 'activos_scsj.store.Base',
    alias: 'store.privilegio.privilegio',
    requires: [
        'activos_scsj.model.privilegio.Privilegio'
    ],
    restPath: 'Usuario000100/listaPrivilegiosUsuario',
    storeId: 'Privilegio',
    model: 'activos_scsj.model.privilegio.Privilegio'
});