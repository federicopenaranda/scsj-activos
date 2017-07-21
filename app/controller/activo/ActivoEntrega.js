Ext.define('activos_scsj.controller.activo.ActivoEntrega', {
    extend: 'activos_scsj.controller.Base',
    stores: [
        'activo.ActivoEntrega'
    ],
    views: [
        'activo.Activo.ActivoEntregaLista',
        'activo.Activo.edit.ActivoEntregaForm',
        'activo.Activo.edit.ActivoEntregaWindow'
    ],
    refs: [
        {
            ref: 'ActivoEntregaLista',
            selector: '[xtype=activo.activo.activoentregalista]'
        },
        {
            ref: 'ActivoEntregaWindow',
            selector: '[xtype=activo.activo.edit.activoentregawindow]'
        },
        {
            ref: 'ActivoEntregaForm',
            selector: '[xtype=activo.activo.edit.activoentregaform]'
        },
        {
            ref: 'ActivoLista',
            selector: '[xtype=activo.activo.lista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=activo.activo.activoentregalista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=activo.activo.activoentregalista] button#add': {
                    click: this.add
                },
                'grid[xtype=activo.activo.activoentregalista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=activo.activo.activoentregalista] button#delete': {
                    click: this.remove
                },
                'window[xtype=activo.activo.edit.activoentregawindow] button#save': {
                    click: this.save
                },
                'window[xtype=activo.activo.edit.activoentregawindow] button#cancel': {
                    click: this.close
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },


    loadRecords: function(grid, eOpts) {
        var me = this,
                store = grid.getStore(),
                editActivo = me.getController('activo.Activo').boolActivoEdit,
                grid2 = me.getActivoLista(),
                record, data;

        store.clearFilter(true);

        if (editActivo === 1)
        {
            record = grid2.getSelectionModel().getSelection()[0];
            data = record.getData();
            store.filter('fk_id_activo', data['id_activo']);
        }
        else
        {
            store.filter('fk_id_activo', -1);
        }
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getActivoEntregaLista();
        var records = grid.getSelectionModel().getSelection();

        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");

        if (records.length > 0)
        {
            botonEdit.enable();
            botonDelete.enable();
        }
        else
        {
            botonEdit.disable();
            botonDelete.disable();
        }
    },


    cancel: function(editor, context, eOpts) {
        // if the record is a phantom, remove from store and grid
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    },


    edit: function(records, index, node, eOpts) {
        var me = this;

        var grid = me.getActivoEntregaLista();
        var record = grid.getSelectionModel().getSelection()[0];
        // show window
        me.showEditWindow(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
            record = Ext.create('activos_scsj.model.activo.ActivoEntrega');
        
        var grid1 = me.getActivoLista();
        var recSeleccionados = grid1.getSelectionModel().getSelection();
        var contActivo = me.getController('activo.Activo');

        if ( recSeleccionados.length === 1 && contActivo.boolActivoEdit === 1 )
        {
            var record1 = recSeleccionados[0];
            var data1 = record1.getData();

            record.set('fk_id_activo', data1['id_activo']);

            me.showEditWindow(record);
        }
        else
        {
            if ( contActivo.boolActivoEdit === 0 )
            {
                me.showEditWindow(record);
            }
            else
            {
                console.log('[ActivoEntrega] Error al recuperar el ID de la activo');
                return 'Error';
            }
        }
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getActivoEntregaLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues();

        record.set(values);

        if (!record.dirty) {
            win.close();
            return;
        }

        if ( form.isValid() )
        {
            var rowIndex = store.indexOf(record);
            ( rowIndex === -1 ) ? store.add(record) : form.updateRecord(record);

            win.close();
        }
        else
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise los datos del formulario.');
            return;
        }
    },
            

    close: function(button, e, eOpts) {
        var me = this,
                win = button.up('window');
        // close the window
        win.close();
    },


    remove: function() {
        var me = this;
        var grid = me.getActivoEntregaLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];

        var contActivo = me.getController('activo.Activo');

        // Se esta eliminando un registro del grid de Estado Civil
        // pero de un beneficiario nuevo. Solo se quita del store.
        if ( contActivo.boolActivoEdit === 0 )
        {
            store.remove(record);
        }
        // Se esta eliminando un registro del grid de Estado Civil
        // pero de un beneficiario ya creado. Si es un registro recién creado (phantom == true)
        // solo se quita del store. Si no es un registro recién creado se lo quita del store
        // y de la base de datos (sync).
        else
        {
            if ( record.phantom )
            {
                store.remove(record);
            }
            else
            {
                Ext.Msg.confirm({
                    title: 'Atención',
                    msg: '¿Esta seguro que desea eliminar este activoentrega?. Esta acción no puede ser deshecha.',
                    icon: Ext.Msg.QUESTION,
                    buttonText: {
                        yes: 'Eliminar',
                        no: 'Cancelar'
                    },
                    fn: function(buttonId, text, opt) 
                    {
                        if (buttonId === 'yes') {
                            store.remove(record);
                        }
                    }
                });
            }
        }
    },


    showEditWindow: function(record) {
        var me = this,
                win = me.getActivoEntregaWindow(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('activo.activo.edit.activoentregawindow', {
                title: isNew ? 'Añadir Entrega' : 'Editar Entrega'
            });
        }
        // show window
        win.show();
        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    },


    sincronizar: function() {
        var me = this,
                grid = me.getActivoEntregaLista(),
                store = grid.getStore();
        
        store.sync();
    }
});