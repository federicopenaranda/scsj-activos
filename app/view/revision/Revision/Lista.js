Ext.define('activos_scsj.view.revision.Revision.Lista', {
    extend: 'activos_scsj.view.Base',
    alias: 'widget.revision.revision.lista',
    title: 'Administrar Revision',
    iconCls: 'icon_user',
    store: 'Revision',
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
                            hidden: me.privilegio('crea Revision020204'),
                            itemId: 'add',
                            iconCls: 'icon_add',
                            text: 'Añadir'
                        },
                        {
                            xtype: 'button',
                            hidden: me.privilegio('actualiza Revision020204'),
                            itemId: 'edit',
                            iconCls: 'icon_edit',
                            text: 'Editar'
                        },
                        {
                            xtype: 'button',
                            hidden: me.privilegio('elimina Revision020204'),
                            itemId: 'delete',
                            iconCls: 'icon_delete',
                            text: 'Eliminar'
                        },'->',
                        {
                            xtype: 'button',
                            hidden: me.privilegio('revisa Revision020204'),
                            itemId: 'revisar',
                            iconCls: 'icon_search',
                            text: 'Revisar'
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
    }
});