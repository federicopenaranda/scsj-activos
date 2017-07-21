Ext.define('activos_scsj.view.opciones.ActivoClasificacion.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.activoclasificacion.lista',
    title: 'Administrar ActivoClasificacion',
    iconCls: 'icon_user',
    store: 'ActivoClasificacion',
    minHeight: 250,
    initComponent: function() {
    	var storePrivilegios = Ext.data.StoreManager.lookup('usuario.Privilegio');
		storePrivilegios.load();

        var me = this;
        Ext.applyIf(me, {
            columns: {
                defaults: {
                	flex: .2
                },
                items: [
					{
                        text: 'Nombre Activo Clasificacion',
                        dataIndex: 'nombre_activo_clasificacion'
                    },
					{
                        text: 'Descripcion Activo Clasificacion',
                        dataIndex: 'descripcion_activo_clasificacion'
                    },
					{
						text: 'Coeficiente Depreciacion Activo Clasificacion',
                    	dataIndex: 'coeficiente_depreciacion_activo_clasificacion'
					},
					{
						text: 'Anos Vida Util Activo Clasificacion',
                    	dataIndex: 'anos_vida_util_activo_clasificacion'
					}
				 ]
            },
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'top',
                    ui: 'footer',
                    items: [
                        {
                            xtype: 'button',
                            hidden: me.privilegio('activoclasificacion.add'),
                            itemId: 'add',
                            iconCls: 'icon_add',
                            text: 'Añadir'
                        },
                        {
                            xtype: 'button',
                            hidden: me.privilegio('activoclasificacion.edit'),
                            itemId: 'edit',
                            iconCls: 'icon_edit',
                            text: 'Editar'
                        },
                        {
                            xtype: 'button',
                            hidden: me.privilegio('activoclasificacion.delete'),
                            itemId: 'delete',
                            iconCls: 'icon_delete',
                            text: 'Eliminar'
                        }
                    ]
                },
                {
                    xtype: 'pagingtoolbar',
                    ui: 'footer',
                    defaultButtonUI: 'default',
                    dock: 'bottom',
                    displayInfo: true,
                    store: me.getStore()
                }
            ]
        });
        me.callParent(arguments);
    },
    
    privilegio: function( opcion ) {
        var storePrivilegios = Ext.data.StoreManager.lookup('usuario.Privilegio');
        var res = storePrivilegios.findRecord('nombre_privilegio_usuario', opcion);
        return ( res !== null ) ? false : true;
    }
});
                
                

