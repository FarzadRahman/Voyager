<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
class OrderController extends Controller
{
    public function getAllData(Request $r){
//        $jobs=Job::select('job.jobId','job.created_at','job.deadLine','job.deliveryDate','job.submissionTime','job.quantity','user.name','file.folderName','client.clientName','status.statusName','rate.amount')
//            ->leftJoin('file','file.jobId','job.JobId')
//            ->leftJoin('client','client.clientId','job.clientId')
//            ->leftJoin('status','status.statusId','job.statusId')
//            ->leftJoin('user','user.userId','job.doneBy')
//            ->leftJoin('rate','rate.jobId','job.jobId')
//            ->orderBy('job.created_at','desc')
//        ;
//        if($r->statusId){
//            $jobs=$jobs->where('status.statusId',$r->statusId);
//        }
//        if($r->date){
//            $jobs=$jobs->where(DB::raw('date(job.created_at)'),$r->date);
//        }
//        if($r->clientId){
//            $jobs=$jobs->where('client.clientId',$r->clientId);
//        }
//        $jobs=$jobs->get();
        $orders=Order::select('order.*','users.name')
            ->leftJoin('users','users.id','order.customerId')
            ->orderBy('order.id','desc');
        if($r->status){
            $orders=$orders->where('order.status',$r->status);
        }

        $orders=$orders->get();


        $datatables = Datatables::of($orders);
        return $datatables->make(true);
    }

    public function index(){
        return view('order.index');
    }
}
