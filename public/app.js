Ajax = function(){
    this._token = null;
    this._token_updated_at = null;
    this._token_expiration_msec = 1000 * 30;
    this.CallsFns = Calls;
}
Ajax.prototype.requestToken = function(){

    var self = this;

    $.ajax({
        url: '/token',
        type: 'get',
        async: false,
        success: function(token){
            self._token = token;
            self._token_updated_at = (new Date()).getTime();
        }
    });

    return self._token;
}
Ajax.prototype.getToken = function(){

    var self = this;

    if (!self._token) {
        return self.requestToken();
    }

    if ( (new Date()).getTime() >= (self._token_updated_at + self._token_expiration_msec) ) {
        return self.requestToken();
    }

    return self._token;
}
Ajax.prototype.request = function(config){

    var self = this;

    config = $.extend({
        dataType: 'json',
        data: {},
        beforeSuccess: function(data, textStatus, jqXHR){},
        afterSuccess: function(data, textStatus, jqXHR){}
    }, config);

    config.data = $.extend(config.data, {
        _token: self.getToken()
    });

    config.success = function(data, textStatus, jqXHR){

        config.beforeSuccess(data, textStatus, jqXHR);

        if (data.calls) {
            self.calls(data.calls);
        }

        config.afterSuccess(data, textStatus, jqXHR);
    }

    $.ajax(config);
}
Ajax.prototype.calls = function(callsArr){

    var self = this;

    if (typeof callsArr != 'object') {
        return;
    }
    if (callsArr.length < 1) {
        return;
    }

    $.each(callsArr, function(index, item){
        var func = (new Function('return ' + self.CallsFns[item.call]))();
        func.apply(null, item.params);
    });
}

var Calls = {
    updateHtmlContext: function (selector, context) {
        $(selector).html(context);
    }
};

App = function(){

    this.ajax = new Ajax();

}
App.prototype.putProductInDeferred = function(productId, buttonEl){

    var self = this;

    if (buttonEl) {
        var btn = $(buttonEl).button('loading');
    }
    self.ajax.request({
        url: '/deferred',
        type: 'post',
        data: {
            product_id: productId
        },
        afterSuccess: function(data){
            if (buttonEl) {
                btn.button('reset');
            }
        }
    });
}
App.prototype.putProductInBasket = function(productId, quantity, buttonEl){

    var self = this;

    if (quantity < 1) {
        quantity = 1;
    }
    if (buttonEl) {
        var btn = $(buttonEl).button('loading');
    }
    self.ajax.request({
        url: '/order',
        type: 'post',
        data: {
            product_id: productId,
            quantity: quantity
        },
        afterSuccess: function(data){
            if (buttonEl) {
                btn.button('reset');
            }
        }
    });
}
App.prototype.deleteOrderFromBasket = function(orderId, buttonEl){

    var self = this;

    if (buttonEl) {
        var btn = $(buttonEl).button('loading');
    }
    self.ajax.request({
        url: '/order/' + orderId,
        type: 'delete',
        afterSuccess: function(data){
            if (buttonEl) {
                btn.button('reset');
            }
        }
    });
}
App.prototype.dropDeferredProduct = function(deferredProductId, buttonEl){

    var self = this;

    if (buttonEl) {
        var btn = $(buttonEl).button('loading');
    }
    self.ajax.request({
        url: '/deferred/' + deferredProductId,
        type: 'delete',
        afterSuccess: function(data){
            if (buttonEl) {
                btn.button('reset');
            }
        }
    });
}
App.prototype.changeOrderQuantity = function(orderId, shift, buttonEl){

    var self = this;

    var inputEl = $('#order-item-'+orderId+' input.quantity-value');
    var oldValue = inputEl.val() * 1;
    var newValue = oldValue + shift;
    if (newValue < 1) {
        return;
    }
    inputEl.val(newValue);
    if (buttonEl) {
        var btn = $(buttonEl).button('loading');
    }
    self.ajax.request({
        url: '/order/' + orderId,
        type: 'put',
        data: {
            quantity: newValue
        },
        afterSuccess: function(data){
            if (buttonEl) {
                btn.button('reset');
            }
        }
    });
}

var App = new App();