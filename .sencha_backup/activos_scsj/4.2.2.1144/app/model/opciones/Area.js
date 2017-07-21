Ext.define('activos_scsj.model.opciones.Area', {
    extend: 'activos_scsj.model.Base',
	idProperty: 'id_area',
	fields: [
		{
			name: 'id_area',
            type: 'int',
            useNull:true 
		},
		{
			name: 'nombre_area',
            type: 'string',
            useNull:true 
		},
		{
			name: 'descripcion_unidad',
            type: 'string',
            useNull:true 
		}
	]
});
