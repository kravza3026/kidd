<?php

namespace App;

interface MustVerifyPhone
{
    /**
     * Determine if the user has verified their email address.
     *
     * @return bool
     */
    public function hasVerifiedPhone(): bool;

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markPhoneAsVerified(): bool;

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendPhoneVerificationNotification(): void;

    /**
     * Get the email address that should be used for verification.
     *
     * @return string
     */
    public function getPhoneForVerification(): string;
}
