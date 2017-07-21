Ext.define('activos_scsj.view.opciones.ActivoProveedor.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.activoproveedor.lista',
    title: 'Administrar ActivoProveedor',
    iconCls: 'icon_user',
    store: 'ActivoProveedor',
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
                        text: 'Nombre Activo Proveedor',
                        dataIndex: 'nombre_activo_proveedor'
                    },
					{
                        text: 'Nit Activo Proveedor',
                        dataIndex: 'nit_activo_proveedor'
                    },
					{
                        text: 'Direccion Activo Proveedor',
                        dataIndex: 'direccion_activo_proveedor'
                    },
					{
                        text: 'Observaciones Activo Proveedor',
                        dataIndex: 'observaciones_activo_proveedor'
                    },
					{
                        text: 'Telefono1 Activo Proveedor',
                        dataIndex: 'telefono1_activo_proveedor'
                    },
					{
                        text: 'Telefono2 Activo Proveedor',
                        dataIndex: 'telefono2_activo_proveedor'
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
                            hidden: me.privilegio('activoproveedor.add'),
                            itemId: 'add',
                            iconCls: 'icon_add',
                            text: 'Añadir'
                        },
                        {
                            xtype: 'button',
                            hidden: me.privilegio('activoproveedor.edit'),
                            itemId: 'edit',
                            iconCls: 'icon_edit',
                            text: 'Editar'
                        },
                        {
                            xtype: 'button',
                            hidden: me.privilegio('activoproveedor.delete'),
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
                
                

