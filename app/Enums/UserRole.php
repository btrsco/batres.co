<?php

namespace App\Enums;

enum UserRole: string
{
    case ROOT = 'root';
    case ADMIN = 'admin';
    case MOD = 'mod';
    case USER = 'user';

    public function label(): string
    {
        return match ($this) {
            self::ROOT => 'Super Administrator',
            self::ADMIN => 'Administrator',
            self::MOD => 'Moderator',
            self::USER => 'User',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn(self $option) => [
                $option->value => $option->label(),
            ])
            ->toArray();
    }
}
