Ext.define('activos_scsj.view.opciones.ActivoUtilitario.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.activoutilitario.lista',
    requires: [
        'Ext.grid.plugin.RowEditing',
        'Ext.toolbar.Paging'
    ],
    minHeight: 250,
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
                        text: 'Nombre de Utilitario',
                        dataIndex: 'nombre_activo_utilitario',
                        editor: {
                            xtype: 'textfield',
                            allowBlack: false
                        }
                    },
                    {
                        text: 'Código de Utilitario',
                        dataIndex: 'codigo_activo_utilitario',
                        editor: {
                            xtype: 'textfield',
                            allowBlack: false
                        }
                    },
                    {
                        text: 'Clasificación',
                        dataIndex: 'fk_id_activo_clasificacion',
                        flex: .5,
                        editor: {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_activo_clasificacion',
                            displayField: 'nombre_activo_clasificacion',
                            valueField: 'id_activo_clasificacion',
                            store: {
                                type: 'opciones.activoclasificacion'
                            },
                            forceSelection: true,
                            allowBlank: false
                        },
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return record.get('nombre_activo_clasificacion');
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
                            //hidden: me.privilegio('opciones.activoutilitario.add'),
                            itemId: 'add',
                            iconCls: 'icon_add',
                            text: 'Añadir'
                        },
                        {
                            xtype: 'button',
                            //hidden: me.privilegio('opciones.activoutilitario.edit'),
                            itemId: 'edit',
                            iconCls: 'icon_edit',
                            text: 'Editar'
                        },
                        {
                            xtype: 'button',
                            //hidden: me.privilegio('opciones.activoutilitario.delete'),
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