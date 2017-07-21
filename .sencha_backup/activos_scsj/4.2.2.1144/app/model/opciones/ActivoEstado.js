Ext.define('activos_scsj.model.opciones.ActivoEstado', {
    extend: 'activos_scsj.model.Base',
	idProperty: 'id_activo_estado',
	fields: [
		{
			name: 'id_activo_estado',
            type: 'int',
            useNull:true 
		},
		{
			name: 'nombre_activo_estado',
            type: 'string',
            useNull:true 
		},
		{
			name: 'valor_activo_estado',
            type: 'string',
            useNull:true 
		},
		{
			name: 'descripcion_activo_estado',
            type: 'string',
            useNull:true 
		}
	]
});
