Ext.define('activos_scsj.view.opciones.ActivoProveedor.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.activoproveedor.lista',
    title: 'Administrar ActivoProveedor',
    iconCls: 'icon_user',
    store: 'ActivoProveedor',
    minHeight: 250,
    initComponent: function () {
        var me = this;
        Ext.applyIf(me, {
            columns: {
                defaults: {
                    flex: .2
                },
                items: [
                    {
                        text: 'Nombre',
                        dataIndex: 'nombre_activo_proveedor'
                    },
                    {
                        text: 'NIT',
                        dataIndex: 'nit_activo_proveedor'
                    },
                    {
                        text: 'Dirección',
                        dataIndex: 'direccion_activo_proveedor'
                    },
                    {
                        text: 'Observaciones',
                        dataIndex: 'observaciones_activo_proveedor'
                    },
                    {
                        text: 'Telefono 1',
                        dataIndex: 'telefono1_activo_proveedor'
                    },
                    {
                        text: 'Telefono 2',
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
                            //hidden: me.privilegio('opciones.activoproveedor.add'),
                            itemId: 'add',
                            iconCls: 'icon_add',
                            text: 'Añadir'
                        },
                        {
                            xtype: 'button',
                            //hidden: me.privilegio('opciones.activoproveedor.edit'),
                            itemId: 'edit',
                            iconCls: 'icon_edit',
                            text: 'Editar'
                        },
                        {
                            xtype: 'button',
                            //hidden: me.privilegio('opciones.activoproveedor.delete'),
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
    
    
    privilegio: function (opcion) {
        var storePrivilegios = Ext.data.StoreManager.lookup('privilegio.Privilegio');
        var res = storePrivilegios.findRecord('nombre_privilegio_usuario', opcion);
        return (res !== null) ? false : true;
    }
});