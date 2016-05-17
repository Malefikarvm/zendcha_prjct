/**
 * Created by jsant on 17/05/2016.
 */
Ext.application({
    //requieres : ['Ext.container.Viewport'],
    name : 'login',
    appFolder : 'app',

    controllers : [
        'User'
    ],

    models : [
        'User'
    ],

    views : [
        'user.form'
    ],

    launch: function () {
        
        //Ext.create('Crud.view.user.form').show();
        /*Ext.create('Ext.container.Viewport', {
         items : {
         html : 'Hola mundo!'
         }
         });*/
    }
});