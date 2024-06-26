<?php

namespace Database\Seeders;

use App\Models\AccountActivity;
use Illuminate\Database\Seeder;

class AccountActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "id" => 1,
                "account_activity_name_en" => "Sale",
                "account_activity_name_ar" => "بيع",
            ],
            [
                "id" => 2,
                "account_activity_name_en" => "Sale Return",
                "account_activity_name_ar" => "مردودات المبيعات",
            ],
            [
                "id" => 3,
                "account_activity_name_en" => "Purchase Product",
                "account_activity_name_ar" => "شراء المنتج",
            ],
            [
                "id" => 4,
                "account_activity_name_en" => "Purchase Return",
                "account_activity_name_ar" => "مردودات المشتريات",
            ],
            [
                "id" => 5,
                "account_activity_name_en" => "Salary",
                "account_activity_name_ar" => "الراتب",
            ],
            [
                "id" => 6,
                "account_activity_name_en" => "Expenses",
                "account_activity_name_ar" => "المصروفات",
            ],
            [
                "id" => 7,
                "account_activity_name_en" => "Cost Of Good Sold",
                "account_activity_name_ar" => "صافي المبيعات",
            ],
            [
                "id" => 8,
                "account_activity_name_en" => "Purchase Payment Pending",
                "account_activity_name_ar" => "في انتظار الدفع ثمن المشتريات",
            ],
            [
                "id" => 9,
                "account_activity_name_en" => "Purchase Payment Succeed",
                "account_activity_name_ar" => " تم دفع ثمن المشتريات بنجاح",
            ],
            [
                "id" => 10,
                "account_activity_name_en" => "Sale Payment Pending",
                "account_activity_name_ar" => "في انتظار  دفع ثمن المبيعات",
            ],
            [
                "id" => 11,
                "account_activity_name_en" => "Sale Payment Succeed",
                "account_activity_name_ar" => " تم دفع ثمن المبيعات بنجاح",
            ],
            //  // Additional constants for potential future use
            // const INVENTORY_ADJUSTMENT = 12;
            // const BANK_TRANSFER = 13;
            // const CASH_DEPOSIT = 14;
            // const CASH_WITHDRAWAL = 15;
            // const LOAN_PAYMENT = 16;
            // const INTEREST_INCOME = 17;
            // const INTEREST_EXPENSE = 18;
            // const DEPRECIATION = 19;
            // const AMORTIZATION = 20;
            // const CAPITAL_CONTRIBUTION = 21;
            // const DIVIDEND_PAYMENT = 22;
            // const PURCHASE_DISCOUNT = 23;
            // const SALE_DISCOUNT = 24;
            // const TAX_PAYMENT = 25;
            // const REFUND = 26;
            // const WRITE_OFF = 27; 
            [
                "id" => 12,
                "account_activity_name_en" => "Inventory Adjustment",
                "account_activity_name_ar" => "تعديل المخزون",
            ],
            [
                "id" => 13,
                "account_activity_name_en" => "Bank Transfer",
                "account_activity_name_ar" => "تحويل بنكي",
            ],
            [
                "id" => 14,
                "account_activity_name_en" => "Cash Deposit",
                "account_activity_name_ar" => "إيداع نقدي",
            ],
            [
                "id" => 15,
                "account_activity_name_en" => "Cash Withdrawal",
                "account_activity_name_ar" => "سحب نقدي",
            ],
            [
                "id" => 16,
                "account_activity_name_en" => "Loan Payment",
                "account_activity_name_ar" => "تسديد القروض",
            ],
            [
                "id" => 17,
                "account_activity_name_en" => "Interest Income",
                "account_activity_name_ar" => "دخل الأفقات",
            ],
            [
                "id" => 18,
                "account_activity_name_en" => "Interest Expense",
                "account_activity_name_ar" => "مصروفات الأفقات",
            ],
            [
                "id" => 19,
                "account_activity_name_en" => "Depreciation",
                "account_activity_name_ar" => "اهلاك",
            ],
            [
                "id" => 20,
                "account_activity_name_en" => "Amortization",
                "account_activity_name_ar" => "تصفية",
            ],
            [
                "id" => 21,
                "account_activity_name_en" => "Capital Contribution",
                "account_activity_name_ar" => "تموين الاقتصادي",
            ],
            [
                "id" => 22,
                "account_activity_name_en" => "Dividend Payment",
                "account_activity_name_ar" => "دفع الأسهم",
            ],
            [
                "id" => 23,
                "account_activity_name_en" => "Purchase Discount",
                "account_activity_name_ar" => "خصم المشتريات",
            ],
            [
                "id" => 24,
                "account_activity_name_en" => "Sale Discount",
                "account_activity_name_ar" => "خصم المبيعات",
            ],
            [
                "id" => 25,
                "account_activity_name_en" => "Tax Payment",
                "account_activity_name_ar" => "دفع الضريبة",
            ],
            [
                "id" => 26,
                "account_activity_name_en" => "Refund",
                "account_activity_name_ar" => "استرداد",
            ],
            [
                "id" => 27,
                "account_activity_name_en" => "Write Off",
                "account_activity_name_ar" => "تسوية",
            ],


        ];

        AccountActivity::insert($data);
    }
}
