Ext.define('activos_scsj.model.opciones.ActivoTipo', {
    extend: 'activos_scsj.model.Base',
	idProperty: 'id_activo_tipo',
	fields: [
		{
			name: 'id_activo_tipo',
            type: 'int',
            useNull:true 
		},
		{
			name: 'nombre_activo_tipo',
            type: 'string',
            useNull:true 
		},
		{
			name: 'descripcion_activo_tipo',
            type: 'string',
            useNull:true 
		}
	]
});
