<?php

namespace App\Enums;

/**
 * Reason a customer gives when requesting a return for a delivered order.
 */
enum ReturnReason: int
{
    case WrongSize = 1;
    case Defective = 2;
    case NotAsDescribed = 3;
    case WrongItem = 4;
    case ChangedMind = 5;
    case Other = 6;

    public function label(): string
    {
        return match ($this) {
            self::WrongSize => __('order.return.reasons.wrong_size'),
            self::Defective => __('order.return.reasons.defective'),
            self::NotAsDescribed => __('order.return.reasons.not_as_described'),
            self::WrongItem => __('order.return.reasons.wrong_item'),
            self::ChangedMind => __('order.return.reasons.changed_mind'),
            self::Other => __('order.return.reasons.other'),
        };
    }

    /**
     * Value => label map for building a <select>.
     *
     * @return array<int, string>
     */
    public static function forSelect(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $reason): array => [$reason->value => $reason->label()])
            ->all();
    }
}
