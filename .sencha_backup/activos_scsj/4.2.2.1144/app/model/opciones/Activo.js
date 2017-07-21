Ext.define('activos_scsj.model.opciones.Activo', {
    extend: 'activos_scsj.model.Base',
	idProperty: 'id_activo',
	fields: [
		{
			name: 'id_activo',
            type: 'int',
            useNull:false 
		},
		{
			name: 'fk_id_proveedor',
            type: 'int',
            useNull:false 
		},
		{
			name: 'fk_id_activo_tipo',
            type: 'int',
            useNull:false 
		},
		{
			name: 'fk_id_activo_clasificacion',
            type: 'int',
            useNull:false 
		},
		{
			name: 'codigo_activo',
            type: 'string',
            useNull:false 
		},
		{
			name: 'descripcion_activo',
            type: 'string',
            useNull:false 
		},
		{
			name: 'cantidad_activo',
            type: 'double',
            useNull:false 
		},
		{
			name: 'piezas_activo',
            type: 'double',
            useNull:true 
		},
		{
			name: 'fecha_adquisicion_activo',
            type: 'date',
            useNull:false 
		},
		{
			name: 'fecha_baja_activo',
            type: 'date',
            useNull:false 
		},
		{
			name: 'precio_adquisicion_activo',
            type: 'double',
            useNull:false 
		},
		{
			name: 'garantia_meses_activo',
            type: 'int',
            useNull:true 
		},
		{
			name: 'medida_activo',
            type: 'string',
            useNull:true 
		},
		{
			name: 'archivo_foto_activo',
            type: 'string',
            useNull:true 
		},
		{
			name: 'fecha_creacion_activo',
            type: 'string',
            useNull:false 
		}
	]
});
