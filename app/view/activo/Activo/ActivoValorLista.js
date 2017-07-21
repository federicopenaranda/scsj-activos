Ext.define('activos_scsj.view.activo.Activo.ActivoValorLista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.activo.activo.activovalorlista',
    requires: [
        'Ext.toolbar.Paging'
    ],
    minHeight: 250,
    store: 'ActivoValor',
    initComponent: function () {

        var me = this;
        Ext.applyIf(me, {
            selType: 'rowmodel',
            columns: {
                defaults: {
                    flex: 1
                },
                sortAscText: 'Ordenar Ascendentemente',
                sortDescText: 'Ordenar Descendentemente',
                columnsText: 'Columnas',
                items: [
                    {
                        text: 'Valor',
                        dataIndex: 'valor_activo_valor',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return 'Bs.' + value;
                        }
                    },
                    {
                        text: 'Fecha de Valoración',
                        dataIndex: 'fecha_valoracion_activo_valor',
                        xtype: 'datecolumn',
                        format: 'Y-m-d'
                    },
                    {
                        text: 'Estado de Valor',
                        dataIndex: 'estado_activo_valor',
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
                }
            ]
        });
        me.callParent(arguments);
    }
});