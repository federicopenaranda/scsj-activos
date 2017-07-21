Ext.define('activos_scsj.view.revision.ActivoRevision.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.revision.activorevision.lista',
    title: 'Administrar Revision de Activos',
    iconCls: 'icon_user',
    store: 'ActivoRevision',
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
                        text: 'Fecha de Inicio',
                        dataIndex: 'fecha_inicio_revision',
                        renderer: Ext.util.Format.dateRenderer('Y-m-d')
                    },
                    {
                        text: 'Fecha de Fin',
                        dataIndex: 'fecha_fin_revision',
                        renderer: Ext.util.Format.dateRenderer('Y-m-d')
                    },
                    {
                        text: 'Observaciones',
                        dataIndex: 'observaciones_revision'
                    },
                    {
                        text: 'Descripción',
                        dataIndex: 'descripcion_revision'
                    },
                    {
                        text: 'Estado',
                        dataIndex: 'estado_revision',
                        renderer: function (valor) {
                            if (valor === 1)
                                return 'Habilitado';

                            if (valor === 0)
                                return 'Deshabilitado';

                            return '';
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
                            //hidden: me.privilegio('revision.revision.add'),
                            itemId: 'add',
                            iconCls: 'icon_add',
                            text: 'Añadir'
                        },
                        {
                            xtype: 'button',
                            //hidden: me.privilegio('revision.revision.edit'),
                            itemId: 'edit',
                            iconCls: 'icon_edit',
                            text: 'Editar'
                        },
                        {
                            xtype: 'button',
                            //hidden: me.privilegio('revision.revision.delete'),
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