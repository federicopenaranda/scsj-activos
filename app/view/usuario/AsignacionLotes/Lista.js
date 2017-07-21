Ext.define('activos_scsj.view.usuario.AsignacionLotes.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.usuario.asignacionlotes.lista',
    title: 'Administrar Asignación por Lotes a Usuarios',
    iconCls: 'icon_user',
    store: 'ActivoEntrega',
    minHeight: 250,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            columns: {
                defaults: {
                    flex: 1
                },
                sortAscText: 'Ordenar Ascendentemente',
                sortDescText: 'Ordenar Descendentemente',
                columnsText: 'Columnas',
                items: [
                    {
                        text: 'Código',
                        dataIndex: 'codigo_activo'
                    },
                    {
                        text: 'Descripción',
                        dataIndex: 'descripcion_activo'
                    },
                    {
                        text: 'Fecha de Adquisición',
                        dataIndex: 'fecha_adquisicion_activo'
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
                            itemId: 'add',
                            iconCls: 'icon_add',
                            text: 'Añadir'
                        },
                        {
                            xtype: 'button',
                            itemId: 'edit',
                            iconCls: 'icon_edit',
                            text: 'Editar'
                        },
                        {
                            xtype: 'button',
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
    }
});