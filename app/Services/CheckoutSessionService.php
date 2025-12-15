<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CheckoutSessionService
{
    private const string SESSION_STEP_KEY = 'checkout_step';

    private const string SESSION_DATA_KEY = 'checkout_data';

    private const string DEFAULT_STEP = 'shipping';

    private array $steps = ['shipping', 'contact', 'payment', 'review'];

    /**
     * Store validated checkout data for a step.
     */
    public function storeStepData(array $validatedData): void
    {
        $existingData = $this->getCheckoutData();
        $mergedData = array_merge($existingData, $validatedData);
        Session::put(self::SESSION_DATA_KEY, $mergedData);
    }

    /**
     * Get all checkout data from session.
     */
    public function getCheckoutData(): array
    {
        return Session::get(self::SESSION_DATA_KEY, []);
    }

    /**
     * Move to the next step.
     */
    public function moveToNextStep(string $currentStep): string
    {
        $nextStep = $this->getNextStep($currentStep);
        $this->setCurrentStep($nextStep);

        return $nextStep;
    }

    /**
     * Get the next step in the checkout process.
     */
    public function getNextStep(string $currentStep): string
    {
        $currentIndex = array_search($currentStep, $this->steps);

        if ($currentIndex === false) {
            return self::DEFAULT_STEP;
        }

        return $this->steps[min($currentIndex + 1, count($this->steps) - 1)];
    }

    /**
     * Set the current checkout step.
     */
    public function setCurrentStep(string $step): void
    {
        if ($this->isValidStep($step)) {
            Session::put(self::SESSION_STEP_KEY, $step);
        }
    }

    /**
     * Check if the provided step is valid.
     */
    public function isValidStep(string $step): bool
    {
        return in_array($step, $this->steps);
    }

    /**
     * Move to the previous step.
     */
    public function moveToPreviousStep(string $currentStep): string
    {
        $previousStep = $this->getPreviousStep($currentStep);
        $this->setCurrentStep($previousStep);

        return $previousStep;
    }

    /**
     * Get the previous step in the checkout process.
     */
    public function getPreviousStep(string $currentStep): string
    {
        $currentIndex = array_search($currentStep, $this->steps);

        if ($currentIndex === false) {
            return self::DEFAULT_STEP;
        }

        return $this->steps[max(0, $currentIndex - 1)];
    }

    /**
     * Clear all checkout session data.
     */
    public function clearCheckoutSession(): void
    {
        Session::forget([self::SESSION_STEP_KEY, self::SESSION_DATA_KEY]);
    }

    /**
     * Check if user can access the review step.
     */
    public function canAccessReview(): bool
    {
        return $this->getCurrentStep() === 'review';
    }

    /**
     * Get the current checkout step.
     */
    public function getCurrentStep(): string
    {
        return Session::get(self::SESSION_STEP_KEY, self::DEFAULT_STEP);
    }

    /**
     * Get all available steps.
     */
    public function getSteps(): array
    {
        return $this->steps;
    }
}
