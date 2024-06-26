<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
class AccountActivity extends Model
{
    // Define the constants for the account activity IDs
    const SALE = 1;
    const SALE_RETURN = 2;
    const PURCHASE_PRODUCT = 3;
    const PURCHASE_RETURN = 4;
    const SALARY = 5;
    const EXPENSES = 6;
    const COST_OF_GOOD_SOLD = 7;
    const PURCHASE_PAYMENT_PENDING = 8;
    const PURCHASE_PAYMENT_SUCCEED = 9;
    const SALE_PAYMENT_PENDING = 10;
    const SALE_PAYMENT_SUCCEED = 11;

    // Additional constants for potential future use
    const INVENTORY_ADJUSTMENT = 12;
    const BANK_TRANSFER = 13;
    const CASH_DEPOSIT = 14;
    const CASH_WITHDRAWAL = 15;
    const LOAN_PAYMENT = 16;
    const INTEREST_INCOME = 17;
    const INTEREST_EXPENSE = 18;
    const DEPRECIATION = 19;
    const AMORTIZATION = 20;
    const CAPITAL_CONTRIBUTION = 21;
    const DIVIDEND_PAYMENT = 22;
    const PURCHASE_DISCOUNT = 23;
    const SALE_DISCOUNT = 24;
    const TAX_PAYMENT = 25;
    const REFUND = 26;
    const WRITE_OFF = 27;

    // Define a method to get all account activities with their names
    public static function getAll()
    {
        return [
            self::SALE => [
                'en' => 'Sale',
                'ar' => 'بيع',
            ],
            self::SALE_RETURN => [
                'en' => 'Sale Return',
                'ar' => 'مردودات المبيعات',
            ],
            self::PURCHASE_PRODUCT => [
                'en' => 'Purchase Product',
                'ar' => 'شراء المنتج',
            ],
            self::PURCHASE_RETURN => [
                'en' => 'Purchase Return',
                'ar' => 'مردودات المشتريات',
            ],
            self::SALARY => [
                'en' => 'Salary',
                'ar' => 'الراتب',
            ],
            self::EXPENSES => [
                'en' => 'Expenses',
                'ar' => 'المصروفات',
            ],
            self::COST_OF_GOOD_SOLD => [
                'en' => 'Cost Of Good Sold',
                'ar' => 'صافي المبيعات',
            ],
            self::PURCHASE_PAYMENT_PENDING => [
                'en' => 'Purchase Payment Pending',
                'ar' => 'في انتظار الدفع ثمن المشتريات',
            ],
            self::PURCHASE_PAYMENT_SUCCEED => [
                'en' => 'Purchase Payment Succeed',
                'ar' => 'تم دفع ثمن المشتريات بنجاح',
            ],
            self::SALE_PAYMENT_PENDING => [
                'en' => 'Sale Payment Pending',
                'ar' => 'في انتظار دفع ثمن المبيعات',
            ],
            self::SALE_PAYMENT_SUCCEED => [
                'en' => 'Sale Payment Succeed',
                'ar' => 'تم دفع ثمن المبيعات بنجاح',
            ],
            self::INVENTORY_ADJUSTMENT => [
                'en' => 'Inventory Adjustment',
                'ar' => 'تعديل المخزون',
            ],
            self::BANK_TRANSFER => [
                'en' => 'Bank Transfer',
                'ar' => 'تحويل بنكي',
            ],
            self::CASH_DEPOSIT => [
                'en' => 'Cash Deposit',
                'ar' => 'إيداع نقدي',
            ],
            self::CASH_WITHDRAWAL => [
                'en' => 'Cash Withdrawal',
                'ar' => 'سحب نقدي',
            ],
            self::LOAN_PAYMENT => [
                'en' => 'Loan Payment',
                'ar' => 'دفع القرض',
            ],
            self::INTEREST_INCOME => [
                'en' => 'Interest Income',
                'ar' => 'دخل الفائدة',
            ],
            self::INTEREST_EXPENSE => [
                'en' => 'Interest Expense',
                'ar' => 'مصروف الفائدة',
            ],
            self::DEPRECIATION => [
                'en' => 'Depreciation',
                'ar' => 'الإهلاك',
            ],
            self::AMORTIZATION => [
                'en' => 'Amortization',
                'ar' => 'الإطفاء',
            ],
            self::CAPITAL_CONTRIBUTION => [
                'en' => 'Capital Contribution',
                'ar' => 'المساهمة في رأس المال',
            ],
            self::DIVIDEND_PAYMENT => [
                'en' => 'Dividend Payment',
                'ar' => 'دفع أرباح الأسهم',
            ],
            self::PURCHASE_DISCOUNT => [
                'en' => 'Purchase Discount',
                'ar' => 'خصم المشتريات',
            ],
            self::SALE_DISCOUNT => [
                'en' => 'Sale Discount',
                'ar' => 'خصم المبيعات',
            ],
            self::TAX_PAYMENT => [
                'en' => 'Tax Payment',
                'ar' => 'دفع الضرائب',
            ],
            self::REFUND => [
                'en' => 'Refund',
                'ar' => 'استرداد',
            ],
            self::WRITE_OFF => [
                'en' => 'Write Off',
                'ar' => 'شطب',
            ],
        ];
    }

    // Define methods to get the English and Arabic names for a given account activity ID
    public static function getNameEn($id)
    {
        return self::getAll()[$id]['en'] ?? null;
    }

    public static function getNameAr($id)
    {
        return self::getAll()[$id]['ar'] ?? null;
    }
 
    public static function getAccountActivityNameLang()
    {
        return "account_activity_name_" . Translation::getLang();
    }
}
