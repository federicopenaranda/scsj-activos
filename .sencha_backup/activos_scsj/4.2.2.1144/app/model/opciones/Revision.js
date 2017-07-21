Ext.define('activos_scsj.model.opciones.Revision', {
    extend: 'activos_scsj.model.Base',
	idProperty: 'id_revision',
	fields: [
		{
			name: 'id_revision',
            type: 'int',
            useNull:true 
		},
		{
			name: 'fecha_inicio_revision',
            type: 'date',
            useNull:true 
		},
		{
			name: 'fecha_fin_revision',
            type: 'date',
            useNull:true 
		},
		{
			name: 'observaciones_revision',
            type: 'string',
            useNull:true 
		},
		{
			name: 'descripcion_revision',
            type: 'string',
            useNull:true 
		},
		{
			name: 'estado_revision',
            type: 'int',
            useNull:true 
		}
	]
});
