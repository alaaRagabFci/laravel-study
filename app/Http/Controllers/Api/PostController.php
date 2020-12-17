<?php

namespace App\Http\Controllers\Api;

use App\Events\CommentCreated;
use App\Events\PostCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StorePostRequest;
use App\Jobs\PostCreatedJob;
use App\Models\Post;
use App\Models\PostComment;
use App\Notifications\PostCreatedNotification;
use App\Repositories\Post\IPostRepository;
use App\Repositories\PostComment\IPostCommentRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    protected $iPostRepository;
    protected $iPostCommentRepository;

    public function __construct(IPostRepository $iPostRepository, IPostCommentRepository $iPostCommentRepository)
    {
        $this->iPostRepository = $iPostRepository;
        $this->iPostCommentRepository = $iPostCommentRepository;
    }

    public function createPost(StorePostRequest $storePostRequest): Post
    {
        // var_dump(Carbon::today()->toDateTimeString()); die;
        // if (Gate::authorize('create', Post::class)) {
            // if (request()->user()->can('create', Post::class)) {
            // if (Gate::allows('create-post')) {
            $parameters = $storePostRequest->all();
            $fileName = $parameters['photo']->getClientOriginalName();
            // Storage::putFileAs('users', $parameters['photo'], $fileName);
            // $extension = $parameters['photo']->extension();
            Storage::delete('issue.png');
            // Storage::delete(['file.jpg', 'file2.jpg']);
            $parameters['photo']->storeAs('users', $fileName);
            unset($parameters['photo']);
            $parameters['user_id'] = auth('users')->id();
            $parameters['photo'] = $fileName;
            $post= $this->iPostRepository->store($parameters);
            event(new PostCreated($post));
            $when = now()->addMinutes(1);
            // auth('users')->user()->notify(new PostCreatedNotification($post));
            // auth('users')->user()->notify((new PostCreatedNotification($post))->delay($when));
            PostCreatedJob::dispatch($post)->delay($when);
            return $post;
        // }

    }

    public function createComment(StoreCommentRequest $storeCommentRequest, Post $post): PostComment
    {
        $parameters = $storeCommentRequest->all();
        $parameters['post_id'] = $post->id;

        $comment = $this->iPostCommentRepository->store($parameters);
        event(new CommentCreated($comment));

        return $comment;
    }

    public function collection()
    {
        // $average = collect([1, 1, 2, 4])->avg();


        // $collection1 = collect([[1, 1, 3], [4, 5, 6], [7, 8, 9]]);
        // $collapsed = $collection1->collapse();
        // $collapsed->dump();


        // $collection2 = collect(['product' => 'Desk', 'price' => 200]);
        // $bool = $collection2->contains(200);
        // return $bool ? 'true' : 'false';


        // $collection = collect(['product' => 'Desk', 'price' => 200]);
        // $collection->each(function ($value, $key) {
        //     dd($key);
        // });

        // $collection = collect([1, 2, 3, 4]);
        // $filtered = $collection->filter(function ($value, $key) { // vs reject
        //     return $value > 2;
        // });

        // dd($filtered->toArray());
        // dd($filtered->all());

        // $collection = collect([1, 2, 3, 4])->search('4', true);

        // dd($collection);

        $collection = collect([
            [
                'speakers' => [
                    'first_day' => ['Rosa', 'Judith'],
                    'second_day' => ['Angela', 'Kathleen'],
                ],
            ],
        ]);

        $plucked = $collection->pluck('speakers.first_day');

        dd($plucked->all());
    }
}
