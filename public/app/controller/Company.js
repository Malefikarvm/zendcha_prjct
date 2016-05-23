/**
 * Created by jsant on 18/05/2016.
 */
Ext.define('App.controller.Company', {
    extend: 'Ext.app.Controller',

    views : [
        'company.Form',
        'company.List',
        'company.Edit'
    ],

    stores: [
        'Company'
    ],

    models : [
        'Company'
    ],

    init : function () {
        this.control({
            "companylist" : {
                render : this.loadData,
                editRecord : this.onEditClick,
                deleteRecord : this.onDeleteClick
            },
            "companyform" : {
                render : this.rendered
            },
            "companyform button[action=save]" : {
                click : this.saveRecord
            },
            "companyedit button[action=cancel]" : {
                click : this.onCancelClick
            },
            "companyedit button[action=update]" : {
                click : this.onUpdateClick
            }
        });
    },

    rendered : function () {
      console.log('rendered');
    },

    loadData : function () {
        var grid = Ext.widget('companylist');
        var store = grid.getStore();
        var model = Ext.create('App.model.Company');
        store.load();
    },

    saveRecord : function (cmpnnt, eOpts) {
        var form = cmpnnt.up('form');
        var grid = Ext.widget('companylist');
        var store = grid.getStore();
        var model = Ext.create('App.model.Company');
        if (!form.isValid()) {
            Ext.Msg.alert('Campos vacíos', 'La información diligenciada no es válida');
            return;
        }
        Ext.Ajax.request({
            url : '/company/validate',
            params : form.getValues(),
            beforeRequest : function () {},
            success : function (response) {
                if(response.responseText == 'false') {
                    Ext.Msg.alert('Error', 'El nit del cliente ya existe');
                } else {
                    var resp = JSON.parse(response.responseText);
                    Ext.each(resp, function (key, val) {
                        model.set(key, val);
                    });
                    form.getForm().reset(true);
                    store.add(model);
                    store.save();
                }
            }
        });
    },

    onEditClick : function (e, rec, frm) {
        var grid = e.up('companylist');
        var store = grid.getStore();
        //var row = grid.getSelectionModel().getSelection();
        var form = Ext.widget('companyform');
        /*var a = {
            getData : function () {
              return this.data
            },
            data : {
                "businessName" : 'a',
                "nit" : 'a',
                "address" : 'a',
                "city" : 'a',
                "email" : 'asd@sd.com',
                "phone" : '0',
                "cellphone" : '0'
            }
        };
        form.loadRecord(a);*/
        //console.log(frm.getValues());
        var view = Ext.widget('companyedit');

        view.down('form').loadRecord(rec);
    },

    onDeleteClick : function (e, rec, row) {
        var grid = e.up('companylist');
        var store = grid.getStore();
        var rw = grid.getSelectionModel().getSelection();
        console.log(rec.data);
        Ext.Ajax.request({
            url : '/company/delete',
            params : rec.data,
            beforeRequest : function () {},
            success : function (response) {

                if(response.responseText == '1') {
                    store.remove(rw);
                } else {
                    Ext.Msg.alert('Error', 'No se puede borrar el registro');
                }
            }
        });

    },

    onCancelClick : function (btn) {
        var win = btn.up('window');
        win.close();
    },

    onUpdateClick : function (btn) {
        var win = btn.up('window'),
            form = win.down('form'),
            record = form.getRecord(),
            values = form.getValues();
        var model = Ext.create('App.model.Company');
        if (!form.isValid()) {
            Ext.Msg.alert('Campos vacíos', 'La información diligenciada no es válida');
            return;
        }
        Ext.Ajax.request({
            url : '/company/update',
            params : values,
            beforeRequest : function () {},
            success : function (response) {

                if(response.responseText == 'false') {
                    Ext.Msg.alert('Error', 'El nit del cliente ya existe');
                } else {
                    var resp = JSON.parse(response.responseText);
                    console.log(resp);
                    form.getForm().reset(true);
                    record.set(resp[0]);
                    win.close();
                }
            }
        });
    }

});