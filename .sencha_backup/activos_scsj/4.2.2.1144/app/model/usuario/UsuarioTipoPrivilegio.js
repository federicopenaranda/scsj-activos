Ext.define('activos_scsj.model.usuario.UsuarioTipoPrivilegio', {
    extend: 'activos_scsj.model.Base',
	idProperty: 'id_usuario_tipo_privilegio',
	fields: [
		{
			name: 'id_usuario_tipo_privilegio',
            type: 'int',
            useNull:true 
		},
		{
			name: 'fk_id_usuario_tipo',
            type: 'int',
            useNull:true 
		},
		{
			name: 'fk_id_usuario_privilegio',
            type: 'int',
            useNull:true 
		}
	]
});
