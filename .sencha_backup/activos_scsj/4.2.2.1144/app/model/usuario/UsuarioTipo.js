Ext.define('activos_scsj.model.usuario.UsuarioTipo', {
    extend: 'activos_scsj.model.Base',
	idProperty: 'id_usuario_tipo',
	fields: [
		{
			name: 'id_usuario_tipo',
            type: 'int',
            useNull:false 
		},
		{
			name: 'nombre_usuario_tipo',
            type: 'string',
            useNull:false 
		},
		{
			name: 'descripcion_usuario_tipo',
            type: 'string',
            useNull:true 
		},
		{
            name: 'UsuarioTipoPrivilegio000201',
            type: 'auto'
    	}
	]
});
