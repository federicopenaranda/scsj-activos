Ext.define('activos_scsj.view.revision.ActivoRevision.ActivoLista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.revision.activorevision.activolista',
    requires: [
        'Ext.toolbar.Paging'
    ],
    minHeight: 250,
    maxHeight: 455,
    autoScroll: true,
    store: 'ActivoRevisionEspecial',
    viewConfig: {
        getRowClass: function (record, index) {
            return record.get('estado_activo_revision') === 'revisado' ? 'revisado' : '';
        }
    },
    initComponent: function () {
        var me = this;
        Ext.applyIf(me, {
            selType: 'rowmodel',
            columns: {
                defaults: {
                    flex: .2
                },
                items: [
                    {
                        xtype: 'actioncolumn',
                        flex: .05,
                        //width: '10',
                        items: [
                            {
                                icon: './resources/images/icon/delete.png',
                                tooltip: 'Revisado',
                                handler: function(grid, rowIndex, colIndex) {
                                    me.fireEvent('itemdeletebuttonclick', grid, rowIndex, colIndex);
                                }
                            }
                        ]  
                    },
                    {
                        text: 'Código',
                        dataIndex: 'codigo_activo'
                    },
                    {
                        text: 'Descripción',
                        dataIndex: 'descripcion_activo'
                    },
                    {
                        text: 'Estado',
                        dataIndex: 'condicion_activo_revision'
                    },
                    {
                        text: 'Fecha de Revisión',
                        dataIndex: 'fecha_activo_revision',
                        xtype: 'datecolumn',
                        format: 'Y-m-d'
                    },
                    {
                        text: 'Observaciones',
                        dataIndex: 'observacion_activo_revision',
                        hidden: true
                    },
                    {
                        text: 'Revisión',
                        dataIndex: 'estado_activo_revision',
                        renderer: function( value ) {
                            if (value)
                            {
                                return Ext.String.capitalize (value);
                            }
                            else
                            {
                                return 'Pendiente';
                            }
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
                        /*{
                            xtype: 'button',
                            itemId: 'add',
                            iconCls: 'icon_add',
                            text: 'Añadir'
                        },*/
                        {
                            xtype: 'button',
                            itemId: 'edit',
                            iconCls: 'icon_edit',
                            text: 'Editar'
                        },
                        /*{
                            xtype: 'button',
                            itemId: 'delete',
                            iconCls: 'icon_delete',
                            text: 'Eliminar'
                        },*/ '->',
                        {
                            xtype: 'checkboxfield',
                            itemId: 'pendientes',
                            boxLabel: 'Pendientes'
                        },
                        {
                            xtype: 'label',
                            html: '<strong>Buscar:</strong>'
                        },
                        {
                            xtype: 'textfield',
                            name: 'busqueda_revision',
                            itemId: 'busqueda_revision',
                            enableKeyEvents: true,
                            allowBlank: true,
                            weight: 30
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});