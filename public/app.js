App = function(){

    this._token = null;
    this._token_updated_at = null;
    this._token_expiration_msec = 1000 * 10;

}

App.prototype.requestToken = function(){

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

App.prototype.getToken = function(){

    var self = this;

    if (!self._token) {
        return self.requestToken();
    }

    if ( (new Date()).getTime() >= (self._token_updated_at + self._token_expiration_msec) ) {
        return self.requestToken();
    }

    return self._token;
}

App.prototype.putProductInDeferred = function(productId, buttonEl){

    var self = this;

    if (buttonEl) {
        var btn = $(buttonEl).button('loading');
    }
    $.ajax({
        url: '/deferred',
        type: 'post',
        dataType: 'json',
        data: {
            _token: self.getToken(),
            product_id: productId
        },
        success: function(data){
            $('#basket-mini-box').html(data.basket_mini);
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
    $.ajax({
        url: '/order',
        type: 'post',
        dataType: 'json',
        data: {
            _token: self.getToken(),
            product_id: productId,
            quantity: quantity
        },
        success: function(data){
            $('#basket-mini-box').html(data.basket_mini);
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
    $.ajax({
        url: '/order/' + orderId,
        type: 'delete',
        data: {
            _token: self.getToken()
        },
        success: function(data){
            $('#basket-mini-box').html(data.basket_mini);
            if (buttonEl) {
                btn.button('reset');
            }
            $('#order-item-'+orderId).remove();
        }
    });
}

App.prototype.dropDeferredProduct = function(deferredProductId, buttonEl){

    var self = this;

    if (buttonEl) {
        var btn = $(buttonEl).button('loading');
    }
    $.ajax({
        url: '/deferred/' + deferredProductId,
        type: 'delete',
        data: {
            _token: self.getToken()
        },
        success: function(data){
            $('#basket-mini-box').html(data.basket_mini);
            if (buttonEl) {
                btn.button('reset');
            }
            $('#order-item-'+deferredProductId).remove();
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
    $.ajax({
        url: '/order/' + orderId,
        type: 'put',
        dataType: 'json',
        data: {
            _token: self.getToken(),
            quantity: newValue
        },
        success: function(data){
            $('#basket-mini-box').html(data.basket_mini);
            if (buttonEl) {
                btn.button('reset');
            }
        }
    });
}

var App = new App;