Ext.define('activos_scsj.model.opciones.ActivoEntrega', {
    extend: 'activos_scsj.model.Base',
	idProperty: 'id_activo_entrega',
	fields: [
		{
			name: 'id_activo_entrega',
            type: 'int',
            useNull:true 
		},
		{
			name: 'fk_id_activo',
            type: 'int',
            useNull:true 
		},
		{
			name: 'fk_id_usuario_recibio',
            type: 'int',
            useNull:true 
		},
		{
			name: 'fk_id_usuario_entrego',
            type: 'int',
            useNull:true 
		},
		{
			name: 'fecha_activo_entrega',
            type: 'date',
            useNull:true 
		},
		{
			name: 'cantidad_activo_entrega',
            type: 'double',
            useNull:true 
		}
	]
});
