Ext.define('activos_scsj.model.privilegio.Privilegio', {
    extend: 'activos_scsj.model.Base',
    idProperty: 'id_privilegios_usuario',
    fields: [
        {
            name: 'id_privilegios_usuario',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_privilegio_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'valor_privilegio_usuario',
            type: 'int',
            useNull: true
        }
    ]
});
