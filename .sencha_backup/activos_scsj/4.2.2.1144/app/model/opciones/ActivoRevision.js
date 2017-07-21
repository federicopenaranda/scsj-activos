Ext.define('activos_scsj.model.opciones.ActivoRevision', {
    extend: 'activos_scsj.model.Base',
	idProperty: 'id_activo_revision',
	fields: [
		{
			name: 'id_activo_revision',
            type: 'int',
            useNull:false 
		},
		{
			name: 'fk_id_revision',
            type: 'int',
            useNull:false 
		},
		{
			name: 'fk_id_activo',
            type: 'int',
            useNull:false 
		},
		{
			name: 'fk_id_activo_estado',
            type: 'int',
            useNull:false 
		},
		{
			name: 'fk_id_usuario',
            type: 'int',
            useNull:false 
		},
		{
			name: 'valor_activo_revision',
            type: 'double',
            useNull:false 
		},
		{
			name: 'fecha_activo_revision',
            type: 'date',
            useNull:false 
		},
		{
			name: 'ubicacion_activo_revision',
            type: 'string',
            useNull:true 
		}
	]
});
