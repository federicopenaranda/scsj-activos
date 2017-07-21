Ext.define('activos_scsj.model.opciones.ActivoProveedor', {
    extend: 'activos_scsj.model.Base',
	idProperty: 'id_activo_proveedor',
	fields: [
		{
			name: 'id_activo_proveedor',
            type: 'int',
            useNull:true 
		},
		{
			name: 'nombre_activo_proveedor',
            type: 'string',
            useNull:true 
		},
		{
			name: 'nit_activo_proveedor',
            type: 'string',
            useNull:true 
		},
		{
			name: 'direccion_activo_proveedor',
            type: 'string',
            useNull:true 
		},
		{
			name: 'observaciones_activo_proveedor',
            type: 'string',
            useNull:true 
		},
		{
			name: 'telefono1_activo_proveedor',
            type: 'string',
            useNull:true 
		},
		{
			name: 'telefono2_activo_proveedor',
            type: 'string',
            useNull:true 
		}
	]
});
