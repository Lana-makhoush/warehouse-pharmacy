<?php

namespace App\Http\Controllers;

use App\Http\Requests\medicine;
use App\Http\Requests\talabrequest;
use App\Models\acategory;
use App\Models\bpharmacist;
use App\Models\category;
use App\Models\cwarehouse;
use App\Models\dorder;
use App\Models\fmedicine;
use App\Models\jinvoice;
use App\Models\med;
use App\Models\talabati;
use App\Models\User;
use App\Models\warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;


class ownerController extends Controller
{
    ///
    public function addmedicine(medicine $request){
        $request->validate([
            'scientific_name' => 'required',
            'commercial_name' => 'required',
            'category' => 'required',
            'warehouse' => 'required',
            'manufacture_company' => 'required',
            'available_quantity' => 'required',
            'expiry_date' => 'required',
            'price' => 'required',
            'image' => 'required|image',
        ]);

        $medicine = new fmedicine();
        $medicine->scientific_name = $request->scientific_name;
        $medicine->commercial_name = $request->commercial_name;
        $medicine->category = $request->category;
        $medicine->manufacture_company = $request->manufacture_company;
        $medicine->available_quantity=$request->available_quantity;
        $medicine->expiry_date=$request->expiry_date;
        $medicine->price=$request->price;
        $medicine->image=$request->image;
        $medicine->warehouse = $request->warehouse;
        $image=$request->file('image');
        $medicineimage=null;
        if ($request->hasFile('image')) {

            $medicineimage=time() . '.' .$image->getClientOriginalExtension();
            $image->move(public_path('images'),$medicineimage);
            $medicineimage='images/'.$medicineimage;
        }
        $medicine->image =$medicineimage;
        $medicine->save();
       return response()->json([

           'data'=>$medicine,
         //  URL::to($url),
           'message' => 'Medicine added successfully'], 200);}


    public function searchmed(Request $request){
        if($request->commercial_name==null){
            return response()->json([
                'status' => 400,
                'message' => 'invalid information',
            ],status: 400);

        }
        $searchmed=fmedicine::where('commercial_name',"=",$request->commercial_name)->first();
        if($searchmed) {
            $data= $searchmed;
            return response()->json(

                 $data,

            );
        }
        $data =[];
        return response()->json([
            'status' => 404,
            'data' => $data,
            'message' => 'not found',
        ],status: 404);
    }
    public function details($id){
        $details=fmedicine::where('id',"=",$id)->get();
        return response()->json([
            'status'=>200,
            'data'=>$details,
        'message'=>'The data was returned successfully'
        ]);
    }
    public function getcatogery(){
        $c=acategory::all();
        return response()->json(

            $c,
        );
    }
    public function addtalabia(talabrequest $request) {
        $order = new dorder();
        $errors = [];
        // $user=new User();
        // $user_id=User::where('id',$request->user_id)->first();
        $order->user_id=$request->user_id;
        if(!empty($request->first_med)) {
            $s1 = fmedicine::where('commercial_name', $request->first_med)->first();
            if(!$s1) {
                $errors[] = "First medicine not found";
            } else if($s1->available_quantity < $request->quantity1) {
                $errors[] = "unavailable quantity of first medicine";
            } else {
                $s1->available_quantity -= $request->quantity1;
                $s1->save();

                $order->first_med = $request->first_med;
                $order->quantity1 = $request->quantity1;
                $order->price1 = $s1->price * $request->quantity1;
            }
        }


        if(!empty($request->second_med)) {
            $s2 = fmedicine::where('commercial_name', $request->second_med)->first();
            if(!$s2) {
                $errors[] = "Second medicine not found";
            } else if($s2->available_quantity < $request->quantity2) {
                $errors[] = "unavailable quantity of second medicine";
            } else {
                $s2->available_quantity -= $request->quantity2;
                $s2->save();

                $order->second_med = $request->second_med;
                $order->quantity2 = $request->quantity2;
                $order->price2 = $s2->price * $request->quantity2;
            }
        }


        if(!empty($request->third_med)) {
            $s3 = fmedicine::where('commercial_name', $request->third_med)->first();
            if(!$s3) {
                $errors[] = "Third medicine not found";
            } else if($s3->available_quantity < $request->quantity3) {
                $errors[] = "unavailable quantity of third medicine";
            } else {
                $s3->available_quantity -= $request->quantity3;
                $s3->save();

                $order->third_med = $request->third_med;
                $order->quantity3 = $request->quantity3;
                $order->price3 = $s3->price * $request->quantity3;
            }
        }


        if(!empty($request->fourth_med)) {
            $s4 = fmedicine::where('commercial_name', $request->fourth_med)->first();
            if(!$s4) {
                $errors[] = "Fourth medicine not found";
            } else if($s4->available_quantity < $request->quantity4) {
                $errors[] = "unavailable quantity of fourth medicine";
            } else {
                $s4->available_quantity -= $request->quantity4;
                $s4->save();

                $order->fourth_med = $request->fourth_med;
                $order->quantity4 = $request->quantity4;
                $order->price4 = $s4->price * $request->quantity4;
            }
        }


        if(!empty($request->fifth_med)) {
            $s5 = fmedicine::where('commercial_name', $request->fifth_med)->first();
            if(!$s5) {
                $errors[] = "Fifth medicine not found";
            } else if($s5->available_quantity < $request->quantity5) {
                $errors[] = "unavailable quantity of fifth medicine";
            } else {
                $s5->available_quantity -= $request->quantity5;
                $s5->save();

                $order->fifth_med = $request->fifth_med;
                $order->quantity5 = $request->quantity5;
                $order->price5 = $s5->price * $request->quantity5;
            }
        }


        if(!empty($errors)) {
            return response()->json([
                'status' => 400,
                'message' => 'Errors occurred',
                'errors' => $errors,
            ],status: 400);
        }
        $totalPrice = $order->price1 + $order->price2 + $order->price3 + $order->price4 + $order->price5;
        $order->total_price=$totalPrice;
        //$order->order_satatus = 'in_preparation';
       // $order->payment_status=$request->payment_status;
        $order->save();



        return response()->json([
            'status' => 200,
            'message' => 'talabia added successfully',
            'order' => $order,

        ],status: 200);
    }

public function getinvoice($id){
        $x=0;
        $totalprice=0;
        $order=dorder::find($id);
    $invoiceid = jinvoice::find($id);
        $invoice= new jinvoice();
    $invoice->number_of_units=0;
        $invoice->payment_status=$order->payment_status;
        $invoice->invoice_date=date('Y_m_d');
        if(!empty($order->first_med)) {
            $x += 1;
            $totalprice+=$order->price1;
        }
    if(!empty($order->second_med))
    {  $x+=1;
        $totalprice+=$order->price2;
    }
    if(!empty($order->third_med)) {
        $x += 1;
        $totalprice+=$order->price3;
    }
    if(!empty($order->fourth_med))
    { $x+=1;
        $totalprice+=$order->price4;
    }
    if(!empty($order->fifth_med)) {
        $x += 1;
        $totalprice+=$order->price5;
    }$invoice->number_of_units=$x;
    $invoice->total_price=$totalprice;
    $invoice->cwarehouse=1;
    $invoice->dorder=$id;
    $invoice->save();
    return response()->json([
        'status'=>1,
        'invoice_information'=>$invoice,
        'orders'=>$order,
        'massage'=>'you are invoice'
    ]);
}
    public function getreport($month){
        $invoice=jinvoice::whereMonth('invoice_date',"=",$month)->get();
        return response()->json([
            'status'=>1,
            'data'=>$invoice,
            'masseage'=>'you are report for month '.$month,
        ]);

    }
    public function getmedicineFromOneCategory($idCategory){
        $med=fmedicine::where('category',$idCategory)->get();

        return response()->json(
            $med

        );
    }
    public function updateOrderStatus(Request $request)
    {
        // التحقق مما إذا كان المستخدم موجود.
        $user = User::find($request->user_id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // التحقق مما إذا كانت الطلبية موجودة.
        $order = dorder::find($request->order_id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // التحقق من أن الحالة المدخلة صحيحة.
        $validStatuses = ['in_preparation', 'has been sent', 'receives'];
        if (!in_array($request->order_satatus, $validStatuses)) {
            return response()->json(['message' => 'Invalid order status'], 400);
        }

        // إذا كانت الحالة تم الارسال، قم بطرح الكمية المطلوبة من الكمية المخزنة وحذف الدواء إذا أصبحت الكمية = 0
        if ($request->order_satatus === 'has been sent') {
            $medications = [
                ['name' => $order->first_med, 'quantity' => $order->quantity1],
                ['name' => $order->second_med, 'quantity' => $order->quantity2],
                ['name' => $order->third_med, 'quantity' => $order->quantity3],
                ['name' => $order->fourth_med, 'quantity' => $order->quantity4],
                ['name' => $order->fifth_med, 'quantity' => $order->quantity5]
            ];

            foreach ($medications as $medication) {
                if ($medication['name']) {
                    $med = fmedicine::where('commercial_name', $medication['name'])->first();
                    if ($med) {
                        // حساب الكمية المتبقية
                        $newQuantity = max($med->available_quantity - (int)$medication['quantity'], 0);

                        // حفظ الكمية المتبقية في جدول الأدوية
                        if ($newQuantity === 0) {
                            // حذف الدواء إذا أصبحت الكمية = 0
                            fmedicine::where('id', '=', $med->id)->delete();
                        } else {
                            // تحديث كمية المخزون في جدول الأدوية
                            fmedicine::where('id', '=', $med->id)->update(['available_quantity' => (int)$newQuantity]);
                        }
                    } else {
                        return response()->json(['message' => 'Medication not found'], 404);
                    }
                }
            }
        }

        // تحديث حالة الطلبية وحفظها في جدول الطلبات.
        $order->order_satatus = $request->order_satatus;
        $order->save();

        return response()->json([
            'message'=>$request->order_satatus], 200);
    }

    public function updatePaymentStatus(Request $request)
    {
        // التحقق من وجود المستخدم
        $user = User::find($request->user_id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // التحقق من وجود الطلبية
        $order = dorder::where('id', $request->order_id)->where('user_id', $request->user_id)->first();
        if (!$order) {
            return response()->json(['message' => 'Order not found for the user'], 404);
        }

        // التحقق من صحة حالة الدفع
        if ($request->payment_status != 'paid' && $request->payment_status != 'unpaid') {
            return response()->json(['message' => 'Invalid payment status'], 400);
        }

        // تحديث حالة الدفع في جدول الطلبيات
        $order->payment_status = $request->payment_status;
        $order->save();

        return response()->json(
            ['message'=> $request->payment_status
            ], 200);
    }

    public function getOrderwarehouse(){
        $order=dorder::all();
        return response()->json(
            $order
        ,200);
    }
    public function getOrderStatusForPharmacist($user_id, $order_id) {

        if (!is_numeric($user_id) || $user_id <= 0) {
            return response()->json([

                'message' => 'Invalid user ID',
            ],status:400);
        }


        if (!is_numeric($order_id) || $order_id <= 0) {
            return response()->json([

                'message' => 'Invalid order ID',
            ],status:400);
        }


        $order = dorder::where('id', $order_id)
            ->where('user_id', $user_id)
            ->first();
        if ($order) {
            $order_status = $order->order_satatus;
            $payment_status = $order->payment_status;


            return response()->json([

                'message' => 'Order status and payment status retrieved successfully',
                'order_status' => $order_status,
                'payment_status' => $payment_status,
            ],status:200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Order not found for the specified user',
            ],status: 404);
        }
    }
    public function getorderpharmacist($id){
        $order=dorder::where('user_id',"=",$id)->get();
        return response()->json(
            $order);
    }
    public function getwarehousestatus($id){
        $order=dorder::where('id',"=",$id)->first();
        return response()->json(
            [
                'order_satatus'=> $order->order_satatus,
                'payment_status' =>$order->payment_status]
    ,200);
    }

}






