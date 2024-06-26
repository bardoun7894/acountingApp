<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountHead extends Model
{
    use HasFactory;

    const ASSETS = '1';
    const LIABILITIES = '2';
    const REVENUE = '3';
    const EXPENSES = '4';

    public static function getAll() {
        return [
            self::ASSETS => [
                'en' => 'Assets',
                'ar' => 'الأصول',
            ],
            self::LIABILITIES => [
                'en' => 'Liabilities',
                'ar' => 'الخصوم(المطلوبات)',
            ],
            self::REVENUE => [
                'en' => 'Revenue',
                'ar' => 'الايرادات',
            ],
            self::EXPENSES => [
                'en' => 'Expenses',
                'ar' => 'المصروفات',
            ],
        ];
    }

    public static function getNameEn($code) {
        return self::getAll()[$code]['en'] ?? null;
    }

    public static function getNameAr($code) {
        return self::getAll()[$code]['ar'] ?? null;
    }

    public function accountControls()
    {
        return $this->hasMany(
            AccountControl::class,
            "account_head_id",
            "account_code"
        );
    }
    public function accountSubControls()
    {
        return $this->hasMany(
            AccountSubControl::class,
            "account_head_id",
            "account_code"
        );
    }
    public static function getAccountHeadNameLang()
    {
        return "account_head_name_" . Translation::getLang();
    }
}
