<?php

namespace Database\Seeders;

use App\Models\AccountSubControl;
use Illuminate\Database\Seeder;

class AccountSubControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            /********************************** Current Assets *********************************/

            [
                "account_code" => "111",
                "account_sub_control_name_en" => "Cash On Hand",
                "account_sub_control_name_ar" => "الصندوق",
                "account_control_id" => "11",
                "account_head_id" => "1",
                "created_at" => now(),
                "updated_at" => now(),
            ],

            [
                "account_code" => "112",
                "account_sub_control_name_en" => "Cash On Bank",
                "account_sub_control_name_ar" => "البنك",
                "account_control_id" => "11",
                "account_head_id" => "1",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "113",
                "account_sub_control_name_en" => "Debitors",
                "account_sub_control_name_ar" => "المدينون",
                "account_control_id" => "11",
                "account_head_id" => "1",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "114",
                "account_sub_control_name_en" => "Account Receivable",
                "account_sub_control_name_ar" => "اوراق القبض",
                "account_control_id" => "11",
                "account_head_id" => "1",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "115",
                "account_sub_control_name_en" => "Inventory",
                "account_sub_control_name_ar" => "المخزون",
                "account_control_id" => "11",
                "account_head_id" => "1",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "116",
                "account_sub_control_name_en" => "Accrued Revenue",
                "account_sub_control_name_ar" => "الإيرادات المستحقة",
                "account_control_id" => "11",
                "account_head_id" => "1",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "117",
                "account_sub_control_name_en" => "Prepaid Expenses",
                "account_sub_control_name_ar" => "مصروفات مدفوعة مقدما",
                "account_control_id" => "11",
                "account_head_id" => "1",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "118",
                "account_sub_control_name_en" => "Customers",
                "account_sub_control_name_ar" => "الزبائن",
                "account_control_id" => "11",
                "account_head_id" => "1",
                "created_at" => now(),
                "updated_at" => now(),
            ],

            /*******************************  Fixed Assets ************************************/

            [
                "account_code" => "121",
                "account_sub_control_name_en" => "Lands",
                "account_sub_control_name_ar" => "الاراضي",
                "account_control_id" => "12",
                "account_head_id" => "1",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "122",
                "account_sub_control_name_en" => "Building",
                "account_sub_control_name_ar" => "المباني",
                "account_control_id" => "12",
                "account_head_id" => "1",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "123",
                "account_sub_control_name_en" => "Autos & Trucks",
                "account_sub_control_name_ar" => "وسائل النقل",
                "account_control_id" => "12",
                "account_head_id" => "1",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "124",
                "account_sub_control_name_en" => "Furniture",
                "account_sub_control_name_ar" => "أثاث",
                "account_control_id" => "12",
                "account_head_id" => "1",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "125",
                "account_sub_control_name_en" => "Computers",
                "account_sub_control_name_ar" => "أثاث",
                "account_control_id" => "12",
                "account_head_id" => "1",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            /*******************************  intangible Assets ************************************/

            [
                "account_code" => "131",
                "account_sub_control_name_en" => "Brand",
                "account_sub_control_name_ar" => "العلامة التجارية",
                "account_control_id" => "13",
                "account_head_id" => "1",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "132",
                "account_sub_control_name_en" => "Patent",
                "account_sub_control_name_ar" => "براءة الاختراع",
                "account_control_id" => "13",
                "account_head_id" => "1",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "133",
                "account_sub_control_name_en" => "Popularity",
                "account_sub_control_name_ar" => "الشهرة",
                "account_control_id" => "13",
                "account_head_id" => "1",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            /******************************* Current Liabilities 2 ************************************/

            [
                "account_code" => "211",
                "account_sub_control_name_en" => "Creditors",
                "account_sub_control_name_ar" => "الدائنون",
                "account_control_id" => "21",
                "account_head_id" => "2",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "212",
                "account_sub_control_name_en" => "Notes Payable",
                "account_sub_control_name_ar" => "اوراق الدفع",
                "account_control_id" => "21",
                "account_head_id" => "2",
                "created_at" => now(),
                "updated_at" => now(),
            ],

            [
                "account_code" => "213",
                "account_sub_control_name_en" => "Short Loans",
                "account_sub_control_name_ar" => "قروض قصيرة الاجل",
                "account_control_id" => "21",
                "account_head_id" => "2",
                "created_at" => now(),
                "updated_at" => now(),
            ],

            [
                "account_code" => "214",
                "account_sub_control_name_en" => "Repaied Revenues",
                "account_sub_control_name_ar" => "ايرادات جارية مقبوضة مقدما",
                "account_control_id" => "21",
                "account_head_id" => "2",
                "created_at" => now(),
                "updated_at" => now(),
            ],

            [
                "account_code" => "215",
                "account_sub_control_name_en" => "Accured Charges",
                "account_sub_control_name_ar" => "مصروفات مستحقة",
                "account_control_id" => "21",
                "account_head_id" => "2",
                "created_at" => now(),
                "updated_at" => now(),
            ],

            [
                "account_code" => "215",
                "account_sub_control_name_en" => "Suppliers",
                "account_sub_control_name_ar" => "الموردون",
                "account_control_id" => "21",
                "account_head_id" => "2",
                "created_at" => now(),
                "updated_at" => now(),
            ],

            /******************************* Fixed Liabilities ************************************/

            [
                "account_code" => "221",
                "account_sub_control_name_en" => "Long-TermLoans",
                "account_sub_control_name_ar" => "قروض طويلة الاجل",
                "account_control_id" => "22",
                "account_head_id" => "2",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "222",
                "account_sub_control_name_en" => "OwnerShip",
                "account_sub_control_name_ar" => "حقوق الملكية",
                "account_control_id" => "22",
                "account_head_id" => "2",
                "created_at" => now(),
                "updated_at" => now(),
            ],

            /******************************* Revenues 31 ************************************/
            //	المبيعات Sales   311
            //	مردودات مبيعات Sales Returns   312
            //	مسموحات مبيعات Sales Discount   313
            [
                "account_code" => "311",
                "account_sub_control_name_en" => "Sales",
                "account_sub_control_name_ar" => "المبيعات",
                "account_control_id" => "31",
                "account_head_id" => "3",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "312",
                "account_sub_control_name_en" => "Sales Returns",
                "account_sub_control_name_ar" => "مردودات مبيعات",
                "account_control_id" => "31",
                "account_head_id" => "3",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "313",
                "account_sub_control_name_en" => "Sales Discount",
                "account_sub_control_name_ar" => "مسموحات مبيعات",
                "account_control_id" => "31",
                "account_head_id" => "3",
                "created_at" => now(),
                "updated_at" => now(),
            ],

            /******************************* Revenues 32 ************************************/

            //  ايرادات أخرى Other Sales 32

            //	ايجارات دائنة  Credit Rents 321
            [
                "account_code" => "321",
                "account_sub_control_name_en" => "Credit Rents",
                "account_sub_control_name_ar" => "ايجارات دائنة",
                "account_control_id" => "32",
                "account_head_id" => "3",
                "created_at" => now(),
                "updated_at" => now(),
            ],

            /******************************* Expenses 32 ************************************/
            // صافي المبيعات Cost Of Good Sold 41
            //	المشتريات Purchases   411
            //	مصاريف المشتريات Purchases  Expenses  412
            //	مردودات مشتريات Purchases Returns   413
            //	مسموحات مشتريات   Purchases Discount   414
            //   	مصاريف البيع والتسويق sale and marketing expenses 42
            //	      مصاريف البيع  sale expenses 421
            //	      عمولات البيع    sale commissions 422
            //	   دعاية واعلان   Advertising    423

            [
                "account_code" => "411",
                "account_sub_control_name_en" => "Purchases",
                "account_sub_control_name_ar" => "المشتريات",
                "account_control_id" => "41",
                "account_head_id" => "4",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "412",
                "account_sub_control_name_en" => "Purchases  Expenses",
                "account_sub_control_name_ar" => "مصاريف المشتريات",
                "account_control_id" => "41",
                "account_head_id" => "4",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "413",
                "account_sub_control_name_en" => "Purchases Returns",
                "account_sub_control_name_ar" => "مردودات مشتريات",
                "account_control_id" => "41",
                "account_head_id" => "4",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "414",
                "account_sub_control_name_en" => "Purchases Discount",
                "account_sub_control_name_ar" => "مسموحات مشتريات",
                "account_control_id" => "41",
                "account_head_id" => "4",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            //   	مصاريف البيع والتسويق sale and marketing expenses 42
            [
                "account_code" => "421",
                "account_sub_control_name_en" => "Sale expenses",
                "account_sub_control_name_ar" => "مصاريف البيع",
                "account_control_id" => "42",
                "account_head_id" => "4",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "422",
                "account_sub_control_name_en" => "Sale commissions",
                "account_sub_control_name_ar" => "عمولات البيع",
                "account_control_id" => "42",
                "account_head_id" => "4",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "423",
                "account_sub_control_name_en" => "Advertising",
                "account_sub_control_name_ar" => "دعاية واعلان",
                "account_control_id" => "42",
                "account_head_id" => "4",
                "created_at" => now(),
                "updated_at" => now(),
            ],

            //  10  مصاريف ادارية وعمومية   administrative expenses 43

            [
                "account_code" => "431",
                "account_sub_control_name_en" => "Payroll or Salaries",
                "account_sub_control_name_ar" => "الأجور",
                "account_control_id" => "43",
                "account_head_id" => "4",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "432",
                "account_sub_control_name_en" => "Rents",
                "account_sub_control_name_ar" => "الايجار",
                "account_control_id" => "43",
                "account_head_id" => "4",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "433",
                "account_sub_control_name_en" => "Electricity",
                "account_sub_control_name_ar" => "كهرباء",
                "account_control_id" => "43",
                "account_head_id" => "4",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "account_code" => "434",
                "account_sub_control_name_en" => "Maintenance",
                "account_sub_control_name_ar" => "الصيانة",
                "account_control_id" => "43",
                "account_head_id" => "4",
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];

        AccountSubControl::insert($data);
    }
}
