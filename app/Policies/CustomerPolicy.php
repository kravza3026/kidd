<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any customers.
     *
     * @param  User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {

    }

    /**
     * Determine whether the user can view the customer.
     *
     * @param  User  $user
     * @param  Customer  $customer
     * @return bool
     */
    public function view(User $user, Customer $customer): bool
    {
    }

    /**
     * Determine whether the user can create customers.
     *
     * @param  User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
    }

    /**
     * Determine whether the user can update the customer.
     *
     * @param  User  $user
     * @param  Customer  $customer
     * @return bool
     */
    public function update(User $user, Customer $customer): bool
    {
    }

    /**
     * Determine whether the user can delete the customer.
     *
     * @param  User  $user
     * @param  Customer  $customer
     * @return bool
     */
    public function delete(User $user, Customer $customer): bool
    {
    }

    /**
     * Determine whether the user can restore the customer.
     *
     * @param  User  $user
     * @param  Customer  $customer
     * @return bool
     */
    public function restore(User $user, Customer $customer): bool
    {
    }

    /**
     * Determine whether the user can permanently delete the customer.
     *
     * @param  User  $user
     * @param  Customer  $customer
     * @return bool
     */
    public function forceDelete(User $user, Customer $customer): bool
    {
    }
}
