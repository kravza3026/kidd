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
     */
    public function viewAny(User $user): bool {}

    /**
     * Determine whether the user can view the order item.
     */
    public function view(User $user, OrderItem $orderItem): bool {}

    /**
     * Determine whether the user can create order items.
     */
    public function create(User $user): bool {}

    /**
     * Determine whether the user can update the order item.
     */
    public function update(User $user, OrderItem $orderItem): bool {}

    /**
     * Determine whether the user can delete the order item.
     */
    public function delete(User $user, OrderItem $orderItem): bool {}

    /**
     * Determine whether the user can restore the order item.
     */
    public function restore(User $user, OrderItem $orderItem): bool {}

    /**
     * Determine whether the user can permanently delete the order item.
     */
    public function forceDelete(User $user, OrderItem $orderItem): bool {}
}
