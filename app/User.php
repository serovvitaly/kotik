<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, EntrustUserTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function getRolesIdsArr()
    {
        $roles_rows = \DB::table( \Config::get('entrust.role_user_table') )->where('user_id', '=', $this->id)->get(['role_id']);

        if (empty($roles_rows)) {
            return [];
        }

        $roles_ids_arr = [];
        foreach ($roles_rows as $role_row) {
            $roles_ids_arr[] = $role_row->role_id;
        }

        return $roles_ids_arr;
    }

    public function catalogs()
    {
        return $this->hasMany('App\Models\Catalog');
    }

    /**
     * Возвращает отношение к "Отложенным" продуктам
     * @param null $catalog_id
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deferredProducts($catalog_id = null)
    {
        $output = $this->hasMany('\App\Models\OrderedProduct')->where('is_deferred', '=', 1);

        if ($catalog_id) {
            $output->where('catalog_id', '=', $catalog_id);
        }

        return $output;
    }

    /**
     * Возвращает отношение к "Заказанным" продуктам
     * @param null $catalog_id
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderedProducts($catalog_id = null)
    {
        $output = $this->hasMany('\App\Models\OrderedProduct')->where('is_deferred', '=', 0);

        if ($catalog_id) {
            $output->where('catalog_id', '=', $catalog_id);
        }

        return $output;
    }

    /**
     * Возвращает массив ID каталогов, для которых есть открытые заказы
     * @return array
     */
    public function getOpenOrdersCatalogsIdsArr()
    {
        $open_orders_catalogs_arr = \DB::select('select catalog_id from '.\App\Models\OrderedProduct::TABLE
            .' where `user_id` = ? and `status` = 0 and is_deferred = 0 group by `catalog_id`', [
            $this->id
        ]);

        if (empty($open_orders_catalogs_arr)) {
            return [];
        }

        $open_orders_catalogs_ids_arr = [];
        foreach ($open_orders_catalogs_arr as $open_orders_catalog_mix) {
            $open_orders_catalogs_ids_arr[] = $open_orders_catalog_mix->catalog_id;
        }

        return $open_orders_catalogs_ids_arr;
    }

    /**
     * Возвращает сумму открытых заказов
     */
    public function getAmountOpenOrders($catalog_id = null)
    {
        $open_orders = $this->orderedProducts($catalog_id)->get();

        if ($open_orders->count() < 1) {
            return 0;
        }

        $amount = 0;

        foreach ($open_orders as $order) {
            $amount = $amount + $order->price * $order->quantity;
        }

        return number_format($amount, 2, ',', '`');
    }

    /**
     * Возвращает сумму открытых заказов
     */
    public function getAmountOpenOrdersAsString($catalog_id = null)
    {
        $open_orders = $this->orderedProducts($catalog_id)->get();

        if ($open_orders->count() < 1) {
            return 0;
        }

        $amount = 0;

        foreach ($open_orders as $order) {
            $amount = $amount + $order->price * $order->quantity;
        }

        $amount_as_string = \App\Helpers\CommonHelper::NumberToString($amount);

        return $amount_as_string;
    }

    /**
     * Возвращает общее количество всех продуктов в открытых заказах
     */
    public function getQuantityOpenOrders($catalog_id = null)
    {
        $open_orders = $this->orderedProducts($catalog_id)->get();

        if ($open_orders->count() < 1) {
            return 0;
        }

        $quantity = 0;

        foreach ($open_orders as $order) {
            $quantity += $order->quantity;
        }

        return $quantity;
    }

}
