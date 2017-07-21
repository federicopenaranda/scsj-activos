Ext.define('activos_scsj.model.usuario.UsuarioTipoUsuario', {
    extend: 'activos_scsj.model.Base',
	idProperty: 'id_usuario_tipo_usuario',
	fields: [
		{
			name: 'id_usuario_tipo_usuario',
            type: 'int',
            useNull:true 
		},
		{
			name: 'fk_id_usuario_tipo',
            type: 'int',
            useNull:true 
		},
		{
			name: 'fk_id_usuario',
            type: 'int',
            useNull:true 
		}
	]
});
