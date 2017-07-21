Ext.define('activos_scsj.model.opciones.Departamento', {
    extend: 'activos_scsj.model.Base',
	idProperty: 'id_departamento',
	fields: [
		{
			name: 'id_departamento',
            type: 'int',
            useNull:true 
		},
		{
			name: 'nombre_departamento',
            type: 'string',
            useNull:true 
		},
		{
			name: 'descripcion_departamento',
            type: 'string',
            useNull:true 
		}
	]
});
