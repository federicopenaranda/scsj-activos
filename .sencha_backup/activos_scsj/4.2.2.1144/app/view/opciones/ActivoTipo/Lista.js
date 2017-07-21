Ext.define('activos_scsj.view.opciones.ActivoTipo.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.activotipo.lista',
    requires: [
        'Ext.grid.plugin.RowEditing',
        'Ext.toolbar.Paging'
    ],
    minHeight: 250,
    initComponent: function() {
    	var storePrivilegios = Ext.data.StoreManager.lookup('usuario.Privilegio');
		storePrivilegios.load();

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
                        text: 'Nombre Activo Tipo',
                        dataIndex: 'nombre_activo_tipo',
                        editor: {
                            xtype: 'textfield',
                            allowBlack: false
                        }
                    },
					{
                        text: 'Descripcion Activo Tipo',
                        dataIndex: 'descripcion_activo_tipo',
                        editor: {
                            xtype: 'textfield',
                            allowBlack: false
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
                            hidden: me.privilegio('activotipo.add'),
                            itemId: 'add',
                            iconCls: 'icon_add',
                            text: 'Añadir'
                        },
                        {
                            xtype: 'button',
                            hidden: me.privilegio('activotipo.edit'),
                            itemId: 'edit',
                            iconCls: 'icon_edit',
                            text: 'Editar'
                        },
                        {
                            xtype: 'button',
                            hidden: me.privilegio('activotipo.delete'),
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
    
    privilegio: function( opcion ) {
        var storePrivilegios = Ext.data.StoreManager.lookup('usuario.Privilegio');
        var res = storePrivilegios.findRecord('nombre_privilegio_usuario', opcion);
        return ( res !== null ) ? false : true;
    }
});
                
                

