Ext.define('activos_scsj.model.usuario.Usuario', {
    extend: 'activos_scsj.model.Base',
	idProperty: 'id_usuario',
	fields: [
		{
			name: 'id_usuario',
            type: 'int',
            useNull:false 
		},
		{
			name: 'fk_id_unidad',
            type: 'int',
            useNull:false 
		},
		{
			name: 'fk_id_area',
            type: 'int',
            useNull:false 
		},
		{
			name: 'fk_id_departamento',
            type: 'int',
            useNull:false 
		},
		{
			name: 'fk_id_cargo',
            type: 'int',
            useNull:false 
		},
		{
			name: 'primer_nombre_usuario',
            type: 'string',
            useNull:false 
		},
		{
			name: 'segundo_nombre_usuario',
            type: 'string',
            useNull:true 
		},
		{
			name: 'apellido_paterno_usuario',
            type: 'string',
            useNull:false 
		},
		{
			name: 'apellido_materno_usuario',
            type: 'string',
            useNull:true 
		},
		{
			name: 'login_usuario',
            type: 'string',
            useNull:false 
		},
		{
			name: 'contrasena_usuario',
            type: 'string',
            useNull:false 
		},
		{
			name: 'sexo_usuario',
            type: 'string',
            useNull:false 
		},
		{
			name: 'telefono_usuario',
            type: 'string',
            useNull:true 
		},
		{
			name: 'celular_usuario',
            type: 'string',
            useNull:true 
		},
		{
			name: 'correo_usuario',
            type: 'string',
            useNull:true 
		},
		{
			name: 'direccion_usuario',
            type: 'string',
            useNull:true 
		},
		{
			name: 'imagen_usuario',
            type: 'string',
            useNull:true 
		},
		{
			name: 'observaciones_usuario',
            type: 'string',
            useNull:true 
		},
		{
			name: 'fecha_creacion_usuario',
            type: 'string',
            useNull:false 
		},
		{
            name: 'UsuarioTipoUsuario000101',
            type: 'auto'
    	}
	]
});
