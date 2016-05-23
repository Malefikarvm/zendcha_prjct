/**
 * Created by jsant on 20/05/2016.
 */
Ext.define('App.store.Company', {
    extend: 'Ext.data.Store',
    model: 'App.model.Company',
    alias: 'store.CompanyStore',

    proxy: {
        type: 'ajax',
        url: '/company/data',
        reader: {
            type: 'json'
        }
    },
    autoLoad: false
    
    /*data: [
        {name: 'Ed',    email: 'assdsdfsd@sencha.com'},
        {name: 'Tommy', email: 'tommy@sencha.com'}
    ]*/
});