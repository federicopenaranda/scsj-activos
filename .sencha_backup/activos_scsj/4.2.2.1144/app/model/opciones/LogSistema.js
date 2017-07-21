Ext.define('activos_scsj.model.opciones.LogSistema', {
    extend: 'activos_scsj.model.Base',
	idProperty: 'id_log_sistema',
	fields: [
		{
			name: 'id_log_sistema',
            type: 'int',
            useNull:true 
		},
		{
			name: 'fk_id_usuario',
            type: 'int',
            useNull:true 
		},
		{
			name: 'fecha_hora_log_sistema',
            type: 'string',
            useNull:true 
		},
		{
			name: 'accion_log_sistema',
            type: 'string',
            useNull:true 
		},
		{
			name: 'tabla_log_sistema',
            type: 'string',
            useNull:true 
		},
		{
			name: 'id_registro_log_sistema',
            type: 'int',
            useNull:true 
		}
	]
});
