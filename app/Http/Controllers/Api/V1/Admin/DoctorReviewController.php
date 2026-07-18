<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoctorReview;
use Illuminate\Http\Request;

class DoctorReviewController extends Controller
{
    public function index()
    {
        $reviews = DoctorReview::paginate(10);
        return response()->json(['data' => $reviews], 200);
    }
    public function show(DoctorReview $doctorReview)
    {
        $doctorReview->load([
            'doctor.user',
            'patient.user',
        ]);
        return response()->json(['data' => $doctorReview], 200);
    }
    public function destroy(DoctorReview $doctorReview)
    {
        $doctorReview->delete();
        return response()->json(['message' => 'Review Deleted Successfully!'], 200);
    }
}
