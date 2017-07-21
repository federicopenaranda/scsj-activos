Ext.define('activos_scsj.controller.usuario.Usuario', {
    extend: 'activos_scsj.controller.Base',
    boolUsuarioEdit: 0,
    stores: [
        'usuario.Usuario'
    ],
    views: [
        'usuario.Usuario.Lista',
        'usuario.Usuario.edit.Form',
        'usuario.Usuario.edit.Window'
    ],
    refs: [
        {
            ref: 'UsuarioLista',
            selector: '[xtype=usuario.usuario.lista]'
        },
        {
            ref: 'UsuarioWindow',
            selector: '[xtype=usuario.usuario.edit.window]'
        },
        {
            ref: 'UsuarioForm',
            selector: '[xtype=usuario.usuario.edit.form]'
        },
        {
            ref: 'UsuarioSistemaTab',
            selector: '[xtype=usuario.usuario.edit.tab.sistema]'
        },
        {
            ref: 'UsuarioPassword1Form',
            selector: '[xtype=usuario.usuario.edit.form] textfield#password1'
        },
        {
            ref: 'UsuarioPassword2Form',
            selector: '[xtype=usuario.usuario.edit.form] textfield#password2'
        },
        {
            ref: 'UsuarioPasswordLabel',
            selector: '[xtype=usuario.usuario.edit.form] label#comparacion_password'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=usuario.usuario.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=usuario.usuario.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=usuario.usuario.lista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=usuario.usuario.lista] button#delete': {
                    click: this.remove
                },
                'window[xtype=usuario.usuario.edit.window] button#save': {
                    click: this.save
                },
                'window[xtype=usuario.usuario.edit.window] button#cancel': {
                    click: this.close
                },
                '[xtype=usuario.usuario.edit.form] textfield#password1': {
                    keyup: this.revisionPassword
                },
                '[xtype=usuario.usuario.edit.form] textfield#password2': {
                    keyup: this.revisionPassword
                },
                'grid[xtype=usuario.usuario.lista] menuitem#reporte_asignacion': {
                    click: this.repActivosUsuario
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },


    repActivosUsuario: function() {
        var me = this,
                grid = me.getUsuarioLista(),
                selected = grid.getSelectionModel().getSelection();
        
        if (selected.length === 1)
        {
            var rec = selected[0],
                    data = rec.getData(),
                    obj, src;
            
            obj = {
                url: activos_scsj.app.globals.globalServerPath + 'reporte/repActivosUsuario',
                params: {
                    id_usuario: data['id_usuario']
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


    revisionPassword: function(grid, eOpts) {
        var me = this,
                pas1 = me.getUsuarioPassword1Form().getValue(),
                pas2 = me.getUsuarioPassword2Form().getValue(),
                lab3 = me.getUsuarioPasswordLabel();
        
        if ( pas1 !== '' || pas2 !== '' )
        {
            if ( pas1 === pas2 )
            {
                lab3.setText('<h2>Contraseñas Idénticas</h2>', false);
                return true;
            }
            else
            {
                lab3.setText('<h2>Contraseñas Distintas</h2>', false);
                return false;
            }
        }
        else
        {
            lab3.setText('');
            return false;
        }
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getUsuarioLista();
        var records = grid.getSelectionModel().getSelection();

        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        var botonRevision = grid.down("[xtype='toolbar'] menuitem#reporte_asignacion");

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
        var me = this,
                store = grid.getStore();
        // clear any fliters that have been applied
        store.clearFilter(true);
        // load the store
        store.load();
    },


    edit: function(view, record, item, index, e, eOpts) {
        var me = this;
        
        me.boolUsuarioEdit = 1;

        var grid = me.getUsuarioLista();
        var record = grid.getSelectionModel().getSelection()[0];
        // show window
        me.showEditWindow(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('activos_scsj.model.usuario.Usuario');
        
        me.boolUsuarioEdit = 0;

        // show window
        me.showEditWindow(record);
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getUsuarioLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                callbacks;
        
        var fieldUsuarioPassword1 = me.getUsuarioPassword1Form();
        var verPass = me.revisionPassword();
        
        /////////////////////////////////////////////////////////////////
        // [INICIO] Procesamiento de campo UsuarioTipo
        /////////////////////////////////////////////////////////////////
        var arrayUsuarioTipo = []; // start with empty array
        var arrayLength = values['usuario_tipo_usuario_00_01_02'].length;
        for (var i = 0; i < arrayLength; i++) {
            if (values['usuario_tipo_usuario_00_01_02'][i] !== '')
            {
                // add the fields that you want to include
                var tmpTipos = {
                    fk_id_usuario_tipo: values['usuario_tipo_usuario_00_01_02'][i]
                };
                arrayUsuarioTipo.push(tmpTipos); // push this to the array
            }
        }
        var objTipos = Ext.encode(arrayUsuarioTipo);
        values['usuario_tipo_usuario_00_01_02'] = objTipos;
        /////////////////////////////////////////////////////////////////
        // [FIN] Procesamiento de campo UsuarioTipo
        /////////////////////////////////////////////////////////////////

        /////////////////////////////////////////////////////////////////
        // [INICIO] Procesamiento de campo UsuarioEntidad
        /////////////////////////////////////////////////////////////////
        var arrayUsuarioUnidad = []; // start with empty array
        var arrayLength = values['usuario_unidad_00_01_02'].length;
        for (var i = 0; i < arrayLength; i++) {
            if (values['usuario_unidad_00_01_02'][i] !== '')
            {
                // add the fields that you want to include
                var tmpUnidades = {
                    fk_id_unidad: values['usuario_unidad_00_01_02'][i]
                };
                arrayUsuarioUnidad.push(tmpUnidades); // push this to the array
            }
        }
        var objUnidades = Ext.encode(arrayUsuarioUnidad);
        values['usuario_unidad_00_01_02'] = objUnidades;
        /////////////////////////////////////////////////////////////////
        // [FIN] Procesamiento de campo UsuarioEntidad
        /////////////////////////////////////////////////////////////////

        // Valida el formulario
        if ( form.isValid() && verPass )
        {
            values['contrasena_usuario'] = fieldUsuarioPassword1.getValue();
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

                Ext.getBody().mask('Guardando Usuario ...');

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
        var me = this,
                win = button.up('window');
        // close the window
        win.close();
    },


    remove: function() {
        var me = this;

        var grid = me.getUsuarioLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show confirmation before continuing
        Ext.Msg.confirm({
            title: 'Atención',
            msg: '¿Esta seguro que desea eliminar este Usuario?. Esta acción no puede ser deshecha.',
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
                win = me.getUsuarioWindow(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('usuario.usuario.edit.window', {
                title: isNew ? 'Añadir Usuario' : 'Editar Usuario'
            });
        }
        // show window
        win.show();
        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
        
        if ( me.boolUsuarioEdit === 1 )
        {
            var fieldUsuarioPassword1 = me.getUsuarioPassword1Form();
            var fieldUsuarioPassword2 = me.getUsuarioPassword2Form();

            fieldUsuarioPassword1.allowBlank = true;
            fieldUsuarioPassword2.allowBlank = true;
        }
    },


    cancel: function(editor, context, eOpts) {
        // if the record is a phantom, remove from store and grid
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    }
});