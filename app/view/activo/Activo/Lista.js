Ext.define('activos_scsj.view.activo.Activo.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.activo.activo.lista',
    title: 'Administrar Activo',
    iconCls: 'icon_gear',
    store: 'Activo',
    minHeight: 250,
    initComponent: function () {
        var me = this;

        var storePrivilegios = Ext.data.StoreManager.lookup('privilegio.Privilegio');
        storePrivilegios.load();

        Ext.applyIf(me, {
            columns: {
                defaults: {
                    flex: .2
                },
                items: [
                    {
                        text: 'Código',
                        dataIndex: 'codigo_activo'
                    },
                    {
                        text: 'Descripcion',
                        dataIndex: 'descripcion_activo'
                    },
                    {
                        text: 'Precio de Adq.',
                        dataIndex: 'precio_adquisicion_activo',
                        renderer: function (valor) {
                            return 'Bs.' + valor;
                        }
                    },
                    {
                        text: 'Proveedor',
                        dataIndex: 'fk_id_proveedor',
                        renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                            return record.get('nombre_activo_proveedor'); // Debe estar en el modelo
                        }
                    },
                    {
                        text: 'Clasificación',
                        dataIndex: 'fk_id_activo_clasificacion',
                        renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                            return record.get('nombre_activo_clasificacion'); // Debe estar en el modelo
                        }
                    },
                    {
                        text: 'Fecha de Adquisición',
                        dataIndex: 'fecha_adquisicion_activo',
                        renderer: Ext.util.Format.dateRenderer('Y-m-d')
                    },
                    {
                        text: 'Fecha de Baja',
                        dataIndex: 'fecha_baja_activo',
                        renderer: Ext.util.Format.dateRenderer('Y-m-d')
                    },
                    {
                        text: 'Garantia (Meses)',
                        dataIndex: 'garantia_meses_activo'
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
                            //hidden: me.privilegio('activo.add'),
                            itemId: 'add',
                            iconCls: 'icon_add',
                            text: 'Añadir'
                        },
                        {
                            xtype: 'button',
                            //hidden: me.privilegio('activo.edit'),
                            itemId: 'edit',
                            iconCls: 'icon_edit',
                            text: 'Editar'
                        },
                        {
                            xtype: 'button',
                            //hidden: me.privilegio('activo.delete'),
                            itemId: 'delete',
                            iconCls: 'icon_delete',
                            text: 'Eliminar'
                        }, '->',
                        {
                            xtype: 'button',
                            //hidden: me.privilegio('activo.delete'),
                            itemId: 'revision',
                            iconCls: 'icon_gear',
                            text: 'Revisión'
                        },
                        {
                            xtype:'splitbutton',
                            itemId: 'reportes',
                            text: 'Reportes',
                            iconCls: 'icon_gear',
                            menu: [
                                {text: 'Reporte de Activo', itemId: 'reporte_activo'}
                            ]
                        },
                        {
                            xtype:'splitbutton',
                            itemId: 'search',
                            iconCls: 'icon_search',
                            text: 'Buscar',
                            menu: [
                                {text: 'Borrar Filtro', itemId: 'clear'}
                            ]
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