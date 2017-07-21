Ext.define('activos_scsj.view.activo.Activo.ActivoEntregaLista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.activo.activo.activoentregalista',
    requires: [
        'Ext.toolbar.Paging'
    ],
    minHeight: 250,
    store: 'storeReferencial2',
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
                        text: 'Usuario que Recibió',
                        dataIndex: 'fk_id_usuario_recibio',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            if (value !== null)
                            {
                                if ( record.dirty )
                                {
                                    Ext.data.JsonP.request ({
                                        url: activos_scsj.app.globals.globalServerPath + 'Usuario000101',
                                        params: {
                                            start: '0',
                                            limit: '10',
                                            filter: '[{"property":"id_usuario","value":'+ value + '}]'
                                        },
                                        success: function( response, options ) {
                                            var tmpUE = response.registros[0];
                                            record.set('usuario_recibio', tmpUE.login_usuario);
                                        },
                                        failure: function( response, options ) {
                                            Ext.Msg.alert( 'Atención', 'Un error ocurrió durante su petición. Por favor intente nuevamente.' );
                                        }
                                    });
                                }

                                return record.get('usuario_recibio');
                            }
                            else
                            {
                                return value;
                            }
                        }
                    },
                    {
                        text: 'Fecha Activo Entrega',
                        dataIndex: 'fecha_activo_entrega',
                        xtype: 'datecolumn',
                        format: 'Y-m-d'
                    },
                    {
                        text: 'Estado Activo Entrega',
                        dataIndex: 'estado_activo_entrega',
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