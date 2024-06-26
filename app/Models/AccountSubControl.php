<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountSubControl extends Model
{
    use HasFactory; 
        // Define the constants for the account sub-control codes
        const CASH_ON_HAND = '111';
        const CASH_ON_BANK = '112';
        const DEBTORS = '113';
        const ACCOUNT_RECEIVABLE = '114';
        const INVENTORY = '115';
        const ACCRUED_REVENUE = '116';
        const PREPAID_EXPENSES = '117';
        const CUSTOMERS = '118';
        const LANDS = '121';
        const BUILDING = '122';
        const AUTOS_AND_TRUCKS = '123';
        const FURNITURE = '124';
        const COMPUTERS = '125';
        const BRAND = '131';
        const PATENT = '132';
        const POPULARITY = '133';
        const CREDITORS = '211';
        const NOTES_PAYABLE = '212';
        const SHORT_LOANS = '213';
        const REPAID_REVENUES = '214';
        const ACCRUED_CHARGES = '215';
        const SUPPLIERS = '216';
        const LONG_TERM_LOANS = '221';
        const OWNERSHIP = '222';
        const SALES = '311';
        const SALES_RETURNS = '312';
        const SALES_DISCOUNT = '313';
        const CREDIT_RENTS = '321';
        const PURCHASES = '411';
        const PURCHASES_EXPENSES = '412';
        const PURCHASES_RETURNS = '413';
        const PURCHASES_DISCOUNT = '414';
        const SALE_EXPENSES = '421';
        const SALE_COMMISSIONS = '422';
        const ADVERTISING = '423';
        const PAYROLL_OR_SALARIES = '431';
        const RENTS = '432';
        const ELECTRICITY = '433';
        const MAINTENANCE = '434';
        // Additional constants for potential future use
        
    
        // Define a method to get all account sub-controls with their names
        public static function getAll()
        {
            return [
                self::CASH_ON_HAND => [
                    'en' => 'Cash On Hand',
                    'ar' => 'الصندوق',
                ],
                self::CASH_ON_BANK => [
                    'en' => 'Cash On Bank',
                    'ar' => 'البنك',
                ],
                self::DEBTORS => [
                    'en' => 'Debtors',
                    'ar' => 'المدينون',
                ],
                self::ACCOUNT_RECEIVABLE => [
                    'en' => 'Account Receivable',
                    'ar' => 'اوراق القبض',
                ],
                self::INVENTORY => [
                    'en' => 'Inventory',
                    'ar' => 'المخزون',
                ],
                self::ACCRUED_REVENUE => [
                    'en' => 'Accrued Revenue',
                    'ar' => 'الإيرادات المستحقة',
                ],
                self::PREPAID_EXPENSES => [
                    'en' => 'Prepaid Expenses',
                    'ar' => 'مصروفات مدفوعة مقدما',
                ],
                self::CUSTOMERS => [
                    'en' => 'Customers',
                    'ar' => 'الزبائن',
                ],
                self::LANDS => [
                    'en' => 'Lands',
                    'ar' => 'الاراضي',
                ],
                self::BUILDING => [
                    'en' => 'Building',
                    'ar' => 'المباني',
                ],
                self::AUTOS_AND_TRUCKS => [
                    'en' => 'Autos & Trucks',
                    'ar' => 'وسائل النقل',
                ],
                self::FURNITURE => [
                    'en' => 'Furniture',
                    'ar' => 'أثاث',
                ],
                self::COMPUTERS => [
                    'en' => 'Computers',
                    'ar' => 'أثاث',
                ],
                self::BRAND => [
                    'en' => 'Brand',
                    'ar' => 'العلامة التجارية',
                ],
                self::PATENT => [
                    'en' => 'Patent',
                    'ar' => 'براءة الاختراع',
                ],
                self::POPULARITY => [
                    'en' => 'Popularity',
                    'ar' => 'الشهرة',
                ],
                self::CREDITORS => [
                    'en' => 'Creditors',
                    'ar' => 'الدائنون',
                ],
                self::NOTES_PAYABLE => [
                    'en' => 'Notes Payable',
                    'ar' => 'اوراق الدفع',
                ],
                self::SHORT_LOANS => [
                    'en' => 'Short Loans',
                    'ar' => 'قروض قصيرة الاجل',
                ],
                self::REPAID_REVENUES => [
                    'en' => 'Repaid Revenues',
                    'ar' => 'ايرادات جارية مقبوضة مقدما',
                ],
                self::ACCRUED_CHARGES => [
                    'en' => 'Accrued Charges',
                    'ar' => 'مصروفات مستحقة',
                ],
                self::SUPPLIERS => [
                    'en' => 'Suppliers',
                    'ar' => 'الموردون',
                ],
                self::LONG_TERM_LOANS => [
                    'en' => 'Long-Term Loans',
                    'ar' => 'قروض طويلة الاجل',
                ],
                self::OWNERSHIP => [
                    'en' => 'Ownership',
                    'ar' => 'حقوق الملكية',
                ],
                self::SALES => [
                    'en' => 'Sales',
                    'ar' => 'المبيعات',
                ],
                self::SALES_RETURNS => [
                    'en' => 'Sales Returns',
                    'ar' => 'مردودات مبيعات',
                ],
                self::SALES_DISCOUNT => [
                    'en' => 'Sales Discount',
                    'ar' => 'مسموحات مبيعات',
                ],
                self::CREDIT_RENTS => [
                    'en' => 'Credit Rents',
                    'ar' => 'ايجارات دائنة',
                ],
                self::PURCHASES => [
                    'en' => 'Purchases',
                    'ar' => 'المشتريات',
                ],
                self::PURCHASES_EXPENSES => [
                    'en' => 'Purchases Expenses',
                    'ar' => 'مصاريف المشتريات',
                ],
                self::PURCHASES_RETURNS => [
                    'en' => 'Purchases Returns',
                    'ar' => 'مردودات مشتريات',
                ],
                self::PURCHASES_DISCOUNT => [
                    'en' => 'Purchases Discount',
                    'ar' => 'مسموحات مشتريات',
                ],
                self::SALE_EXPENSES => [
                    'en' => 'Sale Expenses',
                    'ar' => 'مصاريف البيع',
                ],
                self::SALE_COMMISSIONS => [
                    'en' => 'Sale Commissions',
                    'ar' => 'عمولات البيع',
                ],
                self::ADVERTISING => [
                    'en' => 'Advertising',
                    'ar' => 'دعاية واعلان',
                ],
                self::PAYROLL_OR_SALARIES => [
                    'en' => 'Payroll or Salaries',
                    'ar' => 'الأجور',
                ],
                self::RENTS => [
                    'en' => 'Rents',
                    'ar' => 'الايجار',
                ],
                self::ELECTRICITY => [
                    'en' => 'Electricity',
                    'ar' => 'كهرباء',
                ],
                self::MAINTENANCE => [
                    'en' => 'Maintenance',
                    'ar' => 'الصيانة',
                ],
            ];
        }
    
        // Define methods to get the English and Arabic names for a given account sub-control code
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
        return $this->belongsTo(
            AccountHead::class,
            "account_head_id",
            "account_code"
        );
    }

    public function accountControl()
    {
        return $this->belongsTo(
            AccountControl::class, 
            "account_control_id",
            "account_code"
        );
    }

    public static function getAccountSubControlNameLang()
    {
        return "account_sub_control_name_" . Translation::getLang();
    }

    public function customers()
    {
      return  $this->hasMany(Customer::class);
    }

    public function suppliers()
    {
      return  $this->hasMany(Supplier::class);
    }
}
