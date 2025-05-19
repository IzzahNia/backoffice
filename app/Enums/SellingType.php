<?php

namespace App\Enums;

enum SellingType: string
{
    case FOOD = 'food';
    case BEVERAGE = 'beverage';
    case FASHION = 'fashion';
    case ACCESSORIES = 'accessories';
    case ART = 'art';
    case CRAFT = 'craft';
    case BEAUTY = 'beauty';
    case HOME = 'home';
    case ELECTRONICS = 'electronics';
    case BOOKS = 'books';
    case TOYS = 'toys';
    case PLANTS = 'plants';
    case SERVICES = 'services';
    case PETS = 'pets';
    case SPORTS = 'sports';
    case HEALTH = 'health';
    case STATIONERY = 'stationery';
    case GIFTS = 'gifts';
    case JEWELRY = 'jewelry';
    case FOOTWEAR = 'footwear';
    case MOBILE = 'mobile';
    case GADGETS = 'gadgets';
    case FURNITURE = 'furniture';
    case ANTIQUES = 'antiques';
    case MUSIC = 'music';
    case FILM = 'film';
    case PHOTOGRAPHY = 'photography';
    case OUTDOOR = 'outdoor';
    case AUTOMOTIVE = 'automotive';
    case BABY = 'baby';
    case CLEANING = 'cleaning';
    case PARTY_SUPPLIES = 'party_supplies';
    case SOFTWARE = 'software';
    case EDUCATION = 'education';
    case CHARITY = 'charity';
    case OTHERS = 'others';

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($case) => [$case->value => ucfirst(str_replace('_', ' ', $case->value))])
            ->toArray();
    }
}
