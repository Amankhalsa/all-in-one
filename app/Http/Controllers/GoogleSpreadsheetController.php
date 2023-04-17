<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sheets;
use App\Exports\studenxport;
use App\Imports\UsersImport;
use App\Models\student;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class GoogleSpreadsheetController extends Controller


{



    protected $paginationTheme = 'bootstrap';

    // method refrance link
    // https://drivemarketing.ca/en/blog/connecting-laravel-to-a-google-sheet/

        public function index()
    {
        $sheets = Sheets::spreadsheet('16fy1ZqzuBZzmX4Jw9dvyphC7YlS3RgUWGEffq2iL3i4')
        ->sheet('demo1')->get();
     
        $header = $sheets->pull(0);
        $posts = Sheets::collection($header, $sheets);

        $posts = $posts->take(5000);
        
        $data = $posts->toArray();
        // echo "<pre>";
        // end($data);
        // $key_set = key($data);
        // echo  $key_set+1;
        //  die();
        if ($data) {
            // foreach ($data as $key => $value) {
                // info($value);
                  return view('table' ,compact('posts'));
            // }
        }else{
            info('data not found');
        }

  
 }



   public function createdata()
   {
       /** generate sheet name **/
       /** generate sheet name **/
       $sheetName = sprintf('%s-Test', time());
       /** prepare the data in array **/
       /** prepare the data in array **/
       $data = [
     
           [
               'U001',
               'John',
           ],
           [
               'U002',
               'Harry',
           ],
       ];

       /** generate a new sheet in a specific spread sheet **/
       Sheets::spreadsheet('16fy1ZqzuBZzmX4Jw9dvyphC7YlS3RgUWGEffq2iL3i4')->sheet('demo1')->append($data);

       /** write the data in the newly generated sheet **/
    //    Sheets::sheet('demo1')->append($data);


}

        public function insert_to_sheet(){

            return view('excelimport');
        
            }
            public function insertIntoIheet(Request $request){
              $validRecord =  $request->validate([
                    'name' =>'required',
                ]);
                if($validRecord ){
                    $sheets = Sheets::spreadsheet('16fy1ZqzuBZzmX4Jw9dvyphC7YlS3RgUWGEffq2iL3i4')->sheet('demo1')->get();
                    $header = $sheets->pull(0);
                    $posts = Sheets::collection($header, $sheets);
                    $posts = $posts->take(5000);
                    $data = $posts->toArray();
                
                    end($data);
                    $key_set = key($data);
                    $last_num = $key_set+1;
                    
                }

                $current_date = date('Y-m-d H:i:s');
                $data = [
                    [$last_num, $request->name, $current_date]
                 ];
            
               Sheets::spreadsheet('16fy1ZqzuBZzmX4Jw9dvyphC7YlS3RgUWGEffq2iL3i4')->sheet('demo1')->append($data);
               
                    return redirect()->route('sheetView');
                

            }


            public function delete_sheet_row(){
             $getdata =   Sheets::spreadsheet('16fy1ZqzuBZzmX4Jw9dvyphC7YlS3RgUWGEffq2iL3i4')->sheet('demo1')->range('')->all();
               dd( $getdata);
            }


            public function show_form(){
                $data['exceldata'] = student::paginate(5);
                    return view('excel.index',$data);
            }


            public function uploadUsers(Request $request)
                {
                    
                    Excel::import(new UsersImport, $request->file);
                    Session::flash('alert-class', 'alert-success'); 
                    return redirect()->route('get_form')->with('success', 'User Imported Successfully');
                }

    public function exportstudent() 
    {

       return Excel::download(new studenxport, 'users.xlsx');
    }
    public function delete_Sudent($id){
        student::find($id)->delete();

            Session::flash('alert-class', 'alert-danger'); 
        return redirect()->route('get_form')->with('success', 'User Deleted Successfully');

    }

    public function delete_all_student(Request $request ){
        
        $ids = $request->get('ids');
  if(isset($ids)){
        foreach($ids as $val){
            DB::table('students')->where('id', $val)->delete();
        }
        Session::flash('alert-class', 'alert-danger'); 
        return redirect()->back()->with('success' ,'Data deleted success');
    }else {
        Session::flash('alert-class', 'alert-danger'); 
        return redirect()->back()->with('success' ,'Please select data');
    }
    }
}