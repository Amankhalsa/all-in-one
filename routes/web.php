<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\GoogleController;
use Illuminate\Http\Request;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\GoogleSpreadsheetController;
use App\Http\Controllers\ChatGptController;




use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
// */
// https://www.itsolutionstuff.com/post/laravel-57-comment-system-tutorial-from-scratchexample.html

        Route::get('/', function () {return view('welcome'); })->name('homepage');
        // Route::get('/',[MenuController::class,'welcomepage'])->name('homepage');

        Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
                
        Route::get('/dashboard', function () { 

            
          return view('dashboard');
        })->name('dashboard');
        Route::get('menu/index',[MenuController::class,'index'])->name('menusort');
        Route::post('menu/update-order',[MenuController::class,'updateOrder']);
        Route::post('post-sortable',[PostController::class,'update']);
        Route::get('post',[PostController::class,'index'])->name('rowsort');
        Route::get('show-post/{id}',[PostController::class,'show_post'])->name('posts.show');
        Route::post('comment-post/{id}',[CommentController::class,'comments_store'])->name('store_comments');
        
        Route::DELETE('all-delete',[PostController::class,'allDelete'])->name('all.delete');
 
        // Route::resource('/userData',[UserDataController::class]);
        Route::get('/userData',[UserDataController::class,'index'])->name('adduser');
        Route::Delete('/userData/{id}',[UserDataController::class,'delete']);
        Route::post('/storedata',[UserDataController::class,'store']);
        Route::post('/userData/getUserData',[UserDataController::class,'getUserData']);
        // https://www.studentstutorial.com/laravel/laravel-ajax-retrieve
        Route::apiResource('blogposts', BlogController::class);
        
        Route::get('/generate-pdf', [PDFController::class, 'generatePDF'])->name('generate_PDF');
        Route::get('/Invoice-pdf', [PDFController::class, 'Invoice'])->name('Invoice_PDF');
        Route::get('/genrate_pdf', [PDFController::class, 'resume'])->name('resume_PDF');
        
        // manage calendar 
        Route::get('/getevent', [FullCalendarController::class,'getevent'])->name('getevent');
        Route::post('/createevent', [FullCalendarController::class,'createEvent'])->name('creatent');
        Route::post('/deleteevent', [FullCalendarController::class,'deleteEvent'])->name('delevent');

        Route::get('google-spreadsheet-api', [GoogleSpreadsheetController::class, 'index'])->name('sheetView');
        Route::get('add-data', [GoogleSpreadsheetController::class, 'insert_to_sheet'])->name('insertToSheet');
       
        // insert_into_sheet
        Route::post('insert-into-sheet', [GoogleSpreadsheetController::class, 'insertIntoIheet'])->name('insert_into_sheet');
        
        // delete row
        Route::get('delete-sheet-row/', [GoogleSpreadsheetController::class, 'delete_sheet_row'])->name('delete_row');
        Route::get('createdata', [GoogleSpreadsheetController::class, 'createdata'])->name('createData');

        //Chat GPT
          Route::get('chat-now', [ChatGptController::class, 'showpage'])->name('namemypet');
          Route::post('Answer-is', [ChatGptController::class, 'ask'])->name('chatgpt.ask');

        });

        Route::prefix('google')->name('google.')->group( function(){
          Route::get('login', [GoogleController::class, 'loginWithGoogle'])->name('login');
          Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
        });



Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::get('get-excel-form', [GoogleSpreadsheetController::class, 'show_form'])->name('get_form');

Route::post('user-into-sheet', [GoogleSpreadsheetController::class, 'uploadUsers'])->name('import_data');

Route::get('student-export', [GoogleSpreadsheetController::class, 'exportstudent'])->name('exportstudent');
Route::get('student-delete/{id}', [GoogleSpreadsheetController::class, 'delete_Sudent'])->name('deleteSudent');


Route::post('delete-all-student',[GoogleSpreadsheetController::class,'delete_all_student'])->name('deleteAllStudent');







