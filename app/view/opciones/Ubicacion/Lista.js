Ext.define('activos_scsj.view.opciones.Ubicacion.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.ubicacion.lista',
    title: 'Administrar Ubicacion',
    iconCls: 'icon_user',
    store: 'Ubicacion',
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
                        text: 'Nombre de Ubicación',
                        dataIndex: 'nombre_ubicacion'
                    },
                    {
                        text: 'Unidad',
                        dataIndex: 'fk_id_unidad',
                        renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                            return record.get('nombre_unidad');
                        }
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
                            //hidden: me.privilegio('opciones.ubicacion.add'),
                            itemId: 'add',
                            iconCls: 'icon_add',
                            text: 'Añadir'
                        },
                        {
                            xtype: 'button',
                            //hidden: me.privilegio('opciones.ubicacion.edit'),
                            itemId: 'edit',
                            iconCls: 'icon_edit',
                            text: 'Editar'
                        },
                        {
                            xtype: 'button',
                            //hidden: me.privilegio('opciones.ubicacion.delete'),
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