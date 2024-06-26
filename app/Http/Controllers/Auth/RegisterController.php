<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AccountControl;
use App\Models\AccountHead;
use App\Models\AccountSubControl;
use App\Models\Branch;
use App\Models\Company;
//store
use App\Models\Store;
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
use DB;
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
    private $fullName;
    private $branchName;
    private $companyName;
    private $storeName ;
    private $employeeName;

    private $address;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->branchName = Branch::getBranchNameLang();
        $this->storeName =Store::getStoreNameLang()    ;
        $this->fullName = User::getFullnameLang();
        $this->companyName = Company::getCompanyNameLang();
        $this->employeeName = Employee::getEmployeeNameAttribute();

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
        $max255 = "max:255";
        return Validator::make($data, [
            $this->fullName => ["required", "string",$max255],
            "username" => ["required", "string", $max255, "unique:users"],
            "contact_number" => ["required", "string", $max255],
            "email" => [
                "required",
                "string",
                "email",
                $max255,
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
        $isFirstUser = User::count() == 0;
        $fullName = $this->fullName;
        $branchName = $this->branchName;
        $storeName = $this->storeName;
        $companyName = $this->companyName;
        $address = $this->address;
        $employeeName = $this->employeeName;

        //seed usertypes

        if ($isFirstUser) {
            $user_type_seeder = new UserTypeSeeder();
            $user_type_seeder->run();
        }
        // create new company
        $company = new  Company();
        $company->$companyName = $data[$companyName];
        $company->save();

        //create new branch
        $branch = new  Branch();
        $branch->$branchName = $data[$branchName];
        $branch->$address = $data["branch_address"];
        $branch->company_id = $company->id;
        $branch->save();
        //create new store
        $store = new  Store();
        $store->$storeName = $data[$storeName];
        $store->branch_id = $branch->id;
        $store->company_id = $company->id;
        $store->save();
        //create user
        $user = new User();
        $user->$fullName = $data[$fullName];
        $user->$address = $data[$address];
        $user->user_type_id = "2";
        // $user->user_type_id = "$data["user_type_id"]";
        $user->username = $data["username"];
        $user->email = $data["email"];
        $user->store_id = $store->id;
        $user->company_id = $company->id;
        $user->branch_id = $branch->id;
        $user->contact_number = $data["contact_number"];
        $user->password = Hash::make($data["password"]);
        $user->Save();
        // create Employee;
        $employee = new Employee();
        $employee->user_id = $user->id;
        $employee->$employeeName = $user->$fullName;
        $employee->employee_contact_number = $user->contact_number;
        $employee->employee_email = $user->email;
        $employee->address = $user->address;
        $employee->branch_id = $branch->id;
     // $employee->store_id = $store->id;
        $employee->company_id = $company->id;
        $employee->save();


         // Link existing accounts to the new user
    // $existingAccountHeads = AccountHead::all(); // Get all account heads
    // foreach ($existingAccountHeads as $accountHead) {
    //     $existingAccountControls = AccountControl::where('account_head_id', $accountHead->id)->get();
    //     foreach ($existingAccountControls as $accountControl) {
    //         $existingAccountSubcontrols = AccountSubControl::where('account_control_id', $accountControl->id)->get();
    //         foreach ($existingAccountSubcontrols as $accountSubcontrol) {
    //             \DB::table('user_account_relationships')->insert([
    //                 'user_id' => $user->id,
    //                 'account_head_id' => $accountHead->id,
    //                 'account_control_id' => $accountControl->id,
    //                 'account_subcontrol_id' => $accountSubcontrol->id,
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
    //             ]);
    //         }
    //     }
    // }

        DB::beginTransaction();

        try {
            $user->isActive = $isFirstUser ? 1 : 0;
            $user->save();
            (new FinanceSeeder($user->id))->run();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // Handle the exception (log it, notify someone, etc.)
            throw $e;
        }



        return $user;
    }

}
