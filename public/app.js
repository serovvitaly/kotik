var CortesApp = angular.module('CortesApp', [])
    .config(function($interpolateProvider){
        $interpolateProvider.startSymbol('[[').endSymbol(']]');
    });


CortesApp.service('$ajax', function(){
    var self = this;

    this._token = null;
    this._token_updated_at = null;
    this._token_expiration_msec = 1000 * 10;

    this.requestToken = function(){

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

    this.getToken = function(){

        if (!self._token) {
            return self.requestToken();
        }

        if ( (new Date()).getTime() >= (self._token_updated_at + self._token_expiration_msec) ) {
            return self.requestToken();
        }

        return self._token;
    }

    return this;
});

CortesApp.service('ordersManager', ['$ajax', function($ajax){

    var self = this;

    this.putProductInDeferred = function(productId, buttonEl){

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

    this.putProductInBasket = function(productId, quantity, buttonEl){

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

    this.deleteOrderFromBasket = function(orderId, buttonEl){

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

    this.dropDeferredProduct = function(deferredProductId, buttonEl){

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

    this.changeOrderQuantity = function(orderId, shift, buttonEl){

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

    return this;
}]);

CortesApp.controller('BodyController', function(){
    //
});

CortesApp.controller('BasketController', ['$scope', function($scope){
    $scope.executeAllOrders = function(){
        alert('executeAllOrders');
    }
    $scope.toggleInfoForAllProducts = function(){
        alert('toggleInfoForAllProducts');
    }

    $scope.modelCatalogOrders = [
        {content: '1'},
        {content: 'hello'},
        {content: '2'}
    ]
}]);

CortesApp.controller('OrdersItemsController', ['$scope', 'ordersManager', function($scope, ordersManager){
    $scope.changeOrderQuantity = ordersManager.changeOrderQuantity;
}]);
