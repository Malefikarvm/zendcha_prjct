/**
 * Created by jsant on 16/05/2016.
 */
Ext.application({
    //requieres : ['Ext.container.Viewport'],
    name : 'App',
    appFolder : 'app',

    controllers : [
        'Company'
    ],

    launch: function () {
        Ext.create('App.view.company.Form', {
            renderTo: 'form'
        });
        Ext.create('App.view.company.List', {
            renderTo: 'list'
        });
        /*Ext.create('Ext.container.Viewport', {
            layout: 'fit',
            items : {
                //xtype: 'box',
                //html: 'hola mundo'
                xtype: 'companyform'
            }
        });*/
    }
});