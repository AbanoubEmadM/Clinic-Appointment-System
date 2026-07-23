<?php

namespace App\Http\Controllers\Api\V1\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\DoctorReview;
use App\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        private ReviewService $reviewService,
    ){}
    public function index()
    {
        $reviews = DoctorReview::where('patient_id', auth()->user()->patient->id)->get();
        return response()->json(['data' => $reviews]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        $review = $this->reviewService->store($request->validated());
        return response()->json(['data' => new ReviewResource($review)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(DoctorReview $review)
    {
        $review->get();
        return response()->json(['data' => new ReviewResource($review)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, DoctorReview $review)
    {
        $review = $this->reviewService->update($request->validated());
        return response()->json(['data' => new ReviewResource($review)]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DoctorReview $review)
    {
        $review->delete();
        return response()->noContent();
    }
}
