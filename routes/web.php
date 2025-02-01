<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   
    return view('login');
});
Route::get('/recoveramount', function () {
   
    return view('recoveriess');
});
//Route::get('/stockview', function () {
   
  //  return view('stockview');
//});
//activestock
//ledgerbillprint
Route::get('/ledgerbillprint', function () {
   
    return view('ledgerbillprint');
});
Route::get('/expensehead', function () {
   
    return view('expensehead');
});
Route::get('/expenses', function () {
   
    return view('expenses');
});
Route::get('/profitfinal', function () {
   
    return view('profitfinal');
});
Route::get('/dailycash', function () {
   
    return view('dailycash');
});
Route::get('/stockview','App\Http\Controllers\products@activestock');
Route::get('/updateitem','App\Http\Controllers\items@updateitem');
Route::get('/itemupdates', function () {
   
    return view('itemupdates');
});
//Route::get('/stockreport', function () {
   
  //  return view('stockreport');
//});
Route::get('/salesbillprint1', function () {
   
    return view('salesbillprint1');
});
Route::get('/availbilitybillprint1', function () {
   
    return view('availbilitybillprint1');
});
Route::get('/balancesheet', 'App\Http\Controllers\transaccounts@balanceSheet');
Route::get('/login', 'App\Http\Controllers\users@login');
Route::get('/logout', 'App\Http\Controllers\users@logout');
Route::get('/welcome', function () {
   
    return view('welcome');
});

Route::get('/updateproducts', function () {
    return view('updateproducts');
});
Route::get('/bookers','App\Http\Controllers\bookers@fetchtown');
Route::get('/updatecustomers','App\Http\Controllers\books@updatebooks');
Route::get('/company', function () { return view('company');});
Route::get('/brand', function () { return view('brand');});
Route::get('/deleteBrand', 'App\Http\Controllers\brands@delete');
Route::get('/addBrand','App\Http\Controllers\brands@addCompany');
Route::get('/fetch-brand', 'App\Http\Controllers\brands@fetchcompany');
Route::get('/brand1', 'App\Http\Controllers\brands@search');
Route::get('/brand2', 'App\Http\Controllers\brands@demention');
Route::get('/brand2stock', 'App\Http\Controllers\brands@prod_stock');
Route::get('/thikness', 'App\Http\Controllers\brands@thikness');
Route::get('/cogroup', function () { return view('cogroup');});
Route::get('/town', function () { return view('town');});
Route::get('/employees', function () { return view('employees');});
Route::get('/productDiscount', function () { return view('productDiscount');});
Route::get('/customerledger', function () { return view('customerledger');});
Route::get('/customerledgerdetails', function () { return view('customerledgerdetails');});//reportTabs
Route::get('/reportTabs', function () { return view('reportTabs');});
Route::get('/reportNextTabs', function () { return view('reportNextTabs');});
Route::get('/customerledgerdetailsfinal', function () { return view('customerledgerdetailsfinal');});
Route::get('/datevisesales', function () { return view('datevisesales');});
Route::get('/dateviserecovery', function () { return view('dateviserecovery');});
Route::get('/reportone', 'App\Http\Controllers\tanveerReports@wholesale');
Route::get('/updateuser', function () { return view('updateuser');});
Route::get('/adduser','App\Http\Controllers\users@adduser');
Route::get('/createuser','App\Http\Controllers\users@showuser');
Route::get('/datevisepayments', function () { return view('datevisepayments');});
Route::get('/dateviseexpenses', function () { return view('dateviseexpenses');});
Route::get('/productvisesales', function () { return view('productvisesales');});
Route::get('/productvisepurchases', function () { return view('productvisepurchases');});
Route::get('/wholesalesSummary', function () { return view('wholesalesSummary');});
Route::get('/wholesalesMonthlySummary', function () { return view('wholesalesMonthlySummary');});

Route::get('/localsalessummary', function () { return view('localsalessummary');});
Route::get('/customervisesales', function () { return view('customervisesales');});
Route::get('/salemanvisesales', function () { return view('salemanvisesales');});
Route::get('/customervisepurchases', function () { return view('customervisepurchases');});
Route::get('/customervisepayments', function () { return view('customervisepayments');});
Route::get('/customerviserecovery', function () { return view('customerviserecovery');});
Route::get('/entryproducts', 'App\Http\Controllers\products@index');
Route::get('/items', 'App\Http\Controllers\items@index');
Route::get('/additem','App\Http\Controllers\items@addproduct');
Route::get('/home', 'App\Http\Controllers\sales@index');
Route::get('/customer-ledger', 'App\Http\Controllers\transaccounts@datesale');
Route::get('/cashbanktransection', 'App\Http\Controllers\transaccounts@cashbanktransection');
Route::get('/customer-ledger1', 'App\Http\Controllers\transaccounts@datesale1');
Route::get('/profitView', 'App\Http\Controllers\transaccounts@profitView');
Route::get('/cashView', 'App\Http\Controllers\transaccounts@cashView');
//customer-ledger-print cashbanktransection
Route::get('/customer-ledger-print', 'App\Http\Controllers\transaccounts@datesale2');
Route::get('/public-ledger', 'App\Http\Controllers\transaccounts@publicLedgers');
Route::get('/public-ledger-details', 'App\Http\Controllers\transaccounts@publicLedgerDetails');
Route::get('/date-vise-payment', 'App\Http\Controllers\payments@datesale');
Route::get('/date-vise-expenses', 'App\Http\Controllers\payments@dailyexpenses');
Route::get('/date-vise-recovery', 'App\Http\Controllers\recoverys@datesale');
Route::get('/salesrecovery', 'App\Http\Controllers\recoverys@salesrecovery');
Route::get('/bill', 'App\Http\Controllers\recoverys@salesinvoice');
Route::get('/billpurchase', 'App\Http\Controllers\recoverys@purchaseinvoice');
Route::get('fetch-deshboard', 'App\Http\Controllers\books@dashboard');

Route::get('/autopayment-now', 'App\Http\Controllers\payments@autopaymentcustomer');
Route::get('/autorecovry-now', 'App\Http\Controllers\recoverys@autopaymentcustomer');


//Route::resource('sales', 'App\Http\Controllers\sales')->middleware('CheckUser');
Route::resource('payments', 'App\Http\Controllers\payments');
Route::resource('recoverys', 'App\Http\Controllers\recoverys');
Route::get('/cashRecovery', 'App\Http\Controllers\recoverys@index1');
Route::get('/billViseRecovery', 'App\Http\Controllers\recoverys@billRecovery');
Route::get('/newbook','App\Http\Controllers\salesbooks@addNew');
Route::get('/updatemyuser','App\Http\Controllers\users@updateuser');
Route::get('/updateBooker','App\Http\Controllers\bookers@updateEmployee');
Route::get('/addBooker','App\Http\Controllers\bookers@addEmployee');
Route::get('/addcustomers','App\Http\Controllers\books@addproduct');
Route::POST('/addproductfromsales','App\Http\Controllers\books@addproductfromsales');
Route::get('/customer','App\Http\Controllers\books@fetchtown');
Route::get('/addDisco','App\Http\Controllers\discounts@addDiscount');
Route::get('/addEmployee','App\Http\Controllers\employees@addEmployee');
Route::get('/addTown','App\Http\Controllers\discounts@addTown');
Route::get('/addCompany','App\Http\Controllers\discounts@addCompany');
Route::get('/addHead','App\Http\Controllers\discounts@addHead');
Route::get('/addGroup','App\Http\Controllers\discounts@addcogroup');
Route::get('/addproduct','App\Http\Controllers\products@addproduct');
Route::get('/entryproducts','App\Http\Controllers\products@show');
Route::get('/singleproduct','App\Http\Controllers\products@showsingle');
Route::get('/update-rate','App\Http\Controllers\products@updateproduct');
Route::get('/update-customer','App\Http\Controllers\books@updateproduct');
Route::get('/deleteproduct','App\Http\Controllers\products@deleteproduct');
Route::get('/paymentdelete/{id}','App\Http\Controllers\payments@destroy');
Route::get('/paymentdelete1/{id}','App\Http\Controllers\payments@destroyExpenses');
Route::get('/recoverydelete/{id}','App\Http\Controllers\recoverys@destroy');
Route::get('/deleteuser/','App\Http\Controllers\users@destroy');
Route::get('/fetch-town', 'App\Http\Controllers\discounts@fetchtown');
Route::get('/fetchstartsalary', 'App\Http\Controllers\salaries@fetchstart');
Route::get('/fetchsalarynames', 'App\Http\Controllers\salaries@salarynames');
Route::get('/addSalary', 'App\Http\Controllers\salaries@addSalary');
Route::get('/fetch-Employee', 'App\Http\Controllers\employees@fetchEmployee');
Route::get('/fetch-company', 'App\Http\Controllers\discounts@fetchcompany');
Route::get('/fetch-head', 'App\Http\Controllers\discounts@fetchhead');
Route::get('/fetch-product', 'App\Http\Controllers\products@fetchstudent');
Route::get('/fetch-payments', 'App\Http\Controllers\payments@fetchpayments');
Route::get('/fetch-recovery-datewise', 'App\Http\Controllers\recoverys@fetchrecoverydatewise');
Route::get('/fetch-cash-recovery-datewise', 'App\Http\Controllers\recoverys@fetchcashrecoverydatewise');
Route::get('/fetch-expenses', 'App\Http\Controllers\payments@fetchexpenses');
// Route::get('/fetch-recory', 'App\Http\Controllers\recoverys@fetchrecoverys');
Route::get('/fetch-bank-recory', 'App\Http\Controllers\recoverys@fetchbankrecoverys');
Route::get('/salrecovery', 'App\Http\Controllers\recoverys@salerecovery');
Route::get('/fetch-sales-record', 'App\Http\Controllers\salesbooks@viewbooks');

Route::get('/fetch-customer', 'App\Http\Controllers\books@fetchpurchaselist');
Route::get('/fetch-books', 'App\Http\Controllers\books@fetchrate');
Route::get('/payments_single', 'App\Http\Controllers\payments@calcu');
Route::get('/expenses_single', 'App\Http\Controllers\payments@calcuexp');
Route::get('/recovery_single', 'App\Http\Controllers\recoverys@calcu');
Route::get('/recovery_bank', 'App\Http\Controllers\recoverys@bankRecovery');
Route::get('/recovery_bank_update', 'App\Http\Controllers\recoverys@bankRecoveryUpdate');
Route::get('/cash_recovery', 'App\Http\Controllers\recoverys@cashRecovery');
Route::get('/cash_recovery_update', 'App\Http\Controllers\recoverys@cashRecoveryUpdate');
Route::get('/finalbills', 'App\Http\Controllers\salesbooks@finalBill');
Route::get('/deleteDiscount', 'App\Http\Controllers\discounts@delete');
Route::get('/deleteTown', 'App\Http\Controllers\discounts@deleteTown');
Route::get('/deleteCompany', 'App\Http\Controllers\discounts@deleteCompany');
Route::get('/deleteHead', 'App\Http\Controllers\discounts@deleteHead');
Route::get('/deleteCogroup', 'App\Http\Controllers\discounts@deleteCogroup');
Route::get('/deleteSalary', 'App\Http\Controllers\salaries@delete');
Route::get('/deleteEmployee', 'App\Http\Controllers\employees@deleteEmployee');
Route::get('/productdelete/{id}', 'App\Http\Controllers\products@destroy');
Route::get('/customerdelete/{id}', 'App\Http\Controllers\books@destroy');
Route::get('/stock-vise', 'App\Http\Controllers\products@activestock');
Route::get('/stockreport', 'App\Http\Controllers\products@showstock');
Route::get('/download-stock-vise', 'App\Http\Controllers\products@downloadPDF');





//purchase Module
Route::get('/date-vise-view', 'App\Http\Controllers\purchases@dateinvoicedetails');
Route::get('/date-vise-purchase', 'App\Http\Controllers\purchases@datesale');
Route::resource('purchases', 'App\Http\Controllers\purchases');
Route::get('/datevisepurchases', function () { return view('dailypurchases');});
Route::get('/fetch-purchases', 'App\Http\Controllers\purchases@fetchpurchaselist');
Route::get('/autocomplete-now', 'App\Http\Controllers\purchases@autocompleteSearch');
Route::get('/autopurchase-customer', 'App\Http\Controllers\purchases@autopurchasecustomer');
Route::get('/purchasedelete', 'App\Http\Controllers\purchases@destroy');
Route::get('/finalpurchases', 'App\Http\Controllers\purchases@finalBill');
Route::get('/purchase_single', 'App\Http\Controllers\purchases@calcu');
Route::get('/fetch-rate', 'App\Http\Controllers\purchases@fetchrate');

//purchase returns
Route::resource('purchasereturns', 'App\Http\Controllers\purchasereturns');
Route::get('/fetch-purchasesr', 'App\Http\Controllers\purchasereturns@fetchpurchaselist');
Route::get('/purchasedeleter', 'App\Http\Controllers\purchasereturns@destroy');
Route::get('/finalpurchasesr', 'App\Http\Controllers\purchasereturns@finalBill');
Route::get('/purchase_singler', 'App\Http\Controllers\purchasereturns@calcu');


//sales Module saverate
Route::resource('sales', 'App\Http\Controllers\sales');
Route::get('/localsales', 'App\Http\Controllers\sales@index1');
Route::resource('availbility', 'App\Http\Controllers\availbilitysales');
Route::get('/autocomplete-search', 'App\Http\Controllers\sales@autocompleteSearch');
Route::get('/saverate', 'App\Http\Controllers\sales@saverate');
//ledgerbillprint deleteCashRecovery
Route::get('/salesbillprint1', 'App\Http\Controllers\sales@fetchstudentprint');
Route::get('/salesbillprint2', 'App\Http\Controllers\sales@fetchstudentprint1');
Route::get('/availbilitybillprint1', 'App\Http\Controllers\availbilitysales@fetchstudentprint');
Route::get('/viewpurchases', 'App\Http\Controllers\sales@fetchstudentprint');
Route::get('/autosale-customer', 'App\Http\Controllers\sales@autopurchasecustomer');
Route::get('/deleteWholeSale', 'App\Http\Controllers\sales@delete');
Route::get('/deleteLocalSale', 'App\Http\Controllers\sales@deleteLocalSale');
Route::get('/deleteCashRecovery', 'App\Http\Controllers\recoverys@deleteCashRecovery');
Route::get('/deleteBankRecovery', 'App\Http\Controllers\recoverys@deleteBankRecovery');
Route::get('/deletesales1', 'App\Http\Controllers\sales1@delete');
Route::get('/deletesales2', 'App\Http\Controllers\sales1@delete1');
Route::get('/deleteavailbility', 'App\Http\Controllers\availbilitysales@delete');
Route::get('/deleteinvoice', 'App\Http\Controllers\sales@deleteinvoice');
Route::get('/final-bill', 'App\Http\Controllers\sales@finalBill');
Route::get('/final-bill-avilbility', 'App\Http\Controllers\availbilitysales@finalBill');
Route::get('/fetch-stock', 'App\Http\Controllers\sales@fetchrate');
Route::get('/fetch-student', 'App\Http\Controllers\sales@fetchstudent');
Route::get('/fetchstudent1', 'App\Http\Controllers\sales@fetchstudent1');
Route::get('/fetch-student-availbility', 'App\Http\Controllers\availbilitysales@fetchstudent');
//getSaleUpdate getCashRecoveryUpdate
Route::get('/getCashRecoveryUpdate', 'App\Http\Controllers\recoverys@getCashRecoveryUpdate');
Route::get('/getBankRecoveryUpdate', 'App\Http\Controllers\recoverys@getBankRecoveryUpdate');
Route::get('/getSaleUpdate', 'App\Http\Controllers\sales@getSaleUpdate');
Route::get('/getLocalSaleUpdate', 'App\Http\Controllers\sales@getLocalSaleUpdate');
Route::get('/updateWholeSale', 'App\Http\Controllers\sales@updateWholeSale');
Route::get('/updateLocalSale', 'App\Http\Controllers\sales@updateLocalSale');
Route::get('/fetch-party', 'App\Http\Controllers\sales@fetchparty');
Route::get('/calcu', 'App\Http\Controllers\sales@calcu');
Route::get('/add_localsales', 'App\Http\Controllers\sales@add_localsales');
Route::get('/calcus', 'App\Http\Controllers\availbilitysales@calcus');
// Route::get('/date-vise-sale', 'App\Http\Controllers\sales@datesale');
Route::get('/date-vise-sale', 'App\Http\Controllers\sales@fetchwholesaledatewise');
Route::get('/date-vise-localsale', 'App\Http\Controllers\sales@fetchlocalsaledatewise');
Route::get('/date-vise-localsale-summary', 'App\Http\Controllers\sales@fetchlocalsalesummary');
Route::get('/wholesalesdetailsViseSummary', function () { return view('wholesalesdetailsViseSummary');});
Route::get('/product-vise-sale-view', 'App\Http\Controllers\sales@datesaleview');
Route::get('/product-vise-purchase-view', 'App\Http\Controllers\purchases@datesaleview');
Route::get('/salemansales', 'App\Http\Controllers\sales@salemansales');
//sales invoic
Route::resource('sales1', 'App\Http\Controllers\sales1');
Route::get('/autocomplete-search1', 'App\Http\Controllers\sales1@autocompleteSearch');
Route::get('/salesbillprint11', 'App\Http\Controllers\sales1@fetchstudentprint');
Route::get('/salesbillprint1urdu', 'App\Http\Controllers\sales1@fetchstudentprinturdu');
Route::get('/autosale-customer1', 'App\Http\Controllers\sales1@autopurchasecustomer');
Route::get('/delete1', 'App\Http\Controllers\sales1@delete');
Route::get('/final-bill1', 'App\Http\Controllers\sales1@finalBill');
Route::get('/fetch-stock1', 'App\Http\Controllers\sales1@fetchrate');
Route::get('/fetch-student1', 'App\Http\Controllers\sales1@fetchstudent');
Route::get('/fetch-party1', 'App\Http\Controllers\sales1@fetchparty');
Route::get('/calcu1', 'App\Http\Controllers\sales1@calcu');
Route::get('/date-vise-sale1', 'App\Http\Controllers\sales1@datesale');
Route::get('/salemansales1', 'App\Http\Controllers\sales1@salemansales');
//salemansales
//sales return
Route::resource('salesreturn', 'App\Http\Controllers\salesreturns');
Route::get('/deletesalesretuns', 'App\Http\Controllers\salesreturns@delete');
Route::get('/final-bill-sreturn', 'App\Http\Controllers\salesreturns@finalBill');
Route::get('/fetch-salesreturn', 'App\Http\Controllers\salesreturns@fetchstudent');
Route::get('/calcu-sales-return', 'App\Http\Controllers\salesreturns@calcu');