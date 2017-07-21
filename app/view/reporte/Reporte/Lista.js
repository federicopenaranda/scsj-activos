Ext.define('activos_scsj.view.reporte.Reporte.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.reporte.reporte.lista',
    title: 'Administrar Reportes',
    iconCls: 'icon_user',
    store: 'Reporte',
    minHeight: 250,
    initComponent: function () {
        var me = this;
        Ext.applyIf(me, {
            columns: {
                defaults: {
                    flex: .1
                },
                items: [
                    {
                        text: 'Código',
                        dataIndex: 'codigo_reporte'
                    },
                    {
                        text: 'Nombre',
                        dataIndex: 'nombre_reporte'
                    },
                    {
                        text: 'Estado',
                        dataIndex: 'estado_reporte',
                        renderer: function (valor) {
                            if (valor === 1)
                                return 'Habilitado';

                            if (valor === 0)
                                return 'Deshabilitado';

                            return '';
                        }
                    },
                    {
                        text: 'Ruta',
                        dataIndex: 'ruta_reporte'
                    },
                    {
                        text: 'Tipo',
                        dataIndex: 'tipo_reporte',
                        renderer: function (valor) {
                            return Ext.util.Format.capitalize(valor);
                        }
                    },
                    {
                        text: 'Descripción',
                        dataIndex: 'descripcion_reporte',
                        flex: .3
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
                        },'->',
                        {
                            xtype: 'button',
                            //hidden: me.privilegio('opciones.activoproveedor.delete'),
                            itemId: 'generar',
                            iconCls: 'icon_make',
                            text: 'Generar'
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