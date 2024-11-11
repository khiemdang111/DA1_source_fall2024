<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Category_post;
use App\Models\Post;
use App\Models\User;

use App\Validations\PostValidation;

use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\Post\Create;
use App\Views\Admin\Pages\Post\Edit;
use App\Views\Admin\Pages\Post\index;




class PostController
{


    // hiển thị danh sách
    public static function index()
    {

        $post = new Post();
        $data = $post->getAllPost();

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        index::render($data );
        Footer::render();
    }

    public static function create()
    {
        $user = new User();
        $user_all = $user->getAllUser();

        $Category_post = new Category_post();
        $category_post_all = $Category_post->getAllCatrgoty_Post();

        $data =[
            'user_all' => $user_all,
            'category_post_all' => $category_post_all,
        ];

       
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Create::render($data);
        Footer::render();
    }

    public static function store()
    {
        $is_valid = PostValidation::create();
        if (!$is_valid) {

            NotificationHelper::error('store', 'Thêm bài viết thất bại');
            header('location: /admin/posts/create');
            exit();
        }
        $title = $_POST['title'];

        $post = new Post();
        $is_existe = $post->getOnePostByName($title);
        if ($is_existe) {
            NotificationHelper::error('store', 'Tên bài viết đã tồn tại');
            header('location: /admin/posts/create');
            exit();
        }

        $data = [
            'title' => $title,
            'summary' => $_POST['title'],
            'content' => $_POST['content'],
            'user_id' => $_POST['user_id'],
            'category_post_id' => $_POST['category_post_id'],
            'created_at' => date('Y-m-d H:i:s'),    
            'status' => $_POST['status'],
            
        ];

        $is_upload = PostValidation::uploadAvatar();
        if ($is_upload) {
            $data['img'] = $is_upload;
        }
        
        $result = $post->createPost($data);
        if ($result) {
            NotificationHelper::success('store', 'Thêm bài viết thành công');
            header('location: /admin/posts');
            exit();
        } else {
            NotificationHelper::error('store', 'Thêm bài viết thất bại');
            header('location: /admin/posts/create');
            exit();
        }
    }

    public static function edit(int $id)
    {

        $user = new User();
        $user_all = $user->getAllUser();

        $Category_post = new Category_post();
        $category_post_all = $Category_post->getAllCatrgoty_Post();

        $post = new Post();
        $getOnePost = $post->getOnePost($id);

       
        if (!$getOnePost) {
            NotificationHelper::error('edit', 'Không thể xem sản phẩm này!');
            header('Location: /admin/posts');
        }
        $data = [
            'getOnePost' => $getOnePost,
            'user_all' => $user_all,
            'category_post_all' => $category_post_all,

        ];
       
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Edit::render($data);
        Footer::render();
    }


    public static function update(int $id)
    {
 
        $is_valid =  PostValidation::edit();
        if (!$is_valid) {
            NotificationHelper::error('update_product', 'Cập nhật bài viết thất bại  !');
            header("Location: /admin/posts/$id");
            exit();
        }
        $title = $_POST['title'];

        $post = new Post();
        $is_existe = $post->getOnePostByName($title);

        if ($is_existe && $is_existe['id'] != $id) {
            NotificationHelper::error('update_product', 'Tên loại bài viết đã tồn tại!');
            header("Location: /admin/posts/$id");
            exit();
        }
        $data = [
            'title' => $title,
            'summary' => $_POST['title'],
            'content' => $_POST['content'],
            'user_id' => $_POST['user_id'],
            'category_post_id' => $_POST['category_post_id'],
            'status' => $_POST['status'],
            
        ];
        // $is_upload = ProductValidation::updateImage();
        // if ($is_upload) {
        //     $data['image'] = $is_upload;
        // }
        $result = $post->updatePost($id, $data);
        if ($result) {
            NotificationHelper::success('update', 'Cập nhật bài viết thành công!');
            header('Location: /admin/posts');
        } else {
            NotificationHelper::error('update', 'Cập nhật bài viết thất bại!');
            header("Location: /admin/posts/$id");
        }
    }
}