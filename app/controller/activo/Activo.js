Ext.define('activos_scsj.controller.activo.Activo', {
    extend: 'activos_scsj.controller.Base',
    boolActivoEdit: 0,
    stores: [
        'activo.Activo'
    ],
    views: [
        'activo.Activo.Lista',
        'activo.Activo.edit.Form',
        'activo.Activo.edit.Window'
    ],
    refs: [
        {
            ref: 'ActivoLista',
            selector: '[xtype=activo.activo.lista]'
        },
        {
            ref: 'ActivoWindow',
            selector: '[xtype=activo.activo.edit.window]'
        },
        {
            ref: 'ActivoForm',
            selector: '[xtype=activo.activo.edit.form]'
        },
        {
            ref: 'ActivoInfoTab',
            selector: '[xtype=activo.activo.edit.tab.info]'
        },
        {
            ref: 'ActivoInfoTab2',
            selector: '[xtype=activo.activo.edit.tab.info2]'
        },
        {
            ref: 'ActivoSearchWindow',
            selector: '[xtype=activo.activo.search.window]'
        },
        {
            ref: 'ActivoSearchForm',
            selector: '[xtype=activo.activo.search.form]'
        },
        {
            ref: 'ActivoEntregaLista',
            selector: '[xtype=activo.activo.activoentregalista]'
        },
        {
            ref: 'ActivoUbicacionLista',
            selector: '[xtype=activo.activo.activoubicacionlista]'
        },
        {
            ref: 'ActivoValorLista',
            selector: '[xtype=activo.activo.activovalorlista]'
        },
        {
            ref: 'ActivoEntregaWindow',
            selector: '[xtype=activo.activo.edit.activoentregawindows]'
        },
        {
            ref: 'ActivoEntregaForm',
            selector: '[xtype=activo.activo.edit.activoentregaform]'
        },
        {
            ref: 'ActivoEntregaTab',
            selector: '[xtype=activo.activo.edit.tab.activoentrega]'
        },
        {
            ref: 'ActivoUbicacionTab',
            selector: '[xtype=activo.activo.edit.tab.activoubicacion]'
        },
        {
            ref: 'ActivoValorTab',
            selector: '[xtype=activo.activo.edit.tab.activovalor]'
        },
        {
            ref: 'ActivoClasificacionField',
            selector: '[xtype=activo.activo.edit.activoform2] combo#activo_clasificacion'
        },
        {
            ref: 'ActivoUtilitarioField',
            selector: '[xtype=activo.activo.edit.activoform2] combo#activo_utilitario'
        },
        {
            ref: 'ActivoCreacionLotesField',
            selector: '[xtype=activo.activo.edit.activoform] checkbox#activos_creacion_lotes'
        },
        {
            ref: 'ActivoCantidadField',
            selector: '[xtype=activo.activo.edit.activoform] textfield#cantidad_activo'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=activo.activo.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=activo.activo.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=activo.activo.lista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=activo.activo.lista] button#delete': {
                    click: this.remove
                },
                'window[xtype=activo.activo.edit.window] button#save': {
                    click: this.save
                },
                'window[xtype=activo.activo.edit.window] button#cancel': {
                    click: this.close
                },
                'grid[xtype=activo.activo.lista] button#search': {
                    click: this.showSearch
                },
                'grid[xtype=activo.activo.lista] menuitem#clear': {
                    click: this.clearSearch
                },
                'window[xtype=activo.activo.search.window] button#search': {
                    click: this.search
                },
                'window[xtype=activo.activo.search.window] button#cancel': {
                    click: this.close
                },
                '[xtype=activo.activo.edit.activoform2] combo#activo_clasificacion': {
                    select: this.filtraUtilitario
                },
                '[xtype=activo.activo.edit.activoform] checkbox#activos_creacion_lotes': {
                    change: this.creacionActivoLotes
                },
                'grid[xtype=activo.activo.lista] menuitem#reporte_activo': {
                    click: this.repActivoInfo
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },


    repActivoInfo: function() {
        var me = this,
                grid = me.getActivoLista(),
                selected = grid.getSelectionModel().getSelection();
        
        if (selected.length === 1)
        {
            var rec = selected[0];
            var data = rec.getData(), src, obj;
            
            obj = {
                url: activos_scsj.app.globals.globalServerPath + 'reporte/repActivoInfo',
                params: {
                    id_activo: data['id_activo']
                }
            };
            
            src = obj.url + (obj.params ? '?' + Ext.urlEncode(obj.params) : '');
            
            Ext.core.DomHelper.append(document.body, {
                tag : 'iframe',
                id : 'downloadIframe',
                frameBorder : 0,
                width : 0,
                height : 0,
                css : 'display:none;visibility:hidden;height:0px;',
                src : src
            });
        }
    },


    creacionActivoLotes: function ( checkbox, newValue, oldValue, eOpts ) {
        var me = this,
                fieldCantidad = me.getActivoCantidadField(),
                tabEntrega = me.getActivoEntregaTab(),
                tabUbicacion = me.getActivoUbicacionTab(),
                tabValor = me.getActivoValorTab();
        
        if (!newValue)
        {
            tabEntrega.setDisabled(false);
            tabUbicacion.setDisabled(false);
            tabValor.setDisabled(false);
            fieldCantidad.setDisabled(true);
        }
        else
        {
            tabEntrega.setDisabled(true);
            tabUbicacion.setDisabled(true);
            tabValor.setDisabled(true);
            fieldCantidad.setDisabled(false);
        }
    },


    filtraUtilitario: function( combo, records, eOpts ) {
        var me = this,
                utilit = me.getActivoUtilitarioField(),
                utStore = utilit.store;
        
        utStore.clearFilter(true);
        utStore.filter("fk_id_activo_clasificacion", combo.getValue());
        utilit.setDisabled(false);
    },


    ///////////////////////////////////////////////
    // [INICIO] Funciones de Búsqueda
    ///////////////////////////////////////////////
    clearSearch: function( button, e, eOpts ) {
        var me = this,
            grid = me.getActivoLista(),
            store = grid.getStore();
        // clear filter
        store.clearFilter( false );
    },


    showSearch: function( button, e, eOpts ) {
        var me = this,
            win = me.getActivoSearchWindow();
        // if window exists, show it; otherwise, create new instance
        if( !win ) {
            win = Ext.widget( 'activo.activo.search.window', {
                title: 'Buscar Activo'
            });
        }
        // show window
        win.show();
    },


    search: function( button, e, eOpts ) {
        var me = this,
            win = me.getActivoSearchWindow(),
            form = win.down( 'form' ),
            grid = me.getActivoLista(),
            store = grid.getStore(),
            values = form.getValues(),
            filters=[];
        // loop over values to create filters
        Ext.Object.each( values, function( key, value, myself ) {
            if( !Ext.isEmpty( value ) ) {
                filters.push({
                    property: key,
                    value: value
                });
            }
        });
        // clear store filters
        store.clearFilter( true );
        store.filter( filters );
        // close window
        win.hide();
    },
    ///////////////////////////////////////////////
    // [FIN] Funciones de Búsqueda
    ///////////////////////////////////////////////


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getActivoLista();
        var records = grid.getSelectionModel().getSelection();

        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        var botonRevision = grid.down("[xtype='toolbar'] button#revision");

        if (records.length > 0)
        {
            botonEdit.enable();
            botonDelete.enable();
            
            Ext.data.JsonP.request({
                url: activos_scsj.app.globals.globalServerPath + 'Revision020204/verificarRevision',
                success: function (response, options) {
                    var tmpUE = response.meta.msg;
                    (tmpUE === 'true') ? botonRevision.enable() : botonRevision.disable();
                },
                failure: function (response, options) {
                    Ext.Msg.alert('Atención', 'Un error ocurrió durante su petición. Por favor intente nuevamente.');
                }
            });
        }
        else
        {
            botonEdit.disable();
            botonDelete.disable();
            botonRevision.disable();
        }
    },


    loadRecords: function(grid, eOpts) {
        var store = grid.getStore();
        store.clearFilter(true);
        store.load();
    },


    edit: function(view, record, item, index, e, eOpts) {
        var me = this,
			grid = me.getActivoLista();
        me.boolActivoEdit = 1;
        var record = grid.getSelectionModel().getSelection()[0];
        // show window
        me.showEditWindow(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('activos_scsj.model.activo.Activo');
        
        me.boolActivoEdit = 0;
        
        // show window
        me.showEditWindow(record);
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getActivoLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                callbacks;
        
        // Valida el formulario
        if ( form.isValid() )
        {
            if ( me.boolActivoEdit === 0 && record.phantom )
            {
                values['activo_entrega_02_01_03'] = me.saveTablaSecundaria(me.getActivoEntregaLista());
                values['activo_ubicacion_02_01_03'] = me.saveTablaSecundaria(me.getActivoUbicacionLista());
                values['activo_valor_02_01_03'] = me.saveTablaSecundaria(me.getActivoValorLista());
            }
            else
            {
                me.getController('activo.ActivoEntrega').sincronizar();
                me.getController('activo.ActivoUbicacion').sincronizar();
                me.getController('activo.ActivoValor').sincronizar();
            }

            record.set(values);

            if (record.dirty) {

                callbacks = {
                    success: function(records, operation) {
                        store.reload();
                        win.close();
                    },
                    failure: function(records, operation) {
                        store.rejectChanges();
                    }
                };

                Ext.getBody().mask('Guardando Activo ...');

                if (record.phantom) {
                    store.rejectChanges();
                    store.add(record);
                }

                store.sync(callbacks);
                grid.getSelectionModel().clearSelections();
            }
        }
        else
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise los datos del formulario.');
            return;
        }
    },
            

    close: function(button, e, eOpts) {
        var win = button.up('window');
        win.close();
    },


    remove: function() {
        var me = this;

        var grid = me.getActivoLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show confirmation before continuing
        Ext.Msg.confirm({
            title: 'Atención',
            msg: '¿Esta seguro que desea eliminar esta Activo?. Esta acción no puede ser deshecha.',
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
                win = me.getActivoWindow(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('activo.activo.edit.window', {
                title: isNew ? 'Añadir Activo' : 'Editar Activo'
            });
        }
        // show window
        win.show();
        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
        
        if ( me.boolActivoEdit === 1 )
        {
            var fieldCantidad = me.getActivoCantidadField(),
                tabEntrega = me.getActivoEntregaTab(),
                tabUbicacion = me.getActivoUbicacionTab(),
                tabValor = me.getActivoValorTab(),
                lote = me.getActivoCreacionLotesField(),
                utilitario = me.getActivoUtilitarioField();

            tabEntrega.setDisabled(false);
            tabUbicacion.setDisabled(false);
            tabValor.setDisabled(false);
            fieldCantidad.setDisabled(true);
            lote.setDisabled(true);
            utilitario.setDisabled(false);
        }
    },


    saveTablaSecundaria: function ( grid ) {
        var store = grid.getStore(),
            records = store.getModifiedRecords();

        // Guarda registros de estado de una xxx nueva
        if (records.length > 0)
        {
            var array = [];

            for (var i = 0; i < records.length; i++) {
                var rec = records[i].getData();
                var tmp = rec;
                array.push(tmp);
            }

            var obj = Ext.encode(array);
            return obj;
        }
        else
        {
            return '';
        }
    },


    cancel: function(editor, context, eOpts) {
        // if the record is a phantom, remove from store and grid
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    }
});