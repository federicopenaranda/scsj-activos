Ext.define('activos_scsj.model.opciones.Cargo', {
    extend: 'activos_scsj.model.Base',
    idProperty: 'id_cargo',
    fields: [
		{
			name: 'id_cargo',
			type: 'int',
			useNull: true
        },
		{
			name: 'nombre_cargo',
			type: 'string',
			useNull: true
        },
		{
			name: 'descripcion_cargo',
			type: 'string',
			useNull: true
        }
	]
});