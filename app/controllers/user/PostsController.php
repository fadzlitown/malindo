<?php

namespace App\Controllers\User;

use App\Malindo\Repositories\PostRepository,
    App\Models\Post,
    App\Models\PostImage,
    Carbon\Carbon,
    Config,
    Input,
    Response,
    Str,
    UserBaseController,
    Validator;

class PostsController extends UserBaseController
{

    private $repository;

    public function __construct(PostRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function index()
    {
        $posts = \App\Models\Account::find(\Auth::user()->id)->posts();

        $output = [
            'posts' => $posts->get()->toArray()
        ];

        return Response::json($output);
    }

    public function getCreate()
    {
        $post  = new Post();
        $input = Input::only($post->getFillable());

        return Response::json($input);
    }

    public function submitCreate()
    {
        $post     = new Post();
        $input    = Input::only($post->getFillable());
        $dt_start = new Carbon('yesterday');

        $validator = Validator::make($input, array_merge($post->rules, ['post_expiry_time' => 'required|after:' . $dt_start->toDateString() . '|before:' . $dt_start->addDays(31)->toDateString()]));
        if ($validator->fails()) {
            return Response::json($validator->messages()->first());
        }
        else {
            $input = $this->repository->prepareInput($input); //add slug, code
            $post  = Post::create($input);
            if ($post->id) {
                return Response::json($post);
            }
        }

        return Response::json($input);
    }

    public function getMedia($code)
    {
        $images = [];
        $post   = Post::where('code', $code)->first();

        if (!is_null($post)) {
            //populate existing media
            $images = PostImage::where('post_id', $post->id)->get()->toArray();
        }

        $output = [
            'post'                        => $post,
            'images'                      => $images,
            'max_allowed_images_per_post' => Config::get('app.max_allowed_images_per_post')
        ];

        Return Response::view('frontend.posts.media', $output);
    }

    public function submitMedia()
    {
        $images    = Input::file("images");
        $input     = array_add(Input::only("post_id"), 'allowed_images', count($images));
        $validator = Validator::make($input, ['post_id' => 'required|numeric|exists:posts,id', 'allowed_images' => 'required|max:1,' . Config::get('app.max_allowed_images_per_post')]);

        if ($validator->passes()) {
            $post = Post::find($input['post_id']);
            foreach ($images as $file) {
                $rules     = ['file' => 'required|image|max:' . Config::get('app.max_allowed_size_image')];
                $validator = Validator::make(array('file' => $file), $rules);

                if ($validator->passes()) {
                    $id              = Str::random(14);
                    $destinationPath = base_path() . "/public/uploads";
                    $filename        = Str::slug("{$post->slug}-{$id}");
                    $extension       = $file->getClientOriginalExtension();
                    $upload_success  = $file->move($destinationPath, $filename . '.' . $extension);
                    var_dump($upload_success);
                }
                else {
                    echo $validator->messages()->first();
                }
            }
        }
        else {
            echo $validator->messages()->first();
        }
    }

    public function getEdit($code)
    {
        $post = $this->repository->isPostExistsByCodeOfUser($code);
        if ($post) {
            echo '<pre>';
            print_r($post->toArray());
            echo "<br/>----<br/>";
            echo '</pre>';
            die;
        }
    }

    public function submitEdit($code)
    {
        $post = $this->repository->isPostExistsByCodeOfUser($code);
        echo '<pre>';
        print_r($post->toArray());
        echo "<br/>----<br/>";
        echo '</pre>';
        die;

        if ($post) {
            $input = \Input::all();

            $dt_created = new Carbon($post->created_at);

            $rules = array_merge($post->rules, [
                'post_expiry_time' => 'required|after:' . $dt_created->toDateString() . '|before:' . $dt_created->addDays(31)->toDateString(),
            ]);

            $validator = Validator::make($input, $rules);

            if ($validator->passes()) {
                $post = $this->repository->setPostAsPending($post);
            }
        }
    }

}
