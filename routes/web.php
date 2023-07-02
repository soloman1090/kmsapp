<?php

use Illuminate\Support\Facades\Route;
use Admin\UserController;
use Admin\DashboardController;
use Admin\PaymentsController;
use Admin\PaymentsMethodController;
use Admin\PaymentsHistoryController;
use Admin\WithdrawalController;
use Admin\WithdrawalHistoryController;
use Admin\WithdrawalMethodController;
use Admin\UserInvestmentsController;
use Admin\InvestPackagesController;
use Admin\UserBondController;
use Admin\BondPackagesController;
use Admin\TraderController;
use Admin\MessagesController;
use Admin\ActivitiesController;
use Admin\SendMailController;
use Admin\ReinvestmentController;
use Admin\PopupController;
use Admin\MigrationController;
use Admin\VoyagerController;
use Admin\SurveyController;
use Admin\InvestmentSummaryController;
use User\UserDashboard;
use User\Profile;
use User\Kyc;
use User\EditPassword;
use User\Activity;
use User\ViewPortfolios;
use User\UsersInvestmentsView;
use User\WithdrawalRequest;
use User\WithdrawalHistory;
use User\InvestmentsHistory;
use User\TwoFactor;
use User\Message;
use User\ReferredUsers;
use User\ReferralBonus;
use User\UserPayment;
use User\ConfirmPayment;
use User\Transfer;
use User\Affiliate;
use User\InvestCalculator;
use User\ReinvestContoller;
use User\ValuePods; 
use User\MakeInvestment;
use User\Account;
use User\Contact;
use User\News;
use User\Howto;
use User\Fq;
use User\Video;
use User\Pdf;
use HomeController as Home;
use CompoundInterest as Compound;
use CreateActivities as Activities;
use ActivatePortfolios as ActivatePortfolios;
use AutoSendMails as AutoSendMails; 
use ExportUsers as ExportUsers;
use AddBonus as AddBonus;
use ActivateReinvestments as ActivateReinvestments;
use ReloadWallets as ReloadWallets;
use LoadInvestments as LoadInvestments;
use CompoundVoyage as CompoundVoyage;
use App\Mail\UserRegisteredMail;
use App\Mail\CustomMail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
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

Route::resource('/', Home::class);
Route::resource('/home', Home::class);

Route::get('/account-approval', function () {
    return view('auth.account-approval');
});
Route::get('/account-suspended', function () {
    return view('auth.account-suspend');
});

Route::get('/diversity-and-inclusion', function () {
    return view('diversity-and-inclusion');
});

Route::get('/email', function () {
    return new UserRegisteredMail([
        'title' => 'Please Verify your email address',
        'url' => 'https://www.itsolutionstuff.com',
        'subject'=>'Welcome to Dell Group  Management!',
        'descp' => 'In order to transact on your behalf, we need to verify a way of communicating with you. To verify your email address with us, please click the following secure link:',
        'action-text'=>'Verify Now',
        'img'=>'assets/images/emails/verification-banner.jpg'
    ]);
});

Route::get('/email-chritmas', function () {
    return new CustomMail([
        'title' => 'Dear partners,',
        'url' => 'https://Dell Group.com/',
        'subject'=>'Merry Christmas',
        'user'=>'James Kala',
        'descp' => "As we reflect on another blissful year of business, we would like to thank you for being a part of our vision. We truly appreciate you, your trust, and your committment to helping us build a sustainable economy together! ",
        'action-text'=>'',
        'descp2' =>"We look forward to assisting you in the future,",
        'descp3' =>" Sending warm wishes and goodwill from our team to yours.",
        'img'=>'assets/images/emails/verification-banner.jpg',
        'img-event'=>'1640593135event.jpg',
        'end_text'=>'Merry Christmas!🎄'
    ]);
});

Route::get('/esg', function () {
    return view('esg');
});
Route::get('/responsible-investing', function () {
    return view('responsible-investing');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/blog', function () {
    return view('blog');
});
Route::get('/credit', function () {
    return view('credit');
});
Route::get('/unique-process', function () {
    return view('unique-process');
});
Route::get('/infrastructure', function () {
    return view('infrastructure');
});
Route::get('/overview', function () {
    return view('overview');
});


Route::get('/multi-asset-solution', function () {
    return view('multi-asset-solution');
});

Route::get('/insurance-solutions', function () {
    return view('insurance');
});

Route::get('/support', function () {
    return view('support');
});

Route::get('/private-equity', function () {
    return view('private');
});

Route::get('/real-estate', function () {
    return view('real-estate');
});

Route::get('/renewable-power', function () {
    return view('renewable');
});

Route::get('/leadership', function () {
    return view('leadership');
});

Route::get('/privacy-policy', function () {
    return view('privacy');
});
//User Registration Routes
Route::get('register/user-email', function () {
    return view('auth.user.user-email');
});
Route::get('register/user-password', function () {
    return view('auth.user.user-password');
});
Route::get('register/user-names', function () {
    return view('auth.user.user-names');
});
Route::get('register/user-phone', function () {
    return view('auth.user.user-phone');
});
Route::get('register/user-agreement', function () {
    return view('auth.user.user-agreement');
});

// Business Registration Routes
Route::get('register/business-name', function () {
    return view('auth.business.b-name');
});
Route::get('register/business-location', function () {
    return view('auth.business.b-location');
});
Route::get('register/business-email', function () {
    return view('auth.business.b-email');
});
Route::get('register/business-reg-no', function () {
    return view('auth.business.b-reg-no');
});
Route::get('register/business-phone', function () {
    return view('auth.business.b-phone');
});
Route::get('register/business-password', function () {
    return view('auth.business.b-password');
});
Route::get('register/business-upload', function () {
    return view('auth.business.b-upload');
});


Route::resource('/compound-interest', Compound::class);
Route::resource('/create-activities', Activities::class);
Route::resource('/payment', UserPayment::class);
Route::resource('/activate-portfolio', ActivatePortfolios::class);
Route::resource('/activate-reinvestment', ActivateReinvestments::class);
Route::resource('/auto-send-mails', AutoSendMails::class);
Route::resource('/export-users', ExportUsers::class);
Route::resource('/add-bonus', AddBonus::class);
Route::resource('/reload-wallets', ReloadWallets::class);
Route::resource('/load-investments', LoadInvestments::class);
Route::resource('/compound-voyage', CompoundVoyage::class);
//User Routes
//WE ARE HERE
Route::prefix('user')->middleware(['auth', 'verified','approved'])->name('user.')->group(function (){
    Route::resource('/dashboard', UserDashboard::class);
    Route::resource('/profile', Profile::class);
    Route::resource('/kyc', Kyc::class);
    Route::resource('/message', Message::class);
    Route::resource('/two-factor', TwoFactor::class);
    Route::resource('/change-password', EditPassword::class);
    Route::resource('/activity', Activity::class);
    Route::resource('/voyager-program', Affiliate::class);
    Route::resource('/referred-users', ReferredUsers::class);
    Route::resource('/referral-bonus', ReferralBonus::class);
    Route::resource('/view-investments-portfolio', ViewPortfolios::class);
    Route::resource('/user-investments', UsersInvestmentsView::class);
    Route::resource('/withdrawal-request', WithdrawalRequest::class);
    Route::resource('/withdrawal-history', WithdrawalHistory::class);
    Route::resource('/investment-history', InvestmentsHistory::class);
    Route::resource('/get-payment', UserPayment::class);
    Route::resource('/confirm-payment', ConfirmPayment::class);
    Route::resource('/reinvest', ReinvestContoller::class);
    Route::resource('/investment-calculator', InvestCalculator::class);
    Route::resource('/transfer', Transfer::class);
    Route::resource('/value-pods', ValuePods::class);
    Route::resource('/make-investment', MakeInvestment::class);
    Route::resource('/my-account', Account::class);
    Route::resource('/contact', Contact::class);
    Route::resource('/howto', Howto::class);
    Route::resource('/news', News::class);
    Route::resource('/pdf', Pdf::class);
    Route::resource('/video', Video::class);
    Route::resource('/fq', Fq::class);
});
//Admin Routes
Route::prefix('admin')->middleware(['auth', 'auth.isAdmin'])->name('admin.')->group(function (){
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/activities', ActivitiesController::class);
    Route::resource('/messsages', MessagesController::class);
    Route::resource('/payments', PaymentsController::class);
    Route::resource('/payment-methods', PaymentsMethodController::class);
    Route::resource('/payment-history', PaymentsHistoryController::class);
    Route::resource('/withdrawal-request', WithdrawalController::class);
    Route::resource('/withdrawal-history', WithdrawalHistoryController::class);
    Route::resource('/withdrawal-method', WithdrawalMethodController::class);
    Route::resource('/users-investments', UserInvestmentsController::class);
    Route::resource('/investment-packages', InvestPackagesController::class);
    Route::resource('/users-bond', UserBondController::class);
    Route::resource('/bond-packages', BondPackagesController::class);
    Route::resource('/traders', TraderController::class); 
    Route::resource('/sendmail', SendMailController::class);
    Route::resource('/reinvestments', ReinvestmentController::class);
    Route::resource('/popups', PopupController::class);
    Route::resource('/voyagers', VoyagerController::class);
    Route::resource('/surveys', SurveyController::class);
    Route::resource('/investment-summary', InvestmentSummaryController::class);
    Route::resource('/user-data-migration', MigrationController::class);
    Route::get('/impersonate/user/{id}', 'Admin\ImpersonateController@index')->name('impersonate');
});

Route::get('/admin/impersonate/destroy', 'Admin\ImpersonateController@destroy')->name('admin.impersonate.destroy');


Route::get('generate-sitemap', function(){
    // create new sitemap object
    $sitemap = App::make("sitemap");


    // add items to the sitemap (url, date, priority, freq)
    $sitemap->add(URL::to('home'), '2012-08-25T20:10:00+02:00', '1.0', 'daily');
    $sitemap->add(URL::to('investment'), '2012-08-25T20:10:00+02:00', '0.9', 'daily');
    $sitemap->add(URL::to('responsible-investing'), '2012-08-25T20:10:00+02:00', '0.5', 'daily');
    $sitemap->add(URL::to('esg'), '2012-08-25T20:10:00+02:00', '0.9', 'daily');
    $sitemap->add(URL::to('diversity-and-inclusion'), '2012-08-25T20:10:00+02:00', '0.5', 'daily');
    $sitemap->add(URL::to('private-equity'), '2012-08-25T20:10:00+02:00', '0.5', 'daily');
    $sitemap->add(URL::to('sustainability'), '2012-08-25T20:10:00+02:00', '0.5', 'daily');
    $sitemap->add(URL::to('overview'), '2012-08-25T20:10:00+02:00', '0.8', 'daily');
    $sitemap->add(URL::to('real-estate'), '2012-08-25T20:10:00+02:00', '0.8', 'daily');
    $sitemap->add(URL::to('insurance-solutions'), '2012-08-25T20:10:00+02:00', '0.5', 'daily');
    $sitemap->add(URL::to('renewable-power'), '2012-08-25T20:10:00+02:00', '0.5', 'daily');
    $sitemap->add(URL::to('infrastructure'), '2012-08-25T20:10:00+02:00', '0.5', 'daily');
    $sitemap->add(URL::to('corporate-governance'), '2012-08-25T20:10:00+02:00', '0.5', 'daily');
    $sitemap->add(URL::to('contact'), '2012-08-25T20:10:00+02:00', '1.0', 'daily');


    // generate your sitemap (format, filename)
    $sitemap->store('xml', 'sitemap');
    // this will generate file mysitemap.xml to your public folder
   return  redirect(url('sitemap.xml'));

});
