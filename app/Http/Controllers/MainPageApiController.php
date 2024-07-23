<?php

namespace App\Http\Controllers;

use App\Models\Accommodations;
use App\Models\Attachments;
use App\Models\ContactSectionInfo;
use App\Models\DiscountAndMarketing;
use App\Models\MainPageServices;
use App\Models\MainPageSlider;
use App\Models\Policy;
use App\Models\PrivacyPolicy;
use App\Models\RepeatedQuestions;
use App\Models\Section;
use App\Models\SocialMediaIcons;
use Illuminate\Http\Request;
use Mail;

class MainPageApiController extends Controller
{
    //
    public function mainSliders()
    {
        $slides = MainPageSlider::all();

        if (!$slides) {
            return response()->json(['message' => 'Slider Not found'], 404);
        }

        return response()->json($slides);
    }
    public function sections()
    {
        $section = Section::first();
        $section = $section->toArray();

        $section['hotels_count'] = Accommodations::hotels()->count();
        $section['chalets_count'] = Accommodations::chalets()->count();
        $section['appartments_count'] = Accommodations::appartments()->count();
        $section['halls_count'] = Accommodations::halls()->count();
        return response()->json($section);
    }

    public function mainServices()
    {
        $services = MainPageServices::all();

        if (!$services) {
            return response()->json(['message' => 'Services Not found'], 404);
        }

        return response()->json($services);
    }
    public function repeatedQuestions()
    {
        $questions = RepeatedQuestions::all();

        if (!$questions) {
            return response()->json(['message' => 'Questions Not found'], 404);
        }

        return response()->json($questions);
    }

    public function socialIcons()
    {
        $socials = SocialMediaIcons::all();

        if (!$socials) {
            return response()->json(['message' => 'Social icons Not found'], 404);
        }

        return response()->json($socials);
    }

    public function PrivacyPolicies()
    {
        $policies = PrivacyPolicy::all();

        if (!$policies) {
            return response()->json(['message' => 'terms Not found'], 404);
        }

        return response()->json($policies);
    }

    public function Policies()
    {
        $policies = Policy::all();

        if (!$policies) {
            return response()->json(['message' => 'Policies Not found'], 404);
        }

        return response()->json($policies);
    }
    public function getFooterInfo()
    {
        $info = ContactSectionInfo::first();

        if (!$info) {
            return response()->json(['message' => 'Info not found'], 404);
        }
        $infoData = $info->toArray();
        $infoData['images'] = $info->images;


        return response()->json($infoData);

    }


    public function getAds()
    {
        $discountAndMarketing = DiscountAndMarketing::firstOrFail();
        $firstColumn = Attachments::where('entity_type', 'firstColumn')->get();
        $secondColumn = Attachments::where('entity_type', 'secondColumn')->get();
        $thirdColumn = Attachments::where('entity_type', 'thirdColumn')->get();
        $fourthColumn = Attachments::where('entity_type', 'fourthColumn')->get();

        return response()->json(
            [
                'title' => $discountAndMarketing->title,
                'description' => $discountAndMarketing->description,
                'firstColumn' => $firstColumn,
                'secondColumn' => $secondColumn,
                'thirdColumn' => $thirdColumn,
                'fourthColumn' => $fourthColumn,
            ]
        );

    }
}
