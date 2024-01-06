<?php
namespace App\Services;
//use transaction model
use App\Models\Transaction;
//use account setting
use App\Models\AccountSetting;
use Auth;

class SalesEntries
{
    public static function setEntries(
        $financialYearId,
        $accountHeadId,
        $accountControlId,
        $accountSubControlId,
        $invoiceNumber,
        $invoiceDate,
        $userId,
        $branchId,
        $credit,
        $debit,
        $transactionTitleEn,
        $transactionTitleAr
    ) {
        $setDebitEntry = new Transaction();
        $setDebitEntry->financial_year_id = $financialYearId;
        $setDebitEntry->account_head_id = $accountHeadId;
        $setDebitEntry->account_control_id = $accountControlId;
        $setDebitEntry->account_sub_control_id = $accountSubControlId;
        $setDebitEntry->invoice_number = $invoiceNumber;
        $setDebitEntry->transaction_date = $invoiceDate;
        $setDebitEntry->user_id = $userId;
        $setDebitEntry->branch_id = $branchId;
        $setDebitEntry->credit = $credit;
        $setDebitEntry->debit = $debit;
        $setDebitEntry->transaction_title_en = $transactionTitleEn;
        $setDebitEntry->transaction_title_ar = $transactionTitleAr;
        $setDebitEntry->save();
    }

    public static function getAccountSetting(
        $accountHeadCode,
        $accountControlCode,
        $accountSubControlCode,
        $accountActivityId
    ) {
        $entry = AccountSetting::where(
            "account_activity_id",
            $accountActivityId
        )->first();
        if (!isset($entry)) {
            $entry = new AccountSetting();
            $entry->account_head_id = $accountHeadCode;
            $entry->account_control_id = $accountControlCode;
            $entry->account_sub_control_id = $accountSubControlCode;
            $entry->account_activity_id = $accountActivityId;
            $entry->branch_id = Auth::user()->branch_id;
            $entry->company_id = Auth::user()->company_id;
            $entry->save();
        }
        return $entry;
    }
}
