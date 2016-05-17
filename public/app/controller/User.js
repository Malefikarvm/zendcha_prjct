/**
 * Created by jsant on 16/05/2016.
 */
Ext.define('login.controller.User', {
    extend: 'Ext.app.Controller',

    init: function() {
        var functions = {

            /**
             * este metodo es una implementacion dinámica de la validación:
             *  return (keyCode != 8 && keyCode != 46 && keyCode != 37 && keyCode != 38 && keyCode != 39 && keyCode != 40);
             * @param keyCode
             * @param nums
             * @returns {boolean}
             */
            notIn : function (keyCode, nums) {
                var valid = false;
                for (var i = 0; i < nums.length; i++) {
                    if (keyCode != nums[i]){
                        valid = true
                    } else {
                        valid = false;
                        break
                    }
                }
                return valid;
            }
        };

        var user = Ext.get('user');
        var psswrd = Ext.get('password');
        var btnLogin = Ext.get('btnLogin');
        psswrd.on('keydown', function (e) {
            var val = this.getValue();
            var length = val.length;
            var key = e.keyCode;
            var keyNums = [8, 46, 37, 38, 39, 40];
            if (length >= 16 && functions.notIn(key, keyNums)) {
                e.stopEvent();
            }
        });

        btnLogin.on('click', function (e) {
            var usr = user.getValue();
            var pss = psswrd.getValue();
            if (usr.length == 0 || pss.length == 0) {
                Ext.Msg.alert('Error', 'Los campos no pueden estar vacíos');
                return;
            }
            Ext.Ajax.request({
                url : 'user/validate',
                params : {
                    user : usr,
                    password : pss
                },
                beforerequest : function () {},
                success: function (response) {
                    Ext.Msg.alert('Login', response.responseText);
                }
            });
        });
    }

});