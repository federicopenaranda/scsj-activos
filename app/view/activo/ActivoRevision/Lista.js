Ext.define('activos_scsj.view.activo.ActivoRevision.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.activo.activorevision.lista',
    header: false,
    iconCls: 'icon_user',
    store: {
        type: 'activo.activorevision'
    },
    minHeight: 250,
    initComponent: function () {
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
                        text: 'Estado',
                        dataIndex: 'condicion_activo_revision',
                        renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                            return Ext.String.capitalize(value);
                        }
                    },
                    {
                        text: 'Usuario',
                        dataIndex: 'fk_id_usuario',
                        renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                            return record.get('login_usuario');
                        }
                    },
                    {
                        text: 'Fecha de Revisión',
                        dataIndex: 'fecha_activo_revision',
                        renderer: Ext.util.Format.dateRenderer('Y-m-d')
                    },
                    {
                        text: 'Observacion',
                        dataIndex: 'observacion_activo_revision',
                        hidden: true
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