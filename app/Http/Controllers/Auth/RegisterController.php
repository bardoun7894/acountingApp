<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Employee;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Database\Seeders\AccountControlSeeder;
use Database\Seeders\AccountHeadSeeder;
use Database\Seeders\AccountSettingSeeder;
use Database\Seeders\AccountActivitySeeder;
use Database\Seeders\AccountSubControlSeeder;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\FinanceSeeder;
use Database\Seeders\PaymentTypeSeeder;
use Database\Seeders\SellTypeSeeder;
use Database\Seeders\UnitSeeder;
use Database\Seeders\UserTypeSeeder;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    private $full_name;
    private $branch_name;
    private $company_name;
    private $employee_name;
    private $address;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->branch_name = Branch::getBranchNameLang();
        $this->full_name =
            "full_name_" . LaravelLocalization::getCurrentLocale();
        $this->company_name =
            "company_name_" . LaravelLocalization::getCurrentLocale();
        $this->employee_name = Employee::getEmployeeNameAttribute();
        $this->address = "address_" . LaravelLocalization::getCurrentLocale();
        $this->middleware("guest");
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            $this->full_name => ["required", "string", "max:255"],
            "username" => ["required", "string", "max:255", "unique:users"],
            "contact_number" => ["required", "string", "max:255"],
            "email" => [
                "required",
                "string",
                "email",
                "max:255",
                "unique:users",
            ],
            "password" => ["required", "string", "min:8", "confirmed"],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $full_name = $this->full_name;
        $branch_name = $this->branch_name;
        $company_name = $this->company_name;
        $address = $this->address;
        $employee_name = $this->employee_name;

        //seed usertypes

        if (count(User::all()) == 0) {
            $user_type_seeder = new UserTypeSeeder();
            $user_type_seeder->run();
        }
        // create new company
        $company = new \App\Models\Company();
        $company->$company_name = $data[$company_name];

        $company->save();

        //create new branch
        $branch = new \App\Models\Branch();
        $branch->$branch_name = $data[$branch_name];
        $branch->$address = $data["branch_address"];
        $branch->company_id = $company->id;
        $branch->save();
        //create user
        $user = new User();
        $user->$full_name = $data[$full_name];
        $user->$address = $data[$address];
        $user->user_type_id = $data["user_type_id"];
        $user->username = $data["username"];
        $user->email = $data["email"];
        $user->company_id = $company->id;
        $user->branch_id = $branch->id;
        $user->contact_number = $data["contact_number"];
        $user->password = Hash::make($data["password"]);
        $user->Save();
        // create Employee;
        $employee = new Employee();
        $employee->user_id = $user->id;
        $employee->$employee_name = $user->$full_name;
        $employee->employee_contact_number = $user->contact_number;
        $employee->employee_email = $user->email;
        $employee->address = $user->address;
        $employee->branch_id = $branch->id;
        $employee->company_id = $company->id;
        $employee->save();

        if (count(User::all()) == 1) {
            $user->isActive = 1;
            $user->save();
            //seed financial year
            $financeYearSeeder = new FinanceSeeder();
            $financeYearSeeder->run($user->id);
            //seed account heads
            $accountHeadSeeder = new AccountHeadSeeder();
            $accountHeadSeeder->run($user->id, $company->id, $branch->id);
            //seed account control
            $accountControlSeeder = new AccountControlSeeder();
            $accountControlSeeder->run($user->id, $branch->id, $company->id);

            //seed account sub control
            $accountSubControlSeeder = new AccountSubControlSeeder();
            $accountSubControlSeeder->run($user->id, $branch->id, $company->id);

            //seed account settings
            $accountSettingsSeeder = new AccountSettingSeeder();
            $accountSettingsSeeder->run($branch->id, $company->id);

            //seed account activities
            $accountActivitySeeder = new AccountActivitySeeder();
            $accountActivitySeeder->run();
            //seed units
            $unitSeeder = new UnitSeeder();
            $unitSeeder->run();

            //seed payment types
            $paymentTypeSeeder = new PaymentTypeSeeder();
            $paymentTypeSeeder->run();

            //seed Sell type
            $sellTypeSeeder = new SellTypeSeeder();
            $sellTypeSeeder->run();
            //seed currency
            $currencySeeder = new CurrencySeeder();
            $currencySeeder->run();
        } else {
            $user->isActive = 0;
            $user->save();
            //seed financial year
            $financeYearSeeder = new FinanceSeeder();
            $financeYearSeeder->run($user->id);
            //seed account heads
            $accountHeadSeeder = new AccountHeadSeeder();
            $accountHeadSeeder->run($user->id, $company->id, $branch->id);
            //seed account control
            $accountControlSeeder = new AccountControlSeeder();
            $accountControlSeeder->run($user->id, $branch->id, $company->id);

            //seed account sub control
            $accountSubControlSeeder = new AccountSubControlSeeder();
            $accountSubControlSeeder->run($user->id, $branch->id, $company->id);

            //seed account settings
            $accountSettingsSeeder = new AccountSettingSeeder();
            $accountSettingsSeeder->run($branch->id, $company->id);

            // //seed account activities
            // $accountActivitySeeder = new AccountActivitySeeder();
            // $accountActivitySeeder->run();
            //seed units
            $unitSeeder = new UnitSeeder();
            $unitSeeder->run();
        }

        return $user;
    }
}
