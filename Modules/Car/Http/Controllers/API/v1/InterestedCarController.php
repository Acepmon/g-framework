<?php

namespace Modules\Car\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Content\Transformers\ContentCollection;
use Modules\Content\Transformers\Content as ContentResource;
use App\UserMeta;
use App\Content;
use Auth;

class InterestedCarController extends Controller
{
    public function interestedCars(Request $request)
    {
        $interestedCars = $request->user()->metas()->where('key', 'interestedCars')->get()->transform(function ($item) { return intval($item->value); })->toArray();

        $type = $request->input('type', Content::TYPE_CAR);
        $status = $request->input('status', Content::STATUS_PUBLISHED);
        $visibility = $request->input('visibility', Content::VISIBILITY_PUBLIC);
        $limit = $request->input('limit', 10);

        $inputExcept = ['type', 'status', 'visibility', 'limit', 'page', 'author_id'];
        $metaInputs = array_filter($request->input(), function ($key) use ($inputExcept) {
            return !in_array($key, $inputExcept);
        }, ARRAY_FILTER_USE_KEY);

        $contents = Content::where('type', $type)->where('status', $status)->where('visibility', $visibility)->whereIn('id', $interestedCars);

        if ($request->has('author_id')) {
            $contents = $contents->where('author_id', $request->input('author_id'));
        }

        if (count($metaInputs) > 0) {
            $contents = $contents->whereHas('metas', function ($query) use ($metaInputs) {
                foreach ($metaInputs as $key => $value) {
                    $query->where('key', $key);
                    $query->where('value', $value);
                }
            });
        }

        return response()->json(new ContentCollection($contents->paginate($limit)));
    }

    public function interestedCar(Request $request, $contentId) {
        return response()->json(new ContentResource(Content::find($contentId)));
    }

    public function createInterested(Request $request) {
        $request->validate([
            'content_id' => 'required|exists:contents,id'
        ]);

        if (!$this->interestExists(Auth::user(), $request->input('content_id'))) {
            return response()->json($this->storeInterested(Auth::user(), $request->input('content_id')));
        }
    }

    public function removeInterested(Request $request) {
        $request->validate([
            'content_id' => 'required|exists:contents,id'
        ]);

        if ($this->interestExists(Auth::user(), $request->input('content_id'))) {
            return response()->json($this->deleteInterested(Auth::user(), $request->input('content_id')));
        }
    }

    public function toggleInterested(Request $request) {
        $request->validate([
            'content_id' => 'required|exists:contents,id'
        ]);

        if ($this->interestExists(Auth::user(), $request->input('content_id'))) {
            return response()->json($this->deleteInterested(Auth::user(), $request->input('content_id')));
        } else {
            return response()->json($this->storeInterested(Auth::user(), $request->input('content_id')));
        }
    }

    private function storeInterested($user, $contentId) {
        $meta = new UserMeta();
        $meta->user_id = $user->id;
        $meta->key = 'interestedCars';
        $meta->value = $contentId;

        return $user->metas()->save($meta);
    }

    private function deleteInterested($user, $contentId) {
        return $user->metas()->where('key', 'interestedCars')->where('value', $contentId)->first()->delete();
    }

    private function interestExists($user, $contentId) {
        $interest= $user->metas()->where('key', 'interestedCars')->where('value', $contentId)->first();
        return $interest != null;
    }
}
