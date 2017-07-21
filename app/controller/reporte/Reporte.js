Ext.define('activos_scsj.controller.reporte.Reporte', {
    extend: 'activos_scsj.controller.Base',
    stores: [
        'reporte.Reporte'
    ],
    views: [
        'reporte.Reporte.Lista',
        'reporte.Reporte.edit.Form',
        'reporte.Reporte.edit.Window'
    ],
    refs: [
        {
            ref: 'ReporteLista',
            selector: '[xtype=reporte.reporte.lista]'
        },
        {
            ref: 'ReporteWindow',
            selector: '[xtype=reporte.reporte.edit.window]'
        },
        {
            ref: 'ReporteForm',
            selector: '[xtype=reporte.reporte.edit.form]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=reporte.reporte.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=reporte.reporte.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=reporte.reporte.lista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=reporte.reporte.lista] button#delete': {
                    click: this.remove
                },
                'grid[xtype=reporte.reporte.lista] button#generar': {
                    click: this.generaReporte
                },
                'window[xtype=reporte.reporte.edit.window] button#save': {
                    click: this.save
                },
                'window[xtype=reporte.reporte.edit.window] button#cancel': {
                    click: this.close
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },
    
    generaReporte: function ( record, index, eOpts ) {
        var me = this,
                grid = me.getReporteLista(),
                record = grid.getSelectionModel().getSelection()[0],
                data = record.getData(),
                codigo = data.codigo_reporte,
                ruta = data.ruta_reporte;

        me.fireEvent(codigo, ruta);
    },
    
    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getReporteLista();
        var records = grid.getSelectionModel().getSelection();

        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        var botonGenera = grid.down("[xtype='toolbar'] button#generar");

        if (records.length > 0)
        {
            botonEdit.enable();
            botonDelete.enable();
            botonGenera.enable();
        }
        else
        {
            botonEdit.disable();
            botonDelete.disable();
            botonGenera.disable();
        }
    },


    loadRecords: function(grid, eOpts) {
        var store = grid.getStore();
        store.clearFilter(true);
        store.load();
    },


    edit: function(view, record, item, index, e, eOpts) {
        var me = this;
        var grid = me.getReporteLista();
        var record = grid.getSelectionModel().getSelection()[0];
        me.showEditWindow(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('activos_scsj.model.reporte.Reporte');
        // show window
        me.showEditWindow(record);
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getReporteLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                callbacks;

        // set values of record from form
        record.set(values);
        // check if form is even dirty...if not, just close window and stop everything...nothing to see here
        if (!record.dirty) {
            win.close();
            return;
        }
        // setup generic callback config for create/save methods
        callbacks = {
            success: function(records, operation) {
                store.reload();
                win.close();
            },
            failure: function(records, operation) {
                // if failure, reject changes in store
                store.rejectChanges();
            }
        };
        
        // mask to prevent extra submits
        Ext.getBody().mask('Guardando Reporte ...');
        // if new record...
        if (record.phantom) {
            // reject any other changes
            store.rejectChanges();
            // add the new record
            store.add(record);
        }
        // persist the record
        store.sync(callbacks);
    },


    close: function(button, e, eOpts) {
        var win = button.up('window');
        // close the window
        win.close();
    },


    remove: function() {
        var me = this;

        var grid = me.getReporteLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show confirmation before continuing
        Ext.Msg.confirm({
            title: 'Atención',
            msg: '¿Esta seguro que desea eliminar este Reporte?. Esta acción no puede ser deshecha.',
            icon: Ext.Msg.QUESTION,
            buttonText: {
                yes: 'Eliminar',
                no: 'Cancelar'
            },
            fn: function(buttonId, text, opt) 
            {
                if (buttonId === 'yes') {
                    store.remove(record);
                    store.sync({
                        failure: function(records, operation) {
                            store.rejectChanges();
                        }
                    });
                }
            }
        });
    },


    showEditWindow: function(record) {
        var me = this,
                win = me.getReporteWindow(),
                isNew = record.phantom;

        if (!win) {
            win = Ext.widget('reporte.reporte.edit.window', {
                title: isNew ? 'Añadir Reporte' : 'Editar Reporte'
            });
        }

        win.show();
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    }
});