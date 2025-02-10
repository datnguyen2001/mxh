<?php
namespace App\Helpers;
use App\Helpers\LoggerHelpers;
use Illuminate\Support\Facades\DB;


class SqlsrvDataHelper
{
    //Get data to stored Procedures
    public function __construct()
    {
        $this->client= DB::connection();
    }

    public  function getBodyContent($newsId){

        $data=$this->client->select("exec FE_NewsContent_GetByNewsID ".$newsId."");
        return $data;
    }

    #region Van ban quan ly
    public function GetVanBanList(int $from,int $to,int $nhom=0,int $coquan=0,int $theloai=0,int $linhvuc=0,int $year=0,$search=""){
        try {
            $data=$this->client->select("exec WS_VanBanList ?,?,?,?,?,?,?,?",[$from,$to,$nhom,$coquan,$theloai,$linhvuc,$year,$search]);

        }catch (\Throwable $th){
            LoggerHelpers::CallApiSetLog('Exception=[' . $th->getMessage() . ']' , 'ExceptionSqlsrv');
        }
        return $data??[];
    }

    public function GetVanBanCoQuan(){
        try {
            $data=$this->client->select("exec WS_VanBanCoQuan");
        }catch (\Throwable $th){
            LoggerHelpers::CallApiSetLog('Exception=[' . $th->getMessage() . ']' , 'ExceptionSqlsrv');
        }
        return $data??[];
    }

    public function GetVanBanLinhVuc(){
        try {
            $data=$this->client->select("exec WS_VanBanLinhVuc");
        }catch (\Throwable $th){
            LoggerHelpers::CallApiSetLog('Exception=[' . $th->getMessage() . ']' , 'ExceptionSqlsrv');
        }

        return $data??[];
    }

    public function GetVanBanNhom(){
        try {
            $data=$this->client->select("exec WS_VanBanNhom");
        }catch (\Throwable $th){
            LoggerHelpers::CallApiSetLog('Exception=[' . $th->getMessage() . ']' , 'ExceptionSqlsrv');
        }
        return $data??[];
    }

    public function GetVanBanTheLoai(){

        try {
            $data=$this->client->select("exec WS_VanBanTheLoai");
        }catch (\Throwable $th){
            LoggerHelpers::CallApiSetLog('Exception=[' . $th->getMessage() . ']' , 'ExceptionSqlsrv');
        }
        return $data??[];
    }
    public function GetVanBanDetail($id){
        try {
            $data=$this->client->select("exec WS_VanBanDetail ".$id."");
        }catch (\Throwable $th){
            LoggerHelpers::CallApiSetLog('Exception=[' . $th->getMessage() . ']' , 'ExceptionSqlsrv');
        }
        return $data??[];
    }
    #region Thu tuc hanh chinh

    public function GetThuTucList(int $from,int $to,int $cap=0,int $nhom=null,int $coquan=0,int $linhvuc=0,$search=""){
        try {
            $data=$this->client->select("exec WS_ThuTucList ?,?,?,?,?,?,?",[$from,$to,$cap,$nhom,$coquan,$linhvuc,$search]);
        }catch (\Throwable $th){
            LoggerHelpers::CallApiSetLog('Exception=[' . $th->getMessage() . ']' , 'ExceptionSqlsrv');
        }
        return $data??[];
    }
    public function GetThuTucCoQuan($cap=0){
        try {
            $data=$this->client->select("exec WS_ThuTucCoQuan ".$cap."");
        }catch (\Throwable $th){
            LoggerHelpers::CallApiSetLog('Exception=[' . $th->getMessage() . ']' , 'ExceptionSqlsrv');
        }

        return $data??[];
    }
    public function GetThuTucLinhVuc(){
        try {
            $data=$this->client->select("exec WS_ThuTucLinhVuc");

        }catch (\Throwable $th){
            LoggerHelpers::CallApiSetLog('Exception=[' . $th->getMessage() . ']' , 'ExceptionSqlsrv');
        }
        return $data??[];
    }
    public function GetThuTucNhom(){
        try {
            $data=$this->client->select("exec WS_ThuTucNhom");

        }catch (\Throwable $th){
            LoggerHelpers::CallApiSetLog('Exception=[' . $th->getMessage() . ']' , 'ExceptionSqlsrv');
        }
        return $data??[];
    }
    public function GetThuTucCap(){
        try {
            $data=$this->client->select("exec WS_ThuTucCap");
        }catch (\Throwable $th){
            LoggerHelpers::CallApiSetLog('Exception=[' . $th->getMessage() . ']' , 'ExceptionSqlsrv');
        }
        return $data??[];
    }
    public function GetThuTucDetail($id){
        try {
            $data=$this->client->select("exec WS_ThuTucDetail ".$id."");

        }catch (\Throwable $th){
            LoggerHelpers::CallApiSetLog('Exception=[' . $th->getMessage() . ']' , 'ExceptionSqlsrv');
        }
        return $data??[];
    }

    public function GetListQA($siteid,$status,$newsid,$from,$to){
        try {
            $data=$this->client->select("exec FE_ManhLV_QuickAnswer_List ".$siteid.",".$status.",".$newsid.",".$from.",".$to."");

        }catch (\Throwable $th){
            LoggerHelpers::CallApiSetLog('Exception=[' . $th->getMessage() . ']' , 'ExceptionSqlsrv');
        }
        return $data??[];
    }

    public function QuickAnswerInsert($siteid,$name,$address,$email,$phone,$title,$file,$status,$date,$content,$newsid){
        try {
            $data=$this->client->select("exec FE_ManhLV_QuickAnswer_Add ".$siteid.",".$name.",".$address.",".$email.",".$phone.",".$title.",".$file.",".$status.",".$date.",".$content.",".$newsid."");

        }catch (\Throwable $th){
            LoggerHelpers::CallApiSetLog('Exception=[' . $th->getMessage() . ']' , 'ExceptionSqlsrv');
        }
        return $data??[];
    }

}
