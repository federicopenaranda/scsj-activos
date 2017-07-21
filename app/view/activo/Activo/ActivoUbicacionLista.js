Ext.define('activos_scsj.view.activo.Activo.ActivoUbicacionLista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.activo.activo.activoubicacionlista',
    requires: [
        'Ext.grid.plugin.RowEditing',
        'Ext.toolbar.Paging'
    ],
    minHeight: 250,
    store: 'ActivoUbicacion',
    initComponent: function () {
        var me = this;
        Ext.applyIf(me, {
            selType: 'rowmodel',
            plugins: [
                {
                    ptype: 'rowediting',
                    clicksToEdit: 2,
                    saveBtnText: 'Guardar',
                    cancelBtnText: 'Cancelar',
                    errorsText: 'Errores',
                    dirtyText: 'Es necesario guardar o cancelar los cambios.'
                }
            ],
            columns: {
                defaults: {
                    flex: .2
                },
                items: [
                    {
                        text: 'Ubicacion',
                        dataIndex: 'fk_id_ubicacion',
                        editor: {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_ubicacion',
                            displayField: 'nombre_ubicacion',
                            valueField: 'id_ubicacion',
                            store: {
                                type: 'opciones.ubicacion'
                            },
                            forceSelection: true,
                            allowBlank: false
                        },
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            if (value !== null)
                            {
                                if ( record.dirty )
                                {
                                    Ext.data.JsonP.request ({
                                        url: activos_scsj.app.globals.globalServerPath + 'Ubicacion020104',
                                        params: {
                                            start: '0',
                                            limit: '10',
                                            filter: '[{"property":"id_ubicacion","value":'+ value + '}]'
                                        },
                                        success: function( response, options ) {
                                            var tmpUE = response.registros[0];
                                            record.set('nombre_ubicacion', tmpUE.nombre_ubicacion);
                                        },
                                        failure: function( response, options ) {
                                            Ext.Msg.alert( 'Atención', 'Un error ocurrió durante su petición. Por favor intente nuevamente.' );
                                        }
                                    });
                                }

                                return record.get('nombre_ubicacion');
                            }
                            else
                            {
                                return value;
                            }
                        }
                    },
                    {
                        text: 'Estado de Ubicación',
                        dataIndex: 'estado_activo_ubicacion',
                        editor: {
                            xtype: 'combo',
                            name: 'estado_activo_ubicacion',
                            displayField: 'nombre',
                            valueField: 'valor',
                            store: new Ext.data.SimpleStore({
                                fields: ['nombre', 'valor'],
                                data: [['Habilitado', 1], ['Inhabilitado', 0]]
                            }),
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        },
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