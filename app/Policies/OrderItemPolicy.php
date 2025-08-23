<?php

namespace App\Policies;

use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any order items.
     *
     * @param  User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {

    }

    /**
     * Determine whether the user can view the order item.
     *
     * @param  User  $user
     * @param  OrderItem  $orderItem
     * @return bool
     */
    public function view(User $user, OrderItem $orderItem): bool
    {
    }

    /**
     * Determine whether the user can create order items.
     *
     * @param  User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
    }

    /**
     * Determine whether the user can update the order item.
     *
     * @param  User  $user
     * @param  OrderItem  $orderItem
     * @return bool
     */
    public function update(User $user, OrderItem $orderItem): bool
    {
    }

    /**
     * Determine whether the user can delete the order item.
     *
     * @param  User  $user
     * @param  OrderItem  $orderItem
     * @return bool
     */
    public function delete(User $user, OrderItem $orderItem): bool
    {
    }

    /**
     * Determine whether the user can restore the order item.
     *
     * @param  User  $user
     * @param  OrderItem  $orderItem
     * @return bool
     */
    public function restore(User $user, OrderItem $orderItem): bool
    {
    }

    /**
     * Determine whether the user can permanently delete the order item.
     *
     * @param  User  $user
     * @param  OrderItem  $orderItem
     * @return bool
     */
    public function forceDelete(User $user, OrderItem $orderItem): bool
    {
    }
}
