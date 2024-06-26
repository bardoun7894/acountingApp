<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountControl extends Model
{
 
    use HasFactory; 
        // Define the constants for the account control codes
        const CURRENT_ASSETS = '11';
        const FIXED_ASSETS = '12';
        const INTANGIBLE_ASSETS = '13';
        const CURRENT_LIABILITIES = '21';
        const FIXED_LIABILITIES = '22';
        const SALES_REVENUES = '31';
        const OTHER_REVENUES = '32';
        const COST_OF_GOOD_SOLD = '41';
        const SALE_AND_MARKETING_EXPENSES = '42';
        const ADMINISTRATIVE_EXPENSES = '43';
        
    
        // Define the relationship with the AccountHead model 
        // Define a method to get all account controls with their names
        public static function getAll()
        {
            return [
                self::CURRENT_ASSETS => [
                    'en' => 'Current Assets',
                    'ar' => 'الأصول المتداولة',
                ],
                self::FIXED_ASSETS => [
                    'en' => 'Fixed Assets',
                    'ar' => 'الأصول الثابتة',
                ],
                self::INTANGIBLE_ASSETS => [
                    'en' => 'Intangible Assets',
                    'ar' => 'الأصول الغير ملموسة',
                ],
                self::CURRENT_LIABILITIES => [
                    'en' => 'Current Liabilities',
                    'ar' => 'الالتزامات المتداولة',
                ],
                self::FIXED_LIABILITIES => [
                    'en' => 'Fixed Liabilities',
                    'ar' => 'الالتزامات الثابتة',
                ],
                self::SALES_REVENUES => [
                    'en' => 'Sales Revenues',
                    'ar' => 'ايرادات المبيعات',
                ],
                self::OTHER_REVENUES => [
                    'en' => 'Other Revenues',
                    'ar' => 'ايرادات أخرى',
                ],
                self::COST_OF_GOOD_SOLD => [
                    'en' => 'Cost Of Good Sold',
                    'ar' => 'صافي المبيعات',
                ],
                self::SALE_AND_MARKETING_EXPENSES => [
                    'en' => 'Sale and Marketing Expenses',
                    'ar' => 'مصاريف البيع والتسويق',
                ],
                self::ADMINISTRATIVE_EXPENSES => [
                    'en' => 'Administrative Expenses',
                    'ar' => 'مصاريف ادارية وعمومية',
                ],
            ];
        } 
        // Define methods to get the English and Arabic names for a given account control code
        public static function getNameEn($code)
        {
            return self::getAll()[$code]['en'] ?? null;
        }
    
        public static function getNameAr($code)
        {
            return self::getAll()[$code]['ar'] ?? null;
        }
    

    public function accountHead()
    {
        return $this->belongsTo(AccountHead::class);
    }

    public function accountSubControls()
    {
        return $this->hasMany(
            AccountSubControl::class,
            "account_code",
            "account_control_id"
        );
    }

    public static function getAccountControlNameLang()
    {
        return "account_control_name_" . Translation::getLang();
    }
}
