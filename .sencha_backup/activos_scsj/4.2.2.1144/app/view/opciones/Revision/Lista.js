Ext.define('activos_scsj.view.opciones.Revision.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.revision.lista',
    title: 'Administrar Revision',
    iconCls: 'icon_user',
    store: 'Revision',
    minHeight: 250,
    initComponent: function() {
    	var storePrivilegios = Ext.data.StoreManager.lookup('usuario.Privilegio');
		storePrivilegios.load();

        var me = this;
        Ext.applyIf(me, {
            columns: {
                defaults: {
                	flex: .2
                },
                items: [
					{
						text: 'Fecha Inicio Revision',
                    	dataIndex: 'fecha_inicio_revision',
						renderer: Ext.util.Format.dateRenderer('Y-m-d')
                    },
					{
						text: 'Fecha Fin Revision',
                    	dataIndex: 'fecha_fin_revision',
						renderer: Ext.util.Format.dateRenderer('Y-m-d')
                    },
					{
                        text: 'Observaciones Revision',
                        dataIndex: 'observaciones_revision'
                    },
					{
                        text: 'Descripcion Revision',
                        dataIndex: 'descripcion_revision'
                    },
					{
						text: 'Estado Revision',
                    	dataIndex: 'estado_revision',
						renderer: function (valor) {
                            return (valor === 1 ) ? 'Activo' : 'Inactivo';
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
                            hidden: me.privilegio('revision.add'),
                            itemId: 'add',
                            iconCls: 'icon_add',
                            text: 'Añadir'
                        },
                        {
                            xtype: 'button',
                            hidden: me.privilegio('revision.edit'),
                            itemId: 'edit',
                            iconCls: 'icon_edit',
                            text: 'Editar'
                        },
                        {
                            xtype: 'button',
                            hidden: me.privilegio('revision.delete'),
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
                
                

