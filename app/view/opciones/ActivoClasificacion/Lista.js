Ext.define('activos_scsj.view.opciones.ActivoClasificacion.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.activoclasificacion.lista',
    title: 'Administrar ActivoClasificacion',
    iconCls: 'icon_user',
    store: 'ActivoClasificacion',
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
                        text: 'Nombre de Clasificación',
                        dataIndex: 'nombre_activo_clasificacion'
                    },
                    {
                        text: 'Código de Clasificación',
                        dataIndex: 'codigo_activo_clasificacion'
                    },
                    {
                        text: 'Descripción de Clasificación',
                        dataIndex: 'descripcion_activo_clasificacion'
                    },
                    {
                        text: 'Coeficiente de Depreciación',
                        dataIndex: 'coeficiente_depreciacion_activo_clasificacion'
                    },
                    {
                        text: 'Años de Vida Util',
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
                            //hidden: me.privilegio('opciones.activoclasificacion.add'),
                            itemId: 'add',
                            iconCls: 'icon_add',
                            text: 'Añadir'
                        },
                        {
                            xtype: 'button',
                            //hidden: me.privilegio('opciones.activoclasificacion.edit'),
                            itemId: 'edit',
                            iconCls: 'icon_edit',
                            text: 'Editar'
                        },
                        {
                            xtype: 'button',
                            //hidden: me.privilegio('opciones.activoclasificacion.delete'),
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